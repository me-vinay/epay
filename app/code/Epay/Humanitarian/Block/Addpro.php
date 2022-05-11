<?php
/**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Block;
use  \Magento\Framework\View\Element\Template\Context;
class Addpro extends \Magento\Framework\View\Element\Template
{
    /**
     * Constructor
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
       }

    /**
     * Get form action URL for POST addpro request
     *
     * @return string
     */
    public function getFormAction()
    {

        return  $this->getUrl('human/index/saveproduct', ['_secure' => true]); 
    }

}