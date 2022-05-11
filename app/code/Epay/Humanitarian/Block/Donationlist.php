<?php

/**
 * Copyright © Epayerz, Inc. All rights reserved.
 */

namespace Epay\Humanitarian\Block;

use \Magento\Framework\View\Element\Template\Context;
use \Epay\Humanitarian\Model\ResourceModel\Donor\CollectionFactory;

class Donationlist extends \Magento\Framework\View\Element\Template {

    /**
     * 
     * @var type
     */
    private $data;

    /**
     * 
     * @var type
     */
    private $donorCollection;

    /**
     * 
     * @param Context $context
     * @param CollectionFactory $donorCollection
     * @param array $data
     * @return type
     */
    public function __construct(
            Context $context,
            CollectionFactory $donorCollection,
            array $data = []
    ) {
        $this->donorCollection = $donorCollection;
        return parent::__construct($context, $data);
    }


    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getDonorCollection()) {
            $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'custom.history.pager'
            )->setAvailableLimit([10 => 10, 15 =>15, 20 => 20])
            ->setShowPerPage(true)->setCollection(
            $this->getDonorCollection()
            );
            $this->setChild('pager', $pager);
            $this->getDonorCollection()->load();
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
     * 
     * @return type
     */
    public function getDonorCollection() {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 10;
        $collection = $this->donorCollection->Create();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

}