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

namespace gexo\image\adapter;

use gexo\image\exception\GexoImageException;
use gexo\image\Image;

/**
 * Must be implemented by all adapter classes
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
interface iAdapter {
  
  /**
   * Creates an image object using the used library's methods
   * 
   * @param Image $image
   * @return mixed
   * 
   * @throws GexoImageException In error cases
   */
  public function loadImage(Image $image);
  
  /**
   * Create new, blank image using the given dimensions
   * 
   * @param integer $imageType Must be one of PHP's IMAGETYPE_xxx constants
   * @param integer $width
   * @param integer $height
   */
  public function createNewImage($imageType, $width, $height);
  
}
