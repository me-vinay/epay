<?php
 /**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Controller\Index;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Action;
use \Epay\Humanitarian\Model\DonorFactory;
use \Epay\Humanitarian\Model\PickupFactory;
use Magento\Framework\Controller\ResultFactory;
use Psr\Log\LoggerInterface; 
use Epay\Humanitarian\Helper\Data;

use \Epay\Humanitarian\Model\ResourceModel\Items\CollectionFactory;


 class Donate extends Action
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;

     /**
      * 
      * @var type
      */
     private $donorFactory;
     
     /**
      * 
      * @var type
      */
     private $pickupFactory;

    /**
     * @var Data
     */
   protected $helperOrder;


   /**
    * @var CollectionFactory
    */
   protected $itemCollection;

   /**
    * @var LoggerInterface
    */
 protected $logger;
    /**
     * 
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param DonorFactory $donorFactory
     * @param PickupFactory $pickupFactory
     * @param  Data $helperOrder
     * @param   CollectionFactory $itemCollection
     * @param  LoggerInterface $logger
     */
     public function __construct(
          Context $context,
          PageFactory $pageFactory,
          DonorFactory $donorFactory,
          PickupFactory $pickupFactory,
          Data $helperOrder,
          CollectionFactory $itemCollection,
          LoggerInterface $logger

     ){
          $this->_pageFactory = $pageFactory;
          $this->donorFactory = $donorFactory;
          $this->pickupFactory = $pickupFactory;
          $this->helperOrder = $helperOrder;

          $this->itemCollection = $itemCollection;

          return parent::__construct($context);
     }
 
     /**
      * Index Donate action Page
      * @return type
      */
     public function execute()
     {  
            $data = (array) $this->getRequest()->getPost();
         
            if(count($data)){
              $orderInfo =[
                    'email'        => $data['email'], //customer email id
                    'currency_id'  => 'USD',
                    'shipping_address' =>[
                        'firstname'    => $data['donated_by'],
                        'lastname'     => $data['donated_by'],
                        'street' => $data['address'],
                        'city'=> $data['city'],
                        'country_id' => $data['country_id'],
                        'postcode' => $data['post_code'],
                        'telephone' => $data['phone_number'],
                        'save_in_address_book' => 1
                    ],
                    'items'=>
                            [
                             //simple product
                            [
                                'product_id' => $data['product_id'],
                                'qty' => $data['qty']
                            ]                            
                        ]
                ];
            $result = $this->helperOrder->createMyOrder($orderInfo);
            $this->logger->info($result);
              $pickup = $this->pickupFactory->create();
              $pickup->setProductSku($data['product_sku']);
              $pickup->setDescription($data['description']);
              $pickup->setDonatedBy($data['donated_by']);
              $pickup->setQty($data['qty']);
              $pickup->setAddress($data['address'].", ".$data['city'].", ".$data['country'].", ".$data['post_code']);
              $pickup->setStatus('pending');
              $donor = $this->donorFactory->create();
              $donor->setProductSku($data['product_sku']);
              $donor->setDescription($data['description']);
              $donor->setDonatedBy($data['donated_by']);
              $donor->setDonorType($data['donor_type']);
              $donor->setQty($data['qty']);
              $items = $this->itemCollection->create()->addFieldToSelect('*')->addFieldToFilter(  'product_sku',
              $data['product_sku']);
              foreach($items as $item):
               $qty = $item->getQty();
               $updatedQty = ($qty - $data['qty']);
               $item->setQty($updatedQty);
               $item->save();
              endforeach;
             
              $donor->save();
              $pickup->save();
              $response = [
                            'status' => 'request recieved'
                        ]; 
            }
            else{
              $response = [
                            'status' => 'request failed'
                        ]; 
            }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);  //create Json type return object
        $resultJson->setData($response); 
       return $resultJson;
    }    
}