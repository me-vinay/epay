<?php
/**
 * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Pickuplist extends Action
{
    /** @var PageFactory */
    protected $pageFactory;
    
    /**
     * Pickuplist Constructor.
     * 
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
     * Index Pickuplist Action.
     * 
     * @return Page
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }
}