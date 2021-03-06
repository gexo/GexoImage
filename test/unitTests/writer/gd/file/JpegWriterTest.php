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

namespace gexo\image\test\unitTests\writer\gd\file;

use gexo\image\test\unitTests\TestCase;

/**
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class JpegWriterTest extends TestCase {
  
  public function testWrite_UseDefaultJpegQuality() {
    $image = new \gexo\image\Image(__DIR__ . '/../../../../data/example.jpg');
    $adapter = new \gexo\image\adapter\GdAdapter();
    
    $resizer = new \gexo\image\transformer\gd\Resizer(300, 200);
    $imageResource = $resizer->transform($image, $adapter);
    
    $outputFilePath = tempnam(sys_get_temp_dir(), md5(mt_rand(0, 65536)));
    $writer = new \gexo\image\writer\gd\file\JpegWriter();
    $writer->setImageResource($imageResource)->setOutputFilePath($outputFilePath);
    $result = $writer->write();
    
    // tidy up generated file
    unlink($outputFilePath);
    
    self::assertTrue($result);
  }
  
  public function testWrite_UseCustomJpegQuality() {
    $image = new \gexo\image\Image(__DIR__ . '/../../../../data/example.jpg');
    $adapter = new \gexo\image\adapter\GdAdapter();
    
    $resizer = new \gexo\image\transformer\gd\Resizer(300, 200);
    $imageResource = $resizer->transform($image, $adapter);
    
    $outputFilePath = tempnam(sys_get_temp_dir(), md5(mt_rand(0, 65536)));
    $writer = new \gexo\image\writer\gd\file\JpegWriter(85); //$imageResource, $outputFilePath, 85);
    $writer->setImageResource($imageResource)->setOutputFilePath($outputFilePath);
    $result = $writer->write();
    
    // tidy up generated file
    unlink($outputFilePath);
    
    self::assertTrue($result);
  }

}
