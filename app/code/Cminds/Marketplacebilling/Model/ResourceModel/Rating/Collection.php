<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Rating;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Rating',
            'Cminds\Marketplacebilling\Model\ResourceModel\Rating'
        );
    }
}
