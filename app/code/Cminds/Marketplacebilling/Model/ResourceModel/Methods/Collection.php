<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Methods;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Methods',
            'Cminds\Marketplacebilling\Model\ResourceModel\Methods'
        );
    }
}
