<?php

/**
 * Description of Donor
 *
 * @author neosoft
 */

namespace Epay\Humanitarian\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Donor extends AbstractDb {

    protected function _construct() {
        $this->_init('humanitarian_donor', 'donor_id');
    }

}
