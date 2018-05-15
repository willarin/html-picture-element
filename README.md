# Description

A simple PHP class to generate the HTML *<picture*> element



# Installation

Add the extension using composer:

"deitsolutions/html-picture-element": "dev-master"


#Usage 

```
\deitsolutions\htmlpicture\src\HtmlPicture::get($config);
```
Where $config is an associative array contains the next keys:
  - src - path to main image
  - sourceTypes - array of the image types to be collected into picture sources
  - attributes - "<image"> tag attributes

Example of usage:

```
\deitsolutions\htmlpicture\src\HtmlPicture::get([
    'src' => 'path/to/image.png'),
    'sourceTypes' => ['webp', 'jp2', 'jpx'],
    'attributes' => [
        'alt' => 'Image alt'
    ],
```