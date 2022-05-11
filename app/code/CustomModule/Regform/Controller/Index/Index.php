<?php
    namespace CustomModule\Regform\Controller\Index;
    use \Magento\Framework\App\Config\ScopeConfigInterface;
    use \Magento\Store\Model\StoreManagerInterface ;
    use  Magento\Checkout\Model\Session;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Cminds\Supplierfrontendproductuploader\Helper\Price;
use Magento\Checkout\Model\Cart;
use Cminds\Marketplace\Model\MethodsFactory;
use Cminds\Marketplace\Model\RatesFactory;
use Cminds\Marketplace\Model\ResourceModel\Rates as RatesResource;
use Cminds\Marketplace\Model\ResourceModel\Methods as MethodsResource;
use \Magento\Framework\Filesystem\DirectoryList;
    class Index extends \Magento\Framework\App\Action\Action
    {
        private const XML_PATH_TOKEN = 'system/nettelo_access_token/access_token';

        /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $priceHelper;
    protected $cart;
    protected $supplierRates;
    protected $ratesResource;
    protected $methodsResource;

    protected $scopeConfig;
        protected $_pageFactory;
       protected $_storeManager;
       protected $_dir;
       protected $Session;
       protected $methods;
/**
 * @var CustomerRepositoryInterface
 */
protected $customerRepositoryInterface;
/**
 * @var ProductFactory
 */
protected $productfactory;
       protected $date;

        public function __construct(
            \Magento\Framework\App\Action\Context $context,
            MethodsFactory $methods,
            Price $price,
            Cart $cart,
            RatesFactory $supplierRates,
            RatesResource $ratesResource,
            MethodsResource $methodsResource,

            ScopeConfigInterface $scopeConfig,
            StoreManagerInterface $storeManager,
          \Magento\Framework\Filesystem\DirectoryList $dir,
            \Magento\Framework\View\Result\PageFactory $pageFactory,
            \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
            Session $Session,
            ProductFactory $productfactory,
            CustomerRepositoryInterface $customerRepositoryInterface)
        {
            $this->priceHelper = $price;
            $this->cart = $cart;
            $this->supplierRates = $supplierRates;
            $this->ratesResource = $ratesResource;

            $this->_pageFactory = $pageFactory;
            $this->_dir = $dir;
            $this->methods = $methods;
            $this->methodsResource = $methodsResource;

            $this->date = $date;
            $this->productfactory = $productfactory;
            $this->customerRepositoryInterface = $customerRepositoryInterface;
            $this->Session = $Session;
            $this->scopeConfig = $scopeConfig;
            $this->_storeManager = $storeManager;
            return parent::__construct($context);
        }
    
        public function execute()
        { 
            $totalWeight = 0;
            $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        //  $path =  $this->_dir->getPath('pub');
            var_dump($mediaUrl);
           // 
           //$newfileName = 'billing'.'_'.$this->date->date()->format('Y-m-d_H:i:s');
        //   $accessToken = $this->scopeConfig->getValue(self::XML_PATH_TOKEN); 
          // var_dump($accessToken);
           // $filePath = $this->_dir->getPath('var') . "/" ;
            //$body = json_encode(["text" =>  $filePath]);
            //var_dump($body);
           //return $this->_pageFactory->create();
         
         //   $product = $this->productfactory->create()->load('45');
               
                  
        }
    


    }