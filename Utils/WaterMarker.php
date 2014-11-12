<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 10:18 PM
 */

namespace ImageManager\Utils;


class WaterMarker {
    /**
     * @var \ImageManger\Image\iImage
     */
    protected $image;
    /**
     * @var \ImageManger\Image\iImage
     */
    protected $watermark;

    public function __construct(\ImageManger\Image\iImage $image,\ImageManger\Image\iImage $watermark){

    }
} 