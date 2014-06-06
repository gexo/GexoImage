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

namespace gexo\image;

use gexo\image\adapter\iAdapter;
use gexo\image\container\iTransformerContainer;
use gexo\image\exception\GexoImageException;
use gexo\image\transformer\iCropper;
use gexo\image\transformer\iResizer;
use gexo\image\writer\iWriter;

/**
 * Entry point for image manipulation. Offers access to all currently supportd manipulations.
 *
 * @copyright  2014 Stefan Oswald
 * @link       https://github.com/gexo/GexoImage
 * @author     Stefan Oswald <github@gexo.de>
 */
class GexoImage {
  
  /**
   *
   * @var iAdapter
   */
  private $adapter = null;
  
  /**
   *
   * @var iWriter
   */
  private $writer = null;
  
  /**
   *
   * @var string
   */
  private $inputFile = '';
  
  /**
   *
   * @var string
   */
  private $outputFile = '';
  
  /**
   *
   * @var iTransformerContainer
   */
  private $transformerContainer = null;
  
  /**
   * 
   * @param string $inputFile
   * @param string $outputFile
   * @param iAdapter $adapter
   * @param iWriter $writer
   */
  public function __construct($inputFile, $outputFile, iAdapter $adapter, iWriter $writer, iTransformerContainer $transformerContainer) {
    $this->setInputFile($inputFile);
    $this->setOutputFile($outputFile);
    $this->setAdapter($adapter);
    $this->setWriter($writer);
    $this->setTransformerContainer($transformerContainer);
  }
  
  /**
   * 
   * @return iAdapter
   */
  public function getAdapter() {
    return $this->adapter;
  }

  /**
   * 
   * @param iAdapter $adapter
   * @return GexoImage
   */
  public function setAdapter(iAdapter $adapter) {
    $this->adapter = $adapter;
    return $this;
  }

  /**
   * 
   * @return iWriter
   */
  public function getWriter() {
    return $this->writer;
  }

  /**
   * 
   * @param iWriter $writer
   * @return GexoImage
   */
  public function setWriter(iWriter $writer) {
    $this->writer = $writer;
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getInputFile() {
    return $this->inputFile;
  }

  /**
   * 
   * @param string $inputFile
   * @return GexoImage
   */
  public function setInputFile($inputFile) {
    $this->inputFile = (string) $inputFile;
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getOutputFile() {
    return $this->outputFile;
  }

  /**
   * 
   * @param string $outputFile
   * @return GexoImage
   */
  public function setOutputFile($outputFile) {
    $this->outputFile = (string) $outputFile;
    return $this;
  }
  
  /**
   * 
   * @return iTransformerContainer
   */
  public function getTransformerContainer() {
    return $this->transformerContainer;
  }

  /**
   * 
   * @param iTransformerContainer $transformerContainer
   * @return GexoImage
   */
  public function setTransformerContainer(iTransformerContainer $transformerContainer) {
    $this->transformerContainer = $transformerContainer;
    return $this;
  }

  /**
   * Resize an image. 
   * If $proportional is TRUE, $width and $height are maximum dimensions - the resized image canniot be bigger than 
   * those, keeping the original's aspect ratio. 
   * If $proportional is FALSE, the image will be wrneched to match exactly the given dimensions.
   * 
   * @param integer $width Target width
   * @param integer $height Target height
   * @param boolean $proportional Whether to keep the image aspect ration (on cost of the height) or not
   * @return boolean TRUE if output file was written successfully, or FALSE if not
   * 
   * @throws GexoImageException If anything goes wrong
   */
  public function resize($width, $height, $proportional = true) {
    $image = new Image($this->getInputFile());
    
    $transformer = $this->getTransformerContainer()->resizer;
    if(!$transformer instanceof iResizer) {
      throw new GexoImageException('No iResizer transformer found in the given TransformerContainer');
    }
    
    $transformer->setWidth($width)->setHeight($height)->setProportional($proportional);
    $imageResource = $transformer->transform($image, $this->getAdapter());
    
    $this->getWriter()->setOutputFilePath($this->getOutputFile());
    $this->getWriter()->setImageResource($imageResource);
    
    return $this->getWriter()->write();
  }
  
  /**
   * Crop an image.
   * Starting at the given X/Y coordinates, move $width pixels to the right and $height pixels down.
   * Cut out this rectangle from the source image and create a new image out of the snippet.
   * Ignore the remaining parts of the source image.
   * 
   * @param integer $startX X-coordinate of image canvas to start cropping
   * @param integer $startY Y-coordinate of image canvas to start cropping
   * @param integer $width Target image width (the cut-out snippet)
   * @param integer $height Target image height (the cut-out snippet)
   * @return boolean TRUE if output file was written successfully, or FALSE if not
   * @throws GexoImageException If anything goes wrong
   */
  public function crop($startX, $startY, $width, $height) {
    $image = new Image($this->getInputFile());
    
    $transformer = $this->getTransformerContainer()->cropper;
    if(!$transformer instanceof iCropper) {
      throw new GexoImageException('No iResizer transformer found in the given TransformerContainer');
    }
    
    $transformer->setStartY($startX)->setStartY($startY)->setWidth($width)->setHeight($height);
    $imageResource = $transformer->transform($image, $this->getAdapter());
    
    $this->getWriter()->setOutputFilePath($this->getOutputFile());
    $this->getWriter()->setImageResource($imageResource);
    
    return $this->getWriter()->write();
  }

}
