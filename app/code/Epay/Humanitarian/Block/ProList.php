<?php

namespace Epay\Humanitarian\Block;
/**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Store\Model\ScopeInterface;
use \Epay\Humanitarian\Model\ResourceModel\Items\CollectionFactory;

class ProList extends Template
{
     /**
     * 
     * @var type
     */
    private $itemCollection;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
  
    /**
     * 
     * @param Context $context
     * @param CollectionFactory $itemCollection
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $itemCollection,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->itemCollection = $itemCollection;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

  
   /**
     * 
     * @return string
     */
    public function getPosturl()
    {

        return  $this->getUrl('human/index/donate', ['_secure' => true]); 
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getCollection()) {
            $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'custom.history.pager'
            )->setAvailableLimit([10 => 10, 15 =>15, 20 => 20])
            ->setShowPerPage(true)->setCollection(
            $this->getCollection()
            );
            $this->setChild('pager', $pager);
            $this->getCollection()->load();
        }
            return $this;
    }

    /**
     * @return html
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * Get Items collection
     * 
     * @return array
     */
    public function getCollection(){
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 10;
        $collection = $this->itemCollection->Create();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    /**
     * Get Media Url
     * @return string
     */
    public function getMediaUrl()
    {
       $mediaUrl = $this->scopeConfig->getValue('web/unsecure/base_url',ScopeInterface::SCOPE_STORE,$this->storeManager->getDefaultStoreView()->getWebsiteId());
        return $mediaUrl.'pub/media/';
    }

    /**
     * Get Process action
     * @return string
     */
    public function getProcessAction()
    {
        return  $this->getUrl('human/index/process', ['_secure' => true]); 

    }


    /**
     * Get Process action
     * @return string
     */
    public function getDeleteAction()
    {
        return  $this->getUrl('human/index/delete', ['_secure' => true]); 

    }
}