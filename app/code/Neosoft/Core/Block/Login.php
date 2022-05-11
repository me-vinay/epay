<?php

namespace Neosoft\Core\Block;

class Login extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = []
    ) {
        $this->httpContext = $httpContext;
        parent::__construct($context, $data);
    }
 
    /*
     * return bool
     */
    public function getLogin() {
        print_r($this->httpContext->isLoggedIn());
    }
}