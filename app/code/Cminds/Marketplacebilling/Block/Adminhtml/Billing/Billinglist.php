<?php

namespace Cminds\Marketplacebilling\Block\Adminhtml\Billing;

use Magento\Backend\Block\Widget\Grid\Container;

class Billinglist extends Container
{
    public function _construct()
    {
        $this->_controller = 'adminhtml_billing_billinglist';
        $this->_blockGroup = 'Cminds_Marketplacebilling';
        $this->_headerText = __('Marketplace Billing Report');

        parent::_construct();

        $this->removeButton('add');
    }
}
