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

namespace gexo\image\transformer\gd;

use gexo\image\adapter\iAdapter;
use gexo\image\Image;
use gexo\image\transformer\gd\iGdTransformer;
use gexo\image\transformer\gd\Resizer;
use gexo\image\transformer\iResizer;

/**
 * This transformer implementation can resize an image to the desired width and height.
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class Resizer implements iGdTransformer, iResizer {
  
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
   * @var boolean
   */
  private $proportional = true;
  
  /**
   * 
   * @param integer $width Target width
   * @param integer $height Target height
   * @param boolean $proportional Whether to keep the image aspect ration (on cost of the height) or not
   */
  public function __construct($width, $height, $proportional = true) {
    $this->setWidth($width);
    $this->setHeight($height);
    $this->setProportional($proportional);
  }
  
  /**
   * 
   * @return integer
   */
  public function getWidth() {
    return $this->width;
  }

  /**
   * 
   * @param integer $width
   * @return Resizer
   */
  public function setWidth($width) {
    $this->width = (integer) $width;
    return $this;
  }

  /**
   * 
   * @return integer
   */
  public function getHeight() {
    return $this->height;
  }

  /**
   * 
   * @param integer $height
   * @return Resizer
   */
  public function setHeight($height) {
    $this->height = (integer) $height;
    return $this;
  }

  /**
   * 
   * @return boolean
   */
  public function getProportional() {
    return $this->proportional;
  }

  /**
   * 
   * @param boolean $proportional
   * @return Resizer
   */
  public function setProportional($proportional) {
    $this->proportional = $proportional === true;
    return $this;
  }
  
  /**
   * Perform resize transformation
   * 
   * @param Image $image
   * @param iAdapter $adapter
   * @return resource GD image resource
   */
  public function transform(Image $image, iAdapter $adapter) {
    $imageResource = $adapter->loadImage($image);
    $originalWidth = imagesx($imageResource);
    $originalHeight = imagesy($imageResource);

    $targetWidth = $this->getWidth();
    $targetHeight = $this->getHeight();
    
    if($this->getProportional()) {
      if($targetWidth > 0) {
        $newWp = (100 * $targetWidth) / $originalWidth;
        $newHeight = ($originalHeight * $newWp) / 100;

        if($newHeight > $targetHeight) {
          $newWp = (100 * $targetHeight) / $newHeight;
          $newHeight = ($newHeight * $newWp) / 100;
        }
      }
      if($targetHeight > 0) {
        $newWp = (100 * $targetHeight) / $originalHeight;
        $newWidth = ($originalWidth * $newWp) / 100;

        if($newWidth > $targetWidth) {
          $newWp = (100 * $targetWidth) / $newWidth;
          $newWidth = ($newWidth * $newWp) / 100;
        }
      }

      $targetWidth = $newWidth;
      $targetHeight = $newHeight;
    }

    $newImageResource = $adapter->createNewImage($image->getImageType(), $targetWidth, $targetHeight);
    imagecopyresampled($newImageResource, $imageResource, 0, 0, 0, 0, $targetWidth, $targetHeight, $originalWidth, $originalHeight);

    return $newImageResource;
  }
  
}
