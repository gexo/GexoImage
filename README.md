GexoImage
=========

A library wrapper for image manipulation tasks, implemented in PHP 5.3.

Currently supported manipulations:

* resize - with keeping aspect ratio
* resize - without keeping aspect ratio
* crop

NOTE: This project is currently in early development state. More manipulations will be added shortly.

The code is tested with PHPUnit.

PHP image manipulation libraries
--------------------------------

The module is designed to support multiple PHP image manipulation libraries. 
Currently, only php5-gd support is implemented.

Image type support
------------------

Currently the folowing INPUT image types are supported:

* JPEG (IMAGETYPE_JPEG)
* PNG (IMAGETYPE_PNG)
* GIF (IMAGETYPE_GIF)

Currently the folowing OUTPUT image types are supported:

* JPEG (IMAGETYPE_JPEG)

Planned features
----------------

* Add more manipulations, such as "rotate" ang "greyscale"
* Support for writing PNG and GIF files
* Support for other image manipulation libraries, e.g. php5-imagick
* Add output filters, e.g. to further reduce output file size
* Add other writers, e.g. to write on a stream or to just output the binary image data on-the-fly without writing files

Basic usage
-----------

Sample code:

```php
$inputFile = __DIR__ . '/input.jpg';
$outputFile = __DIR__ . '/output.jpg';

$adapter = new \gexo\image\adapter\GdAdapter();
$writer = new \gexo\image\writer\gd\file\JpegWriter(30);
$transformerContainer = new \gexo\image\container\GdTransformerContainer();

$gexoImage = new \gexo\image\GexoImage(
   $inputFile, $outputFile, 
   $adapter, $writer, $transformerContaine
 );
$response = $gexoImage->resize(300, 200, false);
```

Q: What does it do?
A: It reads in the input.jpg file, resizes it to 300x200 pixels (overwriting the original file's aspect ratio) and writes the output down as a JPEG filen amed output.jpg with quality setting 30 of 100, using the php5-gd library.
