<?php

/**
 * Description of Collection
 *
 * @author neosoft
 */
namespace Epay\Humanitarian\Model\ResourceModel\Items;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \Epay\Humanitarian\Model\Items as Model;
use \Epay\Humanitarian\Model\ResourceModel\Items as ResourceModel;

class Collection extends AbstractCollection {

    protected function _construct() {
        $this->_init(Model::class, ResourceModel::class);
    }

}