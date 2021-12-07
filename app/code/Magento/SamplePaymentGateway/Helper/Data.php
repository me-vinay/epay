<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\SamplePaymentGateway\Helper;



/**
 * Checkout default helper
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $cartData;
    protected $productData;
    protected $productInterface;
    protected $Customer;

    public function __construct(
        \Magento\Checkout\Model\Cart $cartData,
        \Magento\Catalog\Model\Product $productData,
        \Magento\Catalog\Api\ProductRepositoryInterface $productInterface,
        \Magento\Customer\Model\Customer $Customer
    ){
        $this->_cart = $cartData;
        $this->productData = $productData;
        $this->productInterface = $productInterface;
        $this->Customer = $Customer;
    }
  
    public function getId(){

        $cart = $this->_cart;
        $itemsCollection = $cart->getQuote()->getItemsCollection();

        // get array of all items what can be display directly
        $itemsVisible = $cart->getQuote()->getAllVisibleItems();

        // retrieve quote items array
        $items = $cart->getQuote()->getAllItems();
        $vendorid = [];
        foreach($items as $i => $item) {
            $productsku = $item->getSku(); 
            $price = $item->getPrice();
            $qty = $item->getQty();
            $ammount = $price * $qty;
            $product = $this->productInterface->get($productsku);

            $customerID = $product->getData('creator_id');    
           
            $customerObj = $this->Customer->load($customerID);
            $vendorid[$i] = ['vendorEmail'=>$customerObj->getEpayerzWalletId(), 'amount'=> $ammount];
        }

        return ( $vendorid);
    }
}