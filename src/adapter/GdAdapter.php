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

use gexo\image\exception\GexoImageInputException;
use gexo\image\Image;

/**
 * Resource adapter for images created by the GD library
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class GdAdapter implements iAdapter {

  /**
   * Creates a GD image resource out of the given Image
   * 
   * @param Image $image
   * @return resource GD image resource
   * 
   * @throws GexoImageInputException If image could not be processed
   */
  public function loadImage(Image $image) {
    $imageType = $image->getImageType();
    $imagePath = $image->getImagePath();

    if($imageType === IMAGETYPE_JPEG) {
      $imageResource = imagecreatefromjpeg($image->getImagePath());
    } elseif($imageType === IMAGETYPE_GIF) {
      $imageResource = imagecreatefromgif($imagePath);
    } elseif($imageType === IMAGETYPE_PNG) {
      $imageResource = imagecreatefrompng($imagePath);

      if(is_resource($imageResource)) {
        imagealphablending($imageResource, true);
        imagesavealpha($imageResource, true);
      }
    } else {
      throw new GexoImageInputException('Unsupported image type');
    }

    return $imageResource;
  }

  /**
   * Creates a new, blank image with the given dimensions. In case of a GIF or PNG image, use a transparent background.
   * 
   * @param integer $imageType Must be one of PHP's IMAGETYPE_xxx constants
   * @param integer $width
   * @param integer $height
   * @return resource GD image resource
   */
  public function createNewImage($imageType, $width, $height) {
    $canvas = imagecreatetruecolor($width, $height);

    if($imageType === IMAGETYPE_PNG) {
      imagesavealpha($canvas, true);
      $transColor = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
      imagefill($canvas, 0, 0, $transColor);
    } elseif($imageType === IMAGETYPE_GIF) {
      $magenta = imagecolorallocate($canvas, 255, 0, 255);
      imagecolortransparent($canvas, $magenta);
      imagefill($canvas, 0, 0, $magenta);
    }

    return $canvas;
  }

}
