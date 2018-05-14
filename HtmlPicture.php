<?php

namespace app\modules\common\components;

use deitsolutions\versioning\src\FileVersioning;

class HtmlPicture
{
    /**
     * @var array image tag attributes
     */
    public $attributes = ['alt' => ''];
    /**
     * @var array image types to be collected into picture sources
     */
    public $sourceTypes = ['webp', 'jp2', 'jpx'];

    /**
     * get picture element
     * @param $src
     * @return string
     */
    public function get($src)
    {
        $srcParts = pathinfo($src);

        //collect attributes into string
        $attributesString = '';
        foreach ($this->attributes as $name => $value) {
            $attributesString .= ' ' . $name . '="' . $value . '"';
        }

        //form picture tag
        $html = '<picture>';
        foreach ($this->sourceTypes as $type) {
            $sourceSrc = str_replace('.' . $srcParts['extension'], '.' . $type, $src);
            if (file_exists(__DIR__ . $sourceSrc)) {
                $html .= '<source srcset = "' . FileVersioning::set($sourceSrc) . '" type = "image/' . $type . '">';
            }
        }

        $html .= '<img src="' . FileVersioning::set($src) . '" ' . $attributesString . '>' . '</picture>';

        return $html;
    }
}