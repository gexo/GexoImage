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

namespace gexo\image\writer\gd\file;

/**
 * Must be implemented by all writers
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class JpegWriter extends AbstractFileWriter {
  
  /**
   *
   * @var integer
   */
  private $jpegQuality = -1;

  /**
   * 
   * @param integer $jpegQuality If not set, use library's default value (~75)
   */
  public function __construct($jpegQuality = -1) {
    $this->setJpegQuality($jpegQuality);
  }

  /**
   * 
   * @return integer
   */
  public function getJpegQuality() {
    return $this->jpegQuality;
  }

  /**
   * 
   * @param integer $jpegQuality
   * @return gexo\image\writer\gd\file\JpegWriter
   */
  public function setJpegQuality($jpegQuality) {
    $this->jpegQuality = (integer) $jpegQuality;
    return $this;
  }

  /**
   * Write JPEG file to configured output path
   * 
   * @return boolean
   */
  public function write() {
    $quality = $this->getJpegQuality();
    
    if($quality < 0) {
      return imagejpeg($this->getImageResource(), $this->getOutputFilePath());
    } else {
      return imagejpeg($this->getImageResource(), $this->getOutputFilePath(), $quality);
    }
  }

}
