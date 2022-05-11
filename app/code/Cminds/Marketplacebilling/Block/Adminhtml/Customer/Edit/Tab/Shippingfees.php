<?php

namespace Cminds\Marketplacebilling\Block\Adminhtml\Customer\Edit\Tab;

use Cminds\Marketplacebilling\Helper\Data as HelperData;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Ui\Component\Layout\Tabs\TabWrapper;

class Shippingfees extends TabWrapper
{
    protected $coreRegistry = null;
    protected $isAjaxLoaded = true;
    protected $helperData;

    public function __construct(
        Context $context,
        Registry $registry,
        HelperData $helperData,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $helperData;
        $this->coreRegistry = $registry;
    }

    public function canShowTab()
    {
        $id = $this->_request->getParam('id');
        if ($this->helperData->isSupplier($id)) {
            return true;
        }

        return false;
    }

    /**
     * Return Tab label
     *
     * @codeCoverageIgnore
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Shipping Costs');
    }

    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        return $this->getUrl(
            'marketplacebilling/customer/shippingfees',
            ['_current' => true]
        );
    }
}
