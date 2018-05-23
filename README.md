# Description

A simple PHP class to generate the HTML *<picture*> element with different source types supported. 
It could be used for optimization of image rendering depending on the browser supporting one or another 
image format.

# Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Place **composer.phar** file in the same directory with **composer.json** file and run

```
$ php composer.phar require deitsolutions/html-picture-element "dev-master"
```

or add

```
{
    ...
    "require": {
        ...
        "deitsolutions/html-picture-element": "dev-master"
        ...
    }
    ...
}
```

to the *"require"* section of your `composer.json` file and run

```
$ php composer.phar update
```

# Usage 

```
\deitsolutions\htmlpicture\src\HtmlPicture::get($configPictureTag);
```
Where $configPictureTag is an associative array contains the next keys:
  - src - path to main image
  - sourceTypes - array of the image types to be collected into picture sources
  - attributes - "<image"> tag attributes

### Example of usage:

```
\deitsolutions\htmlpicture\src\HtmlPicture::get([
    'src' => 'path/to/image.png'),
    'sourceTypes' => ['webp', 'jp2', 'jpx'],
    'attributes' => [
        'alt' => 'Image alt'
    ],
```

This produces an output like

```
\deitsolutions\htmlpicture\src\HtmlPicture::get([
    'src' => 'path/to/image.png'),
    'sourceTypes' => ['webp', 'jp2', 'jpx'],
    'attributes' => [
        'alt' => 'Image alt'
    ],
```