<?php
/**
 * Application entry point
 *
 * Example - run a particular store or website:
 * --------------------------------------------
 * require __DIR__ . '/app/bootstrap.php';
 * $params = $_SERVER;
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'website2';
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
 * $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
 * \/** @var \Magento\Framework\App\Http $app *\/
 * $app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
 * $bootstrap->run($app);
 * --------------------------------------------
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

try {
    require __DIR__ . '/app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}

//$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
$params = $_SERVER;
if($_SERVER['HTTP_HOST'] == 'agri.epayerz.local'){
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'base';
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
}
else{
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'Ukraine'; 
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'ua_uastore';
    $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';    
}
// switch($_SERVER['HTTP_HOST']) {
//     case 'agri.epayerz.com':
//     print('b');
//     $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'base';
//     $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
//     break;
//     case 'epzmart.com':
//     print('c');
//        $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'Ukraine';
//        $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
//     break; 
// }

$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
/** @var \Magento\Framework\App\Http $app */
$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
$bootstrap->run($app);