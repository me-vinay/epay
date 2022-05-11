<?php

namespace Cminds\Marketplacebilling\Model;

class Rating extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Cminds\Marketplacebilling\Model\ResourceModel\Rating');
    }
}
