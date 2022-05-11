<?php

namespace Cminds\Marketplacebilling\Block\Adminhtml\Billing\Billinglist;

use Magento\Backend\Block\Widget\Form\Container;

class Form extends Container
{
    public function _construct()
    {
        parent::_construct();

        $this->_controller = 'adminhtml_billing_billinglist';
        $this->_blockGroup = 'Cminds_Marketplacebilling';
        $this->_mode = 'edit';

        $this->removeButton('add');
        $this->buttonList->update('save', 'label', __('Create Manual Payment'));
    }
}
