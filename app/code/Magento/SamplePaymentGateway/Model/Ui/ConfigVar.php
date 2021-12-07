<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\SamplePaymentGateway\Model\Ui;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\SamplePaymentGateway\Helper\Data;
// use Magento\SamplePaymentGateway\Gateway\Http\Client\ClientMock;

/**
 * Class ConfigProvider
 */
class ConfigVar implements ConfigProviderInterface
{
    protected $helper;

    public function __construct(Data $helper){
        $this->helper = $helper;
    }
    // const CODE = 'sample_gateway';

    // /**
    //  * Retrieve assoc array of checkout configuration
    //  *
    //  * @return array
    //  */

    public function getConfig()
    {
       
        $output['custom_data'] = $this->getVendorId();
        return $output;
    }
    protected function getVendorId(){
        return ($this->helper->getId());
    }
}