<?php

/**
 * Description of Collection
 *
 * @author neosoft
 */
namespace Epay\Humanitarian\Model\ResourceModel\Donor;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Epay\Humanitarian\Model\Donor as Model;
use \Epay\Humanitarian\Model\ResourceModel\Donor as ResourceModel;

class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(Model::class, ResourceModel::class);
    }

}

