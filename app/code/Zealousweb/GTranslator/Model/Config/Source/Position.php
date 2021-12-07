<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 */

/**
 * Used in creating options for Google Supported Language config value selection
 */
namespace Zealousweb\GTranslator\Model\Config\Source;

/**
 * GTranslator Position
 */ 
class Position implements \Magento\Framework\Option\ArrayInterface
{
      CONST POSITON_LEFT = "left";
      CONST POSITON_RIGHT = "right";
      CONST POSITON_NONE = "none";

      /**
      * Options getter
      *
      * @return array
      */
      public function toOptionArray()
      {
            return [
                  ['value' => self::POSITON_LEFT, 'label' => __('Left')], 
                  ['value' => self::POSITON_RIGHT, 'label' => __('Right')], 
                  ['value' => self::POSITON_NONE, 'label' => __('None')]
            ];
      }

      /**
      * Get options in "key-value" format
      *
      * @return array
      */
      public function toArray()
      {

            return [
                  self::POSITON_LEFT => __('Left'), 
                  self::POSITON_RIGHT => __('Right'), 
                  self::POSITON_NONE => __('None')
            ];
      }
}

