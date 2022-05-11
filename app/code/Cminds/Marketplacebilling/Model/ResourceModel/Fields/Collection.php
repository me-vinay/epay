<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Fields;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Fields',
            'Cminds\Marketplacebilling\Model\ResourceModel\Fields'
        );
    }
}
