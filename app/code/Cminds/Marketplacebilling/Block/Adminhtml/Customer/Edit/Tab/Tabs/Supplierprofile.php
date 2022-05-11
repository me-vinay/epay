<?php

namespace Cminds\Marketplacebilling\Block\Adminhtml\Customer\Edit\Tab\Tabs;

use Magento\Backend\Block\Widget\Form\Container;

class Supplierprofile extends Container
{

    public function _construct()
    {
        parent::_construct();

        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_customer_edit_tab_tabs_supplierprofile';
        $this->_blockGroup = 'Cminds_Marketplacebilling';
    }

    public function getHeaderHtml()
    {
        return '';
    }
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-page';
    }
}
