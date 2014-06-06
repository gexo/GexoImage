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

namespace gexo\image\test\unitTests\adapter;

use gexo\image\test\unitTests\TestCase;

/**
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class GdAdapterTest extends TestCase {
  
  public function testGetImage_CanCreateImageFromJpegSource() {
    $image = new \gexo\image\Image(__DIR__ . '/../../data/example.jpg');
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->loadImage($image);
    
    self::assertTrue(is_resource($image));
  }

  public function testGetImage_CanCreateImageFromGifSource() {
    $image = new \gexo\image\Image(__DIR__ . '/../../data/example.gif');
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->loadImage($image);
    
    self::assertTrue(is_resource($image));
  }

  public function testGetImage_CanCreateImageFromPngSource() {
    $image = new \gexo\image\Image(__DIR__ . '/../../data/example.png');
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->loadImage($image);
    
    self::assertTrue(is_resource($image));
  }
  
  /**
   * @expectedException \gexo\image\exception\GexoImageInputException
   */
  public function testGetImage_ThrowsException_IfImagePathCannotBeRead() {
    $image = new \gexo\image\Image('invalid_path');
    $adapter = new \gexo\image\adapter\GdAdapter();
    $adapter->loadImage($image);
  }
  
  /**
   * @expectedException \gexo\image\exception\GexoImageInputException
   */
  public function testGetImage_ThrowsException_IfImageHasInvalidType() {
    $image = new \gexo\image\Image('dummy');
    $image->setProcessed(true);
    $image->setImageType(IMAGETYPE_UNKNOWN);
    
    $adapter = new \gexo\image\adapter\GdAdapter();
    $adapter->loadImage($image);
  }
  
  public function testCreateNewImage_ForImageTypeJpg() {
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->createNewImage(IMAGETYPE_JPEG, 300, 200);
    
    self::assertTrue(is_resource($image));
  }
  
  public function testCreateNewImage_ForImageTypeGif() {
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->createNewImage(IMAGETYPE_GIF, 300, 200);
    
    self::assertTrue(is_resource($image));
  }
  
  public function testCreateNewImage_ForImageTypePng() {
    $adapter = new \gexo\image\adapter\GdAdapter();
    $image = $adapter->createNewImage(IMAGETYPE_PNG, 300, 200);
    
    self::assertTrue(is_resource($image));
  }

}
