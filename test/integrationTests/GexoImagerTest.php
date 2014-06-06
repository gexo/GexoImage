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

namespace gexo\image\test\integrationTests;

/**
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class GexoImagerTest extends TestCase {
  
  public function testResize_CanResizeImage() {
    $inputFile = __DIR__ . '/../data/example.jpg';
    $outputFile = __DIR__ . '/resized.jpg';
    
    $adapter = new \gexo\image\adapter\GdAdapter();
    $writer = new \gexo\image\writer\gd\file\JpegWriter(30);
    $transformerContainer = new \gexo\image\container\GdTransformerContainer();
    
    $gexoImage = new \gexo\image\GexoImage($inputFile, $outputFile, $adapter, $writer, $transformerContainer);
    $response = $gexoImage->resize(300, 200, false);
    
    self::assertTrue($response);
  }
  
  public function testResize_CanCropImage() {
    $inputFile = __DIR__ . '/../data/example.jpg';
    $outputFile = __DIR__ . '/cropped.jpg';
    
    $adapter = new \gexo\image\adapter\GdAdapter();
    $writer = new \gexo\image\writer\gd\file\JpegWriter(60);
    $transformerContainer = new \gexo\image\container\GdTransformerContainer();
    
    $gexoImage = new \gexo\image\GexoImage($inputFile, $outputFile, $adapter, $writer, $transformerContainer);
    $response = $gexoImage->crop(20, 50, 200, 120);
    
    self::assertTrue($response);
  }

}
