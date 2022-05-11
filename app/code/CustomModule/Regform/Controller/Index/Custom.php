<?php
 /**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace CustomModule\Regform\Controller\Index;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Action;

 class Custom extends Action
{
     /**
      * @var PageFactory
      */
     protected $_pageFactory;
   
     /** 
      * @param  Context $context,
      * @param PageFactory $pageFactory
      */
     public function __construct(
          Context $context,
          PageFactory $pageFactory
     ){
          $this->_pageFactory = $pageFactory;
          return parent::__construct($context);
     }
 
     /**
      * Index Donate action.
      * @return Page
      */
     public function execute()
     {
         return  $this->_pageFactory->create();   
     }

    
}