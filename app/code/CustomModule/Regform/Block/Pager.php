<?php

namespace Epay\Humanitarian\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
//use Epay\Humanitarian\Model\Donor;          use your model
 class Pager extends Template
{
    protected $donorCollection;
    protected $priceHepler;
    public function __construct(Context $context)
    {
      //  $this->donorCollection = $donorCollection;
        $this->priceHepler = $priceHepler;
        parent::__construct($context);
    }
   /* protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom Pagination'));
        if ($this->getdonorCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([ 2 => 2])
                ->setShowPerPage(true)->setCollection(
                    $this->getdonorCollection()
                );
            $this->setChild('pager', $pager);
            $this->getdonorCollection()->load();
        }
        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getdonorCollection()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(
            
        )->getParam('limit') : 2;
        $collection = $this->donorCollection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }*/
   
}
