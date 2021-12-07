<?php
namespace Neosoft\Core\Block;
class Customer extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\App\Http\Context
     */
    protected $httpContext;
    protected $session;
    protected $storemanagerinterface ;
    protected $_customerSession;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Http\Context              $httpContext
     * @param array                                            $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\SessionFactory $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storemanagerinterface, 
        array $data = []
    ) {
        $this->storemanagerinterface = $storemanagerinterface ;
        $this->request = $request;
        $this->customerRepository = $customerRepository;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }
    /**
     * @return boolean
     */
    public function getStoreUrl(){
        return $this->storemanagerinterface->getStore()->getBaseUrl();
    }
    public function getCustomerId() {
        $customer = $this->_customerSession->create();
        $customerid = $customer->getCustomer()->getId();
        return $customerid;
    }

    public function getCustomerName() {
        $customer = $this->_customerSession->create();
        $customername = $customer->getCustomer()->getName();
        return $customername;
    }
}