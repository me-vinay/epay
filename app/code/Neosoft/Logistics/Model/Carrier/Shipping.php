<?php
namespace Neosoft\Logistics\Model\Carrier;
 
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
use Neosoft\Logistics\Model\Logistics;
use  Magento\Checkout\Model\Session;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;


 
class Shipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'logistics';
    protected $Session;
    protected $logger;
/**
 * @var CustomerRepositoryInterface
 */
protected $customerRepositoryInterface;
/**
 * @var ProductFactory
 */
protected $productfactory;
/**
 * @var Logistics
 */
protected $proqnt;
    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        Logistics $proqnt,
        Session $Session,
        ProductFactory $productfactory,
        CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        
        array $data = []
    ) {
        $this->proqnt = $proqnt;
        $this->productfactory = $productfactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->Session = $Session;
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->logger = $logger;
       
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }
 
    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }

     /**
     * @return float
     */
    private function getShippingPrice()
    {
        $configPrice = $this->getConfigData('price');
        $product_qnt = $this->proqnt->getProductQnt();
       
       if($product_qnt > 1){
         $shippingPrice = $configPrice*$product_qnt;
         return $shippingPrice;
       }
       else{
      
        
       // $shippingPrice = $this->getFinalPriceWithHandlingFee($configPrice);
        return $configPrice;
       }
    }
 
    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
 
       /** @var \Magento\Shipping\Model\Rate\Result $result */
       $result = $this->_rateResultFactory->create();

       /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
       $method = $this->_rateMethodFactory->create();

       $method->setCarrier($this->_code);
       $method->setCarrierTitle($this->getConfigData('title'));

       $method->setMethod($this->_code);
       $method->setMethodTitle($this->getConfigData('name'));

       $amount = $this->getShippingPrice();
     
       $method->setPrice($amount);
      $method->setCost($amount);
       $result->append($method);
    
 
       return $result;
    }
  }