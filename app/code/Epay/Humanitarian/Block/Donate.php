<?php
 /**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Block;

use \Magento\Framework\View\Element\Template\Context;

class Donate extends \Magento\Framework\View\Element\Template
{
    /**
     * 
     * @var type
     */
    private $data;
    
    /**
     * 
     * @param Context $context
     * @param array $data
     * @return type
     */
    public function __construct(
          Context $context,
          array $data = []
     ){
        return parent::__construct($context,$data);
     }
 
 }