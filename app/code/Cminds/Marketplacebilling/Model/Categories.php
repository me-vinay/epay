<?php

namespace Cminds\Marketplacebilling\Model;

class Categories extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Cminds\Marketplacebilling\Model\ResourceModel\Categories');
    }
}
