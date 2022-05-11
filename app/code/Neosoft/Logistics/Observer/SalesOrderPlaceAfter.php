<?php 
namespace Neosoft\Logistics\Observer; 
use Magento\Framework\Event\ObserverInterface; 
use \Magento\Framework\App\Config\ScopeConfigInterface;
use Psr\Log\LoggerInterface; 
use Magento\Catalog\Model\ProductFactory;




class SalesOrderPlaceAfter implements ObserverInterface 
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
 * @var \Magento\Store\Model\StoreManagerInterface
 */
protected $storeManager;
public function __construct(LoggerInterface$logger,
                            ProductFactory $productfactory,
                            ScopeConfigInterface $scopeConfig,
                            \Magento\Store\Model\StoreManagerInterface $storeManager

                            ) 
{ 
 $this->productfactory = $productfactory;
 $this->logger = $logger;
$this->scopeConfig = $scopeConfig;
$this->storeManager = $storeManager;

}
public function execute(\Magento\Framework\Event\Observer $observer)
{
 try 
  {   
    
    $order = $observer->getEvent()->getOrder();
    $items = $order->getAllItems();
    $shipping_amount_per_lbs = $this->scopeConfig->getValue("carriers/logistics/price",
       \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());

   //$this->logger->info($shipping_amount_per_lbs);

    foreach ($items as $item) {
       $product = $this->productfactory->create()->load($item->getProductId());
       if($this->getSupplierIdFromOrderItems($product)){
      //  $this->logger->info($product->getWeight().' * '.$item->getQtyOrdered().' * '.$shipping_amount_per_lbs);
        $item_shipping_price =($product->getWeight()*$item->getQtyOrdered())*$shipping_amount_per_lbs;
        $item->setSupplierShippingAmount($item_shipping_price);
      }
      else{
        $item->setSupplierShippingAmount(0);
      }

    }
      
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
    
     
}
