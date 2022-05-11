<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Rates;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Rates',
            'Cminds\Marketplacebilling\Model\ResourceModel\Rates'
        );
    }
}
