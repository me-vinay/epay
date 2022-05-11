<?php

/**
 * Description of Donor
 *
 * @author neosoft
 */


namespace Epay\Humanitarian\Model;

use Magento\Framework\Model\AbstractModel;
use Epay\Humanitarian\Model\ResourceModel\Donor as ResourceModel;

class Donor extends AbstractModel {

    protected function _construct() {
        $this->_init(ResourceModel::class);
    }

}