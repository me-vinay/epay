<?php

/**
 * Description of Donor
 *
 * @author neosoft
 */


namespace Epay\Humanitarian\Model;

use Magento\Framework\Model\AbstractModel;
use Epay\Humanitarian\Model\ResourceModel\Items as ResourceModel;

class Items extends AbstractModel {

    protected function _construct() {
        $this->_init(ResourceModel::class);
    }

}
