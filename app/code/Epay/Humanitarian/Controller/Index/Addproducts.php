<?php
 /**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Addproducts extends Action
{
    /** @var PageFactory */
    protected $pageFactory;

   /**
    * @param Context $context
    * @param PageFactory $pageFactory
    */

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * Index Addproducts action.
     * @return Page
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}