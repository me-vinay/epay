<?php 
namespace Mymodule\MinQunatityNotificationEmail\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use \Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface; 
use \Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;



class SendEmailtoSupplierObserver implements ObserverInterface 
{ 
protected $logger; 
/**
 * @var ProductFactory
 */
protected $productfactory;
/**
 * @var \Magento\Framework\App\Config\ScopeConfigInterface
 */
protected $scopeConfig;
/**
 * @var TransportBuilder
 */
private $transportBuilder;
/**
 * @var CustomerRepositoryInterface
 */
protected $customerRepositoryInterface;
/**
 * @var \Magento\Store\Model\StoreManagerInterface
 */
protected $storeManager;
protected $_stockitemrepository;
public function __construct(LoggerInterface$logger,
                            TransportBuilder $transportBuilder,
                            ProductFactory $productfactory,
                            CustomerRepositoryInterface $customerRepositoryInterface,
                            ScopeConfigInterface $scopeConfig,
                            \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockitemrepository,
                            \Magento\Store\Model\StoreManagerInterface $storeManager

                            ) 
{ 
 $this->productfactory = $productfactory;
 $this->_stockitemrepository = $stockitemrepository;
 $this->logger = $logger;
$this->scopeConfig = $scopeConfig;
$this->transportBuilder = $transportBuilder;
$this->storeManager = $storeManager;
$this->customerRepositoryInterface = $customerRepositoryInterface;

}
public function execute(\Magento\Framework\Event\Observer $observer)
{
 try 
  {   
    $sendToEmails = [] ;
    $order = $observer->getEvent()->getOrder();
    $items = $order->getAllItems();
    $supplierId = null;
    $min_qnt = $this->scopeConfig->getValue("system/supplier_product_min_qnt/min_qnt",
       \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());

   // $this->logger->info($supplierId);

    foreach ($order->getAllItems() as $item) {
      //  $ProductQnts[] = $item->getProductId();
       $product = $this->productfactory->create()->load($item->getProductId());
       $ProductQnt = $product->getExtensionAttributes()->getStockItem()->getQty();
      
       if($ProductQnt <= $min_qnt){
       $supplierId = $this->getSupplierIdFromOrderItems($product);
        if ($supplierId) {
        $supplier = $this->getSupplierById($supplierId);
         if (!empty($supplier)) {
          // $supplierName = $this->getSupplierName($supplier);
          // $sendToEmails[] = $supplier->getEmail();     
          $sendToEmails[] = $supplier->getEmail();    
         }
       }
      }
    }
    $senderName = $this->scopeConfig->getValue('trans_email/ident_general/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); // sender name
    $senderEmail = $this->scopeConfig->getValue('trans_email/ident_general/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); // sender email id
    $templateVars = [];
   $transport = $this->transportBuilder->setTemplateIdentifier('min_qnt_email_to_supplier')
    ->setTemplateOptions([ 'area' => \Magento\Framework\App\Area::AREA_FRONTEND,'store' => 1,
    ])
     ->setTemplateVars($templateVars)
    ->setFrom([ "name" => $senderName, "email" => $senderEmail ])
    ->addTo($sendToEmails)
    ->setReplyTo($senderEmail)
    ->getTransport();
     $transport->sendMessage();

    
    //    $this->logger->info(print_r($emails, true) ." ". $sendToEmail." ". $min_qnt);       
  }
catch (\Exception $e) 
 {
  $this->logger->main($e->getMessage());
 }
}


    /**
     * @param $product
     * @return string|null
     */
    protected function getSupplierIdFromOrderItems($product)
    {
                   if ($product->getCreatorId() !== null) {
                return $product->getCreatorId();
            
        }
        return null;
    }
      /**
     * @param $supplierId
     * @return CustomerInterface|null
     */
    protected function getSupplierById($supplierId)
    {
        try {
            return $this->customerRepositoryInterface->getById($supplierId);
        } catch (LocalizedException $e) {
            return null;
        }
    }
    /**
     * @param $supplier
     * @return string
     */
   /* protected function getSupplierName($supplier)
    {
        $supplierName = $supplier->getFirstname() . ' ' . $supplier->getLastname();
        if (empty($supplier->getCustomAttributes()) || empty($supplier->getCustomAttributes()['supplier_name'])) {
            return $supplierName;
        }
        return $supplier->getCustomAttributes()['supplier_name']->getValue();
    }*/
     
}
