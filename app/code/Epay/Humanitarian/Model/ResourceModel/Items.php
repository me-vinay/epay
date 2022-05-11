<?php

/**
 * Description of Donor
 *
 * @author neosoft
 */

namespace Epay\Humanitarian\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Items extends AbstractDb {

    protected function _construct() {
        $this->_init('humanitarian_product_details', 'product_id');
    }

}
