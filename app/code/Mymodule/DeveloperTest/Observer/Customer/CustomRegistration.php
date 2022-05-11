<?php
/**
 * Copyright © neosoft, Inc. All rights reserved.
 * @package Mymodule_DeveloperTest
 */
namespace Mymodule\DeveloperTest\Observer\Customer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use \Magento\Framework\Event\Observer;
use \Magento\Framework\Mail\Template\TransportBuilder;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Store\Model\ScopeInterface;
use \Magento\Framework\App\Area;


/**
 * Class CustomRegistration
 */
class CustomRegistration implements ObserverInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface 
     */
    protected $storeManager;

    /**
     * custom customer registration flow constructor
     * 
     * @param CustomerRepositoryInterface $customerRepo
     * @param TransportBuilder $transportBuilder
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */

    public function __construct(
      CustomerRepositoryInterface $customerRepository,
      TransportBuilder $transportBuilder,
      ScopeConfigInterface $scopeConfig,
      StoreManagerInterface $storeManager
    ){
      $this->customerRepository = $customerRepository;
      $this->transportBuilder = $transportBuilder;
      $this->scopeConfig = $scopeConfig;
      $this->storeManager = $storeManager;
    }


    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer){
      $customer = $observer->getEvent()->getCustomer();
      $email = $customer->getEmail();
      $first_name = $customer->getFirstname();
      $last_name = $customer->getLastname();
      $new_fname = str_replace(' ', '', $first_name);
      $modifiedCustomer = $this->customerRepository->getById($customer->getId());
      $modifiedCustomer->setFirstname($new_fname);
      $this->customerRepository->save($modifiedCustomer);
     

      $customerInfo = ['firstname' => $new_fname, 'lastname' => $last_name, 'email' => $email];
      $this->showCustomerLog($customerInfo);

      
      $receiverName = $this->scopeConfig->getValue('trans_email/ident_support/name', ScopeInterface::SCOPE_STORE);
      $receiverEmail = $this->scopeConfig->getValue('trans_email/ident_support/email', ScopeInterface::SCOPE_STORE);
      $sendToInfo = ['email' => $receiverEmail,'name' => $receiverName];
     
      $this->sendEmailtoSupport($sendToInfo, $customerInfo);
    }

    /**
     * This function will show customer details in var/log/customerdata.log file 
     * 
     * @param array $customer //consists customer's firstname, lastname, and email
     */
    protected function showCustomerLog($customer){
      $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/customerdata.log');
      $logger = new \Zend\Log\Logger();
      $logger->addWriter($writer);
      $logger->info(print_r($customer,true));
    } 

    /**
     * send email to customer support when new customer registered.
     * 
     * @param array $addtoInfo //consists receivers's name and email
     * @param array $tempVars //consists templates variables
     * @return $this
     */
    protected function sendEmailtoSupport($addtoInfo, $tempVars){
      $transport = $this->transportBuilder->setTemplateIdentifier('customer_details_email_to_support')
      ->setTemplateOptions([ 'area' => Area::AREA_FRONTEND,'store' => $this->storeManager->getStore()   ->getId()])
      ->setTemplateVars($tempVars)
      ->setFrom([ "name" => 'Darshana', "email" => 'jethavadarshana@gmail.com' ])
      ->addTo($addtoInfo['email'],$addtoInfo['name'])
      ->getTransport();
      $transport->sendMessage();
      return $this;
    }
}