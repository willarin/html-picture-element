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
     * @var array image types to be collected and rendered into picture tag
     */
    public static $sourceTypes;

    /**
     * @var array default image types
     */
    public static $defaultSourceTypes = ['webp', 'jp2', 'jpx'];

    /**
     * set image types
     * @param $sourceTypes
     */
    public static function setSouceTypes($sourceTypes)
    {
        if ($sourceTypes) {
            self::$sourceTypes = $sourceTypes;
        } elseif (!self::$sourceTypes) {
            self::$sourceTypes = self::$defaultSourceTypes;
        }
    }
    /**
     * form picture element
     * @param $src
     * @param mixin $attributes
     * @param mixin $sourceTypes
     * @return string
     */
    public static function get($src, $attributes = false, $sourceTypes = false)
    {
        $documentRoot = @$_SERVER['DOCUMENT_ROOT'];

        //check if the src file exists
        if (!@file_exists($documentRoot . $src)) {
            return '';
        }

        //populate properties from configuration array
        self::setSouceTypes($sourceTypes);

        $srcParts = pathinfo($src);

        //collect attributes into string
        $attributesString = '';
        if ($attributes && is_array($attributes)) {
            foreach ($attributes as $name => $value) {
                $attributesString .= ' ' . $name . '="' . $value . '"';
            }
        }

        //form picture tag
        $html = '<picture>';
        foreach (self::$sourceTypes as $type) {
            $sourceSrc = str_replace('.' . $srcParts['extension'], '.' . $type, $src);
            if (file_exists($documentRoot . $sourceSrc)) {
                $html .= '<source srcset = "' . FileVersion::get($sourceSrc) . '" type = "image/' . $type . '">';
            }
        }

        $html .= '<img src="' . FileVersion::get($src) . '" ' . $attributesString . '>' . '</picture>';

        return $html;
    }
}