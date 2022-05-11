<?php

/**
 * Description of Collection
 *
 * @author neosoft
 */
namespace Epay\Humanitarian\Model\ResourceModel\Pickup;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Epay\Humanitarian\Model\Pickup as Model;
use \Epay\Humanitarian\Model\ResourceModel\Pickup as ResourceModel;

class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(Model::class, ResourceModel::class);
    }

}

