<?php
/**
 * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\ProductFactory;
use Epay\Humanitarian\Model\ItemsFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Delete extends Action
{
    /**
     *  @var PageFactory
     * 
     */
    protected $pageFactory;

    /**
     * @var type
     */
    protected $productFactory;

    /**
     * @var type
     */
    private $itemFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;
     
    /**
     * Prolist Constructor.
     * 
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ProductFactory $productFactory
     * @param ItemsFactory $itemFactory
     * @param Filesystem $filesystem
     */
  
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ProductFactory $productFactory,
        ItemsFactory $itemFactory,
        Filesystem $filesystem
    )
    {
        $this->pageFactory = $pageFactory;
        $this->productFactory = $productFactory;
        $this->itemFactory = $itemFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }

    /**
     * Index Process Action.
     * 
     * @return type
     */
    public function execute()
    { 
        $id = $this->getRequest()->getParam('id');
        if($id){
            $item = $this->itemFactory->create()->load($id);
            $item->setStatus(2);
            if ($item->save()) {
                $this->messageManager->addSuccessMessage(__('Request Cancelled'));
            }   
            else {
                $this->messageManager->addErrorMessage(__('Something went wrong, Please try again.'));
            }   
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('human/index/prolist');
            return $resultRedirect; 
        }
      
    }

}