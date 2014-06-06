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

namespace gexo\image\test\unitTests\entity;

use gexo\image\test\unitTests\TestCase;

/**
 * 
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class ImageTest extends TestCase {
  
  /**
   *
   * @var \gexo\image\Image
   */
  private $image = null;
  
  protected function setUp() {
    parent::setUp();
    
    $this->image = new \gexo\image\Image(__DIR__ . '/../data/example.jpg');
  }
  
  public function testGetWidth_ExpectedValueWasRead() {
    self::assertSame(380, $this->image->getWidth());
  }
  
  public function testGetHeight_ExpectedValueWasRead() {
    self::assertSame(240, $this->image->getHeight());
  }
  
  public function testGetImageType_ExpectedValueWasRead() {
    self::assertSame(IMAGETYPE_JPEG, $this->image->getImageType());
  }
  
  public function testGetMimeType_ExpectedValueWasRead() {
    self::assertSame('image/jpeg', $this->image->getMimeType());
  }
  
  public function testGetBits_ExpectedValueWasRead() {
    self::assertSame(8, $this->image->getBits());
  }
  
  public function testGetChannels_ExpectedValueWasRead() {
    self::assertSame(3, $this->image->getChannels());
  }
  
  /**
   * @expectedException \gexo\image\exception\GexoImageInputException
   */
  public function testProcessImage_ThrowsExceptionIfImageCannotBeProcessed() {
    $image = new \gexo\image\Image('not-existing-file');
    $image->getWidth();
  }

}
