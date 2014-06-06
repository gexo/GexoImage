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

use gexo\image\transformer\iCropper;

/**
 * This transformer implementation can crop an image (i.e., cut off borders)
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class Cropper implements iGdTransformer, iCropper {
  
  /**
   *
   * @var integer
   */
  private $startX = 0;
  
  /**
   *
   * @var integer
   */
  private $startY = 0;
  
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
   * @param integer $startX X-coordinate of image canvas to start cropping
   * @param integer $startY Y-coordinate of image canvas to start cropping
   * @param integer $width Target image width (the cut-out snippet)
   * @param integer $height Target image height (the cut-out snippet)
   */
  public function __construct($startX, $startY, $width, $height) {
    $this->setStartX($startX);
    $this->setStartY($startY);
    $this->setWidth($width);
    $this->setHeight($height);
  }
  
  /**
   * 
   * @return integer
   */
  public function getStartX() {
    return $this->startX;
  }

  /**
   * 
   * @param integer $startX
   * @return \gexo\image\transformer\gd\Cropper
   */
  public function setStartX($startX) {
    $this->startX = (integer) $startX;
    return $this;
  }
  
  /**
   * 
   * @return integer
   */
  public function getStartY() {
    return $this->startY;
  }

  /**
   * 
   * @param integer $startY
   * @return \gexo\image\transformer\gd\Cropper
   */
  public function setStartY($startY) {
    $this->startY = (integer) $startY;
    return $this;
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
   * @return \gexo\image\transformer\gd\Cropper
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
   * @return \gexo\image\transformer\gd\Cropper
   */
  public function setHeight($height) {
    $this->height = (integer) $height;
    return $this;
  }

  /**
   * Perform crop transformation
   * 
   * @param \gexo\image\Image $image
   * @param \gexo\image\adapter\iAdapter $adapter
   * @return resource
   */
  public function transform(\gexo\image\Image $image, \gexo\image\adapter\iAdapter $adapter) {
    $inputImageResource = $adapter->loadImage($image);
    
    $croppedImageCanvas = $adapter->createNewImage(
      $image->getImageType(), $this->getWidth(), $this->getHeight()
    );

    imagecopyresampled(
      $croppedImageCanvas, $inputImageResource, 
      0, 0, 
      $this->getStartX(), $this->getStartY(), 
      $this->getWidth(), $this->getHeight(), 
      $this->getWidth(), $this->getHeight()
    );

    return $croppedImageCanvas;
  }

}
