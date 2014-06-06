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

namespace gexo\image\transformer;

/**
 * Must be implemented by all transformers
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
interface iTransformer {

  /**
   * Perform transforming operation on the given Image, using the given adapter
   * 
   * @param \gexo\image\Image $image The Image object to transform
   * @param \gexo\image\adapter\iAdapter $adapter Image object adapter
   * @return \gexo\image\Image The transformed image as a Image entity
   * 
   * @throws \gexo\image\exception\GexoImageException If an error occurs during transformation
   */
  public function transform(\gexo\image\Image $image, \gexo\image\adapter\iAdapter $adapter);
  
}
