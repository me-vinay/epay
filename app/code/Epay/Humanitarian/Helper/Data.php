<?php
namespace Epay\Humanitarian\Helper;
use Magento\Framework\App\Helper\Context;
use \Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Data\Form\FormKey ;
use Magento\Quote\Model\QuoteFactory ;
use Magento\Customer\Model\CustomerFactory;
use Magento\Sales\Model\Service\OrderService;
use \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory;
use \Magento\Customer\Api\CustomerRepositoryInterface;
use \Magento\Quote\Model\QuoteManagement ;
use \Magento\Catalog\Api\ProductRepositoryInterface;
use Epay\Humanitarian\Model\ItemsFactory;

class Data extends AbstractHelper
{

    /**
     * @var QuoteFactory
     */
    protected $quote;

    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * @var OrderService
     */
    protected $orderService;


    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var QuoteManagement
     */
    protected $quoteManagement;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
     /**
    * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param FormKey $formkey,
     * @param Quote $quote,
     * @param CustomerFactory $customerFactory,
     * @param OrderService $orderService,
     * @param CustomerRepositoryInterface $customerRepository
     * @param QuoteManagement $quoteManagement
     * @param ProductRepositoryInterface $productRepository
     * @param Magento\Sales\Model\Order $order
    */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        ProductRepositoryInterface $productRepository,
        FormKey $formkey,
        QuoteFactory $quote,
        QuoteManagement $quoteManagement,
        CustomerFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        OrderService $orderService  
    ) {
        $this->_storeManager = $storeManager;
        $this->_formkey = $formkey;
        $this->quote = $quote;
        $this->quoteManagement = $quoteManagement;
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
        $this->orderService = $orderService;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }
 
    /**
     * Create Order On Your Store
     * 
     * @param array $orderData
     * @return array
     * 
    */
    public function createMyOrder($orderData) {
        $store=$this->_storeManager->getStore();
        $websiteId = $this->_storeManager->getStore()->getWebsiteId();
        $customer=$this->customerFactory->create();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($orderData['email']);// load customet by email address
        
        if(!$customer->getEntityId()){
            //If not avilable then create this customer 
            $customer->setWebsiteId($websiteId)
                    ->setStore($store)
                    ->setFirstname($orderData['address']['firstname'])
                    ->setLastname($orderData['address']['lastname'])
                    ->setEmail($orderData['email']) 
                    ->setPassword($orderData['email']);
            $customer->save();
        }
        $quote=$this->quote->create(); //Create object of quote
        $quote->setStore($store); //set store for which you create quote
        // if you have allready buyer id then you can load customer directly 
        $customer= $this->customerRepository->getById($customer->getEntityId());
        $quote->setCurrency();
        $quote->assignCustomer($customer); //Assign quote to customer
 
        //add items in quote
        foreach($orderData['items'] as $item){
            $product=$this->productRepository->getById($item['product_id']);
            $quote->addProduct(
                $product,
                intval($item['qty'])
            );
        }
 
        //Set Address to quote
        $quote->getBillingAddress()->addData($orderData['address']);
        $quote->getShippingAddress()->addData($orderData['address']);
 
        // Collect Rates and Set Shipping & Payment Method
 
   
        $shippingAddress=$quote->getShippingAddress();
        $shippingAddress->setCollectShippingRates(true)
                        ->collectShippingRates()
                        ->setShippingMethod('freeshipping_freeshipping'); //shipping method
     //   $quote->setPaymentMethod('checkmo'); //payment method
        $quote->setInventoryProcessed(false); //not effetc inventory
        $quote->save(); //Now Save quote and your quote is ready
        $quote->collectTotals()->save();
 
        // Create Order From Quote
        $order = $this->quoteManagement->submit($quote);
        
        $order->setEmailSent(0);
        $increment_id = $order->getRealOrderId();
        if($order->getEntityId()){
            $result['order_id']= $order->getRealOrderId();
        }else{
            $result=['error'=>1,'msg'=>'Your custom message'];
        }
        return $result;
    }
}
 
?>