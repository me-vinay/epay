<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Categories;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Categories',
            'Cminds\Marketplacebilling\Model\ResourceModel\Categories'
        );
    }
}
