<?php

namespace Cminds\Marketplacebilling\Model;

use Magento\Framework\Model\AbstractModel;

class Payment extends AbstractModel
{
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('Cminds\Marketplacebilling\Model\ResourceModel\Payment');
    }
}
