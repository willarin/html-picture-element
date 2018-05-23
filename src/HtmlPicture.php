<?php
/**
 * @copyright Copyright (c) 2018 Almeyda LLC
 * @link https://github.com/deitsolutions/html-picture-element.git
 *
 * The full copyright and license information is stored in the LICENSE file distributed with this source code.
 */

namespace deitsolutions\htmlpicture\src;

use deitsolutions\fileversion\src\FileVersion;

/**
 * Class HtmlPicture renders picture tag according HTML specifications
 */
class HtmlPicture
{
    /**
     * @var string src attribute of the image tag
     */
    public static $src = '';
    
    /**
     * @var array image tag attributes
     */
    public static $attributes = ['alt' => ''];
    
    /**
     * @var array image types to be collected and rendered into picture tag
     */
    public static $sourceTypes = ['webp', 'jp2', 'jpx'];

    /**
     * form picture element
     * @param $config
     * @return string
     */
    public static function get($config)
    {
        //populate properties from configuration array
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                if (isset(self::${$key})) {
                    self::${$key} = $value;
                }
            }
        }
    
        $srcParts = pathinfo(self::$src);

        //collect attributes into string
        $attributesString = '';
        foreach (self::$attributes as $name => $value) {
            $attributesString .= ' ' . $name . '="' . $value . '"';
        }

        //form picture tag
        $html = '<picture>';
        foreach (self::$sourceTypes as $type) {
            $sourceSrc = str_replace('.' . $srcParts['extension'], '.' . $type, self::$src);
            if (file_exists(@$_SERVER['DOCUMENT_ROOT'] . $sourceSrc)) {
                $html .= '<source srcset = "' . FileVersion::set($sourceSrc) . '" type = "image/' . $type . '">';
            }
        }

        $html .= '<img src="' . FileVersion::set(self::$src) . '" ' . $attributesString . '>' . '</picture>';

        return $html;
    }
}
