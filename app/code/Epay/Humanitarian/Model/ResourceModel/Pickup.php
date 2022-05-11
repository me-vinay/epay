<?php

/**
 * Description of Donor
 *
 * @author neosoft
 */

namespace Epay\Humanitarian\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pickup extends AbstractDb {

    protected function _construct() {
        $this->_init('humanitarian_pickup_details', 'pickup_id');
    }

}
