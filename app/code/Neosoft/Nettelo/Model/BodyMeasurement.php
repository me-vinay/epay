<?php
namespace Neosoft\Nettelo\Model;

use Neosoft\Nettelo\Api\BodyMeasurementInterface;

class BodyMeasurement implements BodyMeasurementInterface
{
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->_request = $request;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheridoc
     * @param mixed[] $ExternalId
     * @return string
     */
    public function bodyMeasurement($ExternalId) {
        $accessToken = $this->scopeConfig->getValue("system/nettelo_access_token/access_token",
        \Magento\Store\Model\ScopeInterface::SCOPE_STORE,$this->storeManager->getStore()->getStoreId());
        $validheader = $this->_request->getHeader('ntws-secret');
        if($validheader == $accessToken){
          $data = $this->_request->getBodyParams();
        // echo "<pre>"; print_r(gettype(json_encode($data))); die;
          return json_encode($data);//"Body Data Recieved!";
        }
        else{
            return $validheader;
        }
        //$data = json_decode($data);
        //echo "<pre>"; print_r($data); die;
        
    }
}