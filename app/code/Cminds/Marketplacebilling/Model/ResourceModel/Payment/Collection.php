<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel\Payment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            'Cminds\Marketplacebilling\Model\Payment',
            'Cminds\Marketplacebilling\Model\ResourceModel\Payment'
        );
    }
}
