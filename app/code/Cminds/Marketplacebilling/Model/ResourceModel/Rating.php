<?php

namespace Cminds\Marketplacebilling\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rating extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('marketplace_supplier_rating', 'id');
    }
}
