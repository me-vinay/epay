<?php
/**
 * Copyright © 2016 Zealousweb. All rights reserved.
 */

namespace Zealousweb\GTranslator\Block;

use Magento\Framework\View\Element\Template;

/**
 * GTranslator Select
 */ 
class Select extends Template
{    
    /**
     * @return (string) default page language
     */
	public function getPageLanguage()
    {
        $pageLanguage = $this->_scopeConfig->getValue('gtranslator/general/page_language');

        if(!isset($pageLanguage))
        	$pageLanguage = 'en';

        return $pageLanguage;
    }

    /**
     * @return (string) list of comma separated language codes
     */
    public function getLanguagesIncluded()
    {
        $languageIncluded = $this->_scopeConfig->getValue('gtranslator/general/languages_included');

        if(!isset($languageIncluded))
        	$languageIncluded = 'en';

        return $languageIncluded;
    }

    /**
     * @return (string) list of comma separated language codes
     */
    public function getStyle()
    {
        $style = $this->_scopeConfig->getValue('gtranslator/design/custom_style');

        $position = $this->_scopeConfig->getValue('gtranslator/design/position');

        if($position != \Zealousweb\GTranslator\Model\Config\Source\Position::POSITON_NONE)
            $style .= "float: {$position};";

        return $style;
    }
}
