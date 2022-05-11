<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Torate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Torate',
            'Cminds\Marketplacebilling\Model\ResourceModel\Torate'
        );
    }
}
