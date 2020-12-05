# Description

A simple PHP class to generate the HTML *<picture*> element with different source types supported. 
It could be used for optimization of image rendering depending on the browser supporting one or another 
image format.

# Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Place **composer.phar** file in the same directory with **composer.json** file and run

```
$ php composer.phar require almeyda/html-picture-element "*"
```

or add

```
{
    ...
    "require": {
        ...
        "almeyda/html-picture-element": "dev-master"
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
\almeyda\htmlpicture\src\HtmlPicture::get($src, $attributes, $sourceTypes);
```
Where:
  - src - path to main image
  - attributes - "<image"> tag attributes
  - sourceTypes - array of the image types to be collected into picture sources
  
### Example of usage:

```
\almeyda\htmlpicture\src\HtmlPicture::get('path/to/image.png', ['alt' => 'Image alt'], ['webp', 'jp2', 'jpx']),
```


This produces an output like

```
<picture>
    <source srcset="path/to/image.webp?v=1527278990" type="image/webp">
    <source srcset="path/to/image.jp2?v=1527278990" type="image/jp2">
    <source srcset="path/to/image.jpx?v=1527278990" type="image/jpx">
    <img src="path/to/image.png?v=1527278990" alt="Image alt">
</picture>
```


You can define image types to be collected and rendered into picture tag once using a method setSouceTypes

```
\almeyda\htmlpicture\src\HtmlPicture::setSouceTypes(['webp', 'jp2', 'jpx']);

...

\almeyda\htmlpicture\src\HtmlPicture::get('path/to/image1.png'),

\almeyda\htmlpicture\src\HtmlPicture::get('path/to/image2.png'),
```