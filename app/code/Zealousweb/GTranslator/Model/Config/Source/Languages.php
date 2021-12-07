<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 */

/**
 * Used in creating options for Google Supported Language config value selection
 */
namespace Zealousweb\GTranslator\Model\Config\Source;

/**
 * GTranslator Languages
 */ 
class Languages implements \Magento\Framework\Option\ArrayInterface
{
      /**
      * Options getter
      *
      * @return array
      */
      public function toOptionArray()
      {
            return [
                  ['value' => 'af', 'label' => 'Afrikaans'], 
                  ['value' => 'sq', 'label' => 'Albanian'], 
                  ['value' => 'ar', 'label' => 'Arabic'], 
                  ['value' => 'hy', 'label' => 'Armenian'], 
                  ['value' => 'az', 'label' => 'Azerbaijani'], 
                  ['value' => 'eu', 'label' => 'Basque'], 
                  ['value' => 'be', 'label' => 'Belarusian'], 
                  ['value' => 'bn', 'label' => 'Bengali'], 
                  ['value' => 'bs', 'label' => 'Bosnian'], 
                  ['value' => 'bg', 'label' => 'Bulgarian'], 
                  ['value' => 'ca', 'label' => 'Catalan'], 
                  ['value' => 'ceb', 'label' => 'Cebuano'], 
                  ['value' => 'zh-CN', 'label' => 'Chinese'], 
                  ['value' => 'zh-TW', 'label' => 'Chinese (Traditional)'], 
                  ['value' => 'hr', 'label' => 'Croatian'], 
                  ['value' => 'cs', 'label' => 'Czech'], 
                  ['value' => 'da', 'label' => 'Danish'], 
                  ['value' => 'nl', 'label' => 'Dutch'], 
                  ['value' => 'en', 'label' => 'English'], 
                  ['value' => 'eo', 'label' => 'Esperanto'], 
                  ['value' => 'et', 'label' => 'Estonian'], 
                  ['value' => 'tl', 'label' => 'Filipino'], 
                  ['value' => 'fi', 'label' => 'Finnish'], 
                  ['value' => 'fr', 'label' => 'French'], 
                  ['value' => 'gl', 'label' => 'Galician'], 
                  ['value' => 'ka', 'label' => 'Georgian'], 
                  ['value' => 'de', 'label' => 'German'], 
                  ['value' => 'el', 'label' => 'Greek'], 
                  ['value' => 'gu', 'label' => 'Gujarati'], 
                  ['value' => 'ht', 'label' => 'Haitian'], 
                  ['value' => 'ha', 'label' => 'Hausa'], 
                  ['value' => 'iw', 'label' => 'Hebrew'], 
                  ['value' => 'hi', 'label' => 'Hindi'], 
                  ['value' => 'hmn', 'label' => 'Hmong'], 
                  ['value' => 'hu', 'label' => 'Hungarian'], 
                  ['value' => 'is', 'label' => 'Icelandic'], 
                  ['value' => 'ig', 'label' => 'Igbo'], 
                  ['value' => 'id', 'label' => 'Indonesian'], 
                  ['value' => 'ga', 'label' => 'Irish'], 
                  ['value' => 'it', 'label' => 'Italian'], 
                  ['value' => 'ja', 'label' => 'Japanese'], 
                  ['value' => 'jv', 'label' => 'Javanese'], 
                  ['value' => 'kn', 'label' => 'Kannada'], 
                  ['value' => 'km', 'label' => 'Khmer'], 
                  ['value' => 'ko', 'label' => 'Korean'], 
                  ['value' => 'lo', 'label' => 'Lao'], 
                  ['value' => 'la', 'label' => 'Latin'], 
                  ['value' => 'lv', 'label' => 'Latvian'], 
                  ['value' => 'lt', 'label' => 'Lithuanian'], 
                  ['value' => 'mk', 'label' => 'Macedonian'], 
                  ['value' => 'ms', 'label' => 'Malay'], 
                  ['value' => 'mt', 'label' => 'Maltese'], 
                  ['value' => 'mi', 'label' => 'Maori'], 
                  ['value' => 'mr', 'label' => 'Marathi'], 
                  ['value' => 'no', 'label' => 'Norwegian'], 
                  ['value' => 'fa', 'label' => 'Persian'], 
                  ['value' => 'pl', 'label' => 'Polish'], 
                  ['value' => 'pt', 'label' => 'Portuguese'], 
                  ['value' => 'pa', 'label' => 'Punjabi'], 
                  ['value' => 'ro', 'label' => 'Romanian'], 
                  ['value' => 'ru', 'label' => 'Russian'], 
                  ['value' => 'sr', 'label' => 'Serbian'], 
                  ['value' => 'sk', 'label' => 'Slovak'], 
                  ['value' => 'sl', 'label' => 'Slovenian'], 
                  ['value' => 'so', 'label' => 'Somali'], 
                  ['value' => 'es', 'label' => 'Spanish'], 
                  ['value' => 'sw', 'label' => 'Swahili'], 
                  ['value' => 'sv', 'label' => 'Swedish'], 
                  ['value' => 'ta', 'label' => 'Tamil'], 
                  ['value' => 'te', 'label' => 'Telugu'], 
                  ['value' => 'th', 'label' => 'Thai'], 
                  ['value' => 'tr', 'label' => 'Turkish'], 
                  ['value' => 'uk', 'label' => 'Ukrainian'], 
                  ['value' => 'ur', 'label' => 'Urdu'], 
                  ['value' => 'vi', 'label' => 'Vietnamese'], 
                  ['value' => 'cy', 'label' => 'Welsh'], 
                  ['value' => 'yi', 'label' => 'Yiddish'], 
                  ['value' => 'yo', 'label' => 'Yoruba'], 
                  ['value' => 'zu', 'label' => 'Zulu'] 
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
                  'af' => 'Afrikaans', 
                  'sq' => 'Albanian', 
                  'ar' => 'Arabic', 
                  'hy' => 'Armenian', 
                  'az' => 'Azerbaijani', 
                  'eu' => 'Basque', 
                  'be' => 'Belarusian', 
                  'bn' => 'Bengali', 
                  'bs' => 'Bosnian', 
                  'bg' => 'Bulgarian', 
                  'ca' => 'Catalan', 
                  'ceb' => 'Cebuano', 
                  'zh-CN' => 'Chinese', 
                  'zh-TW' => 'Chinese (Traditional)', 
                  'hr' => 'Croatian', 
                  'cs' => 'Czech', 
                  'da' => 'Danish', 
                  'nl' => 'Dutch', 
                  'en' => 'English', 
                  'eo' => 'Esperanto', 
                  'et' => 'Estonian', 
                  'tl' => 'Filipino', 
                  'fi' => 'Finnish', 
                  'fr' => 'French', 
                  'gl' => 'Galician', 
                  'ka' => 'Georgian', 
                  'de' => 'German', 
                  'el' => 'Greek', 
                  'gu' => 'Gujarati', 
                  'ht' => 'Haitian', 
                  'ha' => 'Hausa', 
                  'iw' => 'Hebrew', 
                  'hi' => 'Hindi', 
                  'hmn' => 'Hmong', 
                  'hu' => 'Hungarian', 
                  'is' => 'Icelandic', 
                  'ig' => 'Igbo', 
                  'id' => 'Indonesian', 
                  'ga' => 'Irish', 
                  'it' => 'Italian', 
                  'ja' => 'Japanese', 
                  'jv' => 'Javanese', 
                  'kn' => 'Kannada', 
                  'km' => 'Khmer', 
                  'ko' => 'Korean', 
                  'lo' => 'Lao', 
                  'la' => 'Latin', 
                  'lv' => 'Latvian', 
                  'lt' => 'Lithuanian', 
                  'mk' => 'Macedonian', 
                  'ms' => 'Malay', 
                  'mt' => 'Maltese', 
                  'mi' => 'Maori', 
                  'mr' => 'Marathi', 
                  'no' => 'Norwegian', 
                  'fa' => 'Persian', 
                  'pl' => 'Polish', 
                  'pt' => 'Portuguese', 
                  'pa' => 'Punjabi', 
                  'ro' => 'Romanian', 
                  'ru' => 'Russian', 
                  'sr' => 'Serbian', 
                  'sk' => 'Slovak', 
                  'sl' => 'Slovenian', 
                  'so' => 'Somali', 
                  'es' => 'Spanish', 
                  'sw' => 'Swahili', 
                  'sv' => 'Swedish', 
                  'ta' => 'Tamil', 
                  'te' => 'Telugu', 
                  'th' => 'Thai', 
                  'tr' => 'Turkish', 
                  'uk' => 'Ukrainian', 
                  'ur' => 'Urdu', 
                  'vi' => 'Vietnamese', 
                  'cy' => 'Welsh', 
                  'yi' => 'Yiddish', 
                  'yo' => 'Yoruba', 
                  'zu' => 'Zulu' 
            ];
      }
}
