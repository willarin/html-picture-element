<?php

namespace deitsolutions\htmlpicture\src;

use deitsolutions\versioning\src\FileVersioning;

class HtmlPicture
{
    /**
     * @var string src attribute of image tag
     */
    public $src = '';
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
     * @param $config
     * @return string
     */
    public function get($config)
    {
        //populate properties with configuration array
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                if (isset($this->{$key})) {
                    $this->{$key} = $value;
                }
            }
        }

        $srcParts = pathinfo($this->src);

        //collect attributes into string
        $attributesString = '';
        foreach ($this->attributes as $name => $value) {
            $attributesString .= ' ' . $name . '="' . $value . '"';
        }

        //form picture tag
        $html = '<picture>';
        foreach ($this->sourceTypes as $type) {
            $sourceSrc = str_replace('.' . $srcParts['extension'], '.' . $type, $this->src);
            if (file_exists(__DIR__ . $sourceSrc)) {
                $html .= '<source srcset = "' . FileVersioning::set($sourceSrc) . '" type = "image/' . $type . '">';
            }
        }

        $html .= '<img src="' . FileVersioning::set($this->src) . '" ' . $attributesString . '>' . '</picture>';

        return $html;
    }
}