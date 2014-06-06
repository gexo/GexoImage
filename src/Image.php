<?php
/**
 * GexoImage
 * 
 * Copyright (c) 2014 Stefan Oswald [github@gexo.de]
 * https://github.com/gexo/GexoImage
 * 
 * The MIT License (MIT)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace gexo\image;

use gexo\image\exception\GexoImageInputException;

/**
 * Container class for an image. Offers direct access to all relevant image properties like dimensions, MIME type, etc.
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class Image {
  
  /**
   *
   * @var string
   */
  private $imagePath = '';
  
  /**
   *
   * @var integer
   */
  private $width = 0;
  
  /**
   *
   * @var integer
   */
  private $height = 0;
  
  /**
   *
   * @var integer
   */
  private $imageType = 0;
  
  /**
   *
   * @var string
   */
  private $mimeType = '';
  
  /**
   *
   * @var integer
   */
  private $bits = 0;
  
  /**
   *
   * @var integer
   */
  private $channels = 0;
  
  /**
   *
   * @var boolean
   */
  private $processed = false;
  
  /**
   * Initialize an Image entity using a given image path or URI. Calling the constructor won't actually process the 
   * image - this is done in a "lazy" manner, meaning that the image will only be processed if any properties are
   * accessed by using one of the classe's getter methods.
   * 
   * @param string $imagePath Referencing a local file or (configuration permitting) a remote file using one of the supported streams. 
   */
  public function __construct($imagePath) {
    $this->setImagePath($imagePath);
  }
  
  /**
   * Get the image path (local path or URI)
   * 
   * @return string
   */
  public function getImagePath() {
    return $this->imagePath;
  }

  /**
   * Set the image path (local path or URI)
   * 
   * @param string $imagePath
   * @return Image
   */
  public function setImagePath($imagePath) {
    $this->imagePath = (string) $imagePath;
    return $this;
  }

  /**
   * Get the image's width in pixel
   * 
   * @return integer
   * @throws GexoImageInputException If image could not be processed
   */
  public function getWidth() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->width;
  }

  /**
   * Set the image's width in pixel
   * 
   * @param integer $width
   * @return Image
   */
  public function setWidth($width) {
    $this->width = (integer) $width;
    return $this;
  }

  /**
   * Get the image's height in pixel
   * 
   * @return integer
   * @throws GexoImageInputException If image could not be processed
   */
  public function getHeight() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->height;
  }

  /**
   * Set the image's height in pixel
   * 
   * @param integer $height
   * @return Image
   */
  public function setHeight($height) {
    $this->height = (integer) $height;
    return $this;
  }

  /**
   * Get image type in form of a PHP's IMAGETYPE_xxxxx constant
   * 
   * @return integer
   * @throws GexoImageInputException If image could not be processed
   */
  public function getImageType() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->imageType;
  }

  /**
   * Set image type in form of a PHP's IMAGETYPE_xxxxx constant
   * 
   * @param integer $imageType
   * @return Image
   */
  public function setImageType($imageType) {
    $this->imageType = (integer) $imageType;
    return $this;
  }

  /**
   * Get image's MIME type as string, e.g. "mime/jpeg"
   * 
   * @return string
   * @throws GexoImageInputException If image could not be processed
   */
  public function getMimeType() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->mimeType;
  }

  /**
   * Set image's MIME type as string, e.g. "mime/jpeg"
   * 
   * @param string $mimeType
   * @return Image
   */
  public function setMimeType($mimeType) {
    $this->mimeType = (string) $mimeType;
    return $this;
  }

  /**
   * Get the image's number of bits per pixel
   * 
   * @return integer
   * @throws GexoImageInputException If image could not be processed
   */
  public function getBits() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->bits;
  }

  /**
   * Set the image's number of bits per pixel
   * 
   * @param integer $bits
   * @return Image
   */
  public function setBits($bits) {
    $this->bits = (integer) $bits;
    return $this;
  }

  /**
   * Get number of image's channels - will be 3 for RGB pictures and 4 for CMYK pictures
   * 
   * @return integer
   * @throws GexoImageInputException If image could not be processed
   */
  public function getChannels() {
    if(!$this->getProcessed()) {
      $this->processImage();
    }
    return $this->channels;
  }

  /**
   * Set number of image's channels
   * 
   * @param integer $channels
   * @return Image
   */
  public function setChannels($channels) {
    $this->channels = (integer) $channels;
    return $this;
  }
  
  /**
   * Get the info whether the image was already read from the given path and processed or not
   * 
   * @return boolean
   */
  public function getProcessed() {
    return $this->processed;
  }

  /**
   * Set the info whether the image was already read from the given path and processed or not. Intended to be set
   * only internally.
   * 
   * @param boolean $processed
   * @return Image
   */
  public function setProcessed($processed) {
    $this->processed = $processed === true;
    return $this;
  }
  
  /**
   * Process the given image, using PHP's getimagesize() method.
   * 
   * The error control operator is used on getimagesize() intentionally so that we can deal with any error by using
   * an exception.
   * 
   * @throws GexoImageInputException Thrown if getimagesize() did not work
   */
  private function processImage() {
    $imageData = @getimagesize($this->getImagePath());
    
    if(!is_array($imageData) || empty($imageData)) {
      throw new GexoImageInputException('Image cannot be read or parsed');
    }
    
    $this
      ->setWidth($imageData[0])
      ->setHeight($imageData[1])
      ->setImageType($imageData[2]);

    if(array_key_exists('bits', $imageData)) {
      $this->setBits($imageData['bits']);
    }

    if(array_key_exists('channels', $imageData)) {
      $this->setChannels($imageData['channels']);
    }

    if(array_key_exists('mime', $imageData)) {
      $this->setMimeType($imageData['mime']);
    }

    $this->setProcessed(true);
  }

}
