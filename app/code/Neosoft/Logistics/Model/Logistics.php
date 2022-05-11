<?php
namespace Neosoft\Logistics\Model;

use  Magento\Checkout\Model\Session;
use Magento\Catalog\Model\ProductFactory;
class Logistics
{

protected $cartSession;

protected $productfactory;
    public function __construct(
      Session $cartSession, 
      ProductFactory $productfactory
  ) {
    $this->productfactory = $productfactory;
    $this->cartSession = $cartSession;
  }

  /**
   * @return float|null
   */
    public function getProductQnt(){

      $totalWeight = 0;
      $items = $this->cartSession->getQuote()->getAllVisibleItems();
     
      foreach($items as $item){
         $productId = $item->getProductId();
       $product = $this->productfactory->create()->load($productId);
       if($this->getSupplierIdFromOrderItems($product)){
       $proWeight =$product->getWeight()*$item->getQty();
         $totalWeight += $proWeight;
      
      }
    }
    return $totalWeight;
 
    }
     /**
     * @param $product
     * @return bool
     */
    protected function getSupplierIdFromOrderItems($product)
    {
      if ($product->getCreatorId() !== null) {
        return true;
            
        }
        return false;
    }
}