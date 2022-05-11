<?php

namespace Cminds\Marketplacebilling\Block\Adminhtml\Supplier\Customfields;

use Magento\Backend\Block\Widget\Form\Container;

class Form extends Container
{
    public function _construct()
    {
        parent::_construct();

        $this->_controller = 'adminhtml_supplier_customfields';
        $this->_blockGroup = 'Cminds_Marketplacebilling';
        $this->_mode = 'edit';

        $newOrEdit = $this->getRequest()->getParam('id')
            ? __('Edit')
            : __('New');
        $this->_headerText = $newOrEdit . ' ' . __('Custom Field');

        $this->removeButton('add');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl(
            '*/*/deletecustomfield',
            ['id' => $this->getRequest()->getParam('id')]
        );
    }
}
