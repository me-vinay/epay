<?php
/**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Block;

use \Magento\Framework\View\Element\Template\Context;
use \Epay\Humanitarian\Model\ResourceModel\Pickup\CollectionFactory;

class Pickuplist extends \Magento\Framework\View\Element\Template
{
    /**
     * 
     * @var type
     */
    private $data;
    
    /**
     * 
     * @var type
     */
    private $pickupCollection;
    
    /**
     * 
     * @param Context $context
     * @param CollectionFactory $pickupCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $pickupCollection,
        array $data = []
    )
    {
        $this->pickupcollection = $pickupCollection;
        parent::__construct($context, $data);
       }


        /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getPickupCollection()) {
            $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'custom.history.pager'
            )->setAvailableLimit([10 => 10, 15 =>15, 20 => 20])
            ->setShowPerPage(true)->setCollection(
            $this->getPickupCollection()
            );
            $this->setChild('pager', $pager);
            $this->getPickupCollection()->load();
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
    public function getPickupCollection() {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 10;
        $collection = $this->pickupcollection->Create();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
       // $pickupList = $this->pickupcollection->Create();
        //return $pickupList->getdata();
    }
}