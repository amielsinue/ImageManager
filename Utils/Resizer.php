<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 2:45 PM
 */

namespace ImageManager\Utils;
use \ImageManager\Image\iImage;
/**
 * Class Resizer
 * case 'exact':
case 'portrait':
case 'landscape':
case 'auto':
case 'crop':
 * @package ImageManager\Utils
 */

class Resizer {

    /**
     * Decide with is the best way to resize
     * @constant int
     */
    const AUTO = 0;
    /**
     * Fixed by Width
     * @constant int
     */
    const LANDSCAPE = 1;
    /**
     * Use the exact dimensions passed
     * @const int
     */
    const EXACT = 2;
    /**
     * Fixed by height
     * @const int
     */
    const PORTRAIT = 3;
    /**
     * Using ratio to define the best dimensions
     * @const int
     */
    const CROP = 4;
    /**
     * Image quality when resizing
     * @var int
     */
    protected $_quality = 100;

    /**
     * @var \ImageManager\Image\iImage
     */
    protected $image;

    /**
     * Method AUTO by default
     * @var int
     */
    protected $method = 0;

    public function __construct(\ImageManager\Image\iImage $image,$options = array()){

        $this->image = $image;
        if(isset($options['quality']) && is_int($options['quality'])){
            $this->_quality = $options['quality'];
        }


    }

    public function setMethod($method){
        if( $method >= 0 && $method <= 4 ){
            $this->method = $method;
        }
    }

    public function process($to_width,$to_height,$target_path = ''){

        $dimensions = $this->calculateDimensions($to_width,$to_height);
        $optimalWidth = $dimensions['width'];
        $optimalHeight = $dimensions['height'];

        $imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
        imagecopyresampled(
            $imageResized,
            $this->image->getResource(),
            0, 0, 0, 0,
            $optimalWidth,
            $optimalHeight,
            $this->image->getWidth(),
            $this->image->getHeight()
        );
        if($target_path!=''){
            $image = clone $this->image;
        }else{
            $image = $this->image;
            $target_path = $image->getPathFile();
        }
        $image->setResource($imageResized);
        return $image->saveResource($target_path,$this->_quality);
    }

    public function calculateDimensions($to_width,$to_height){
        $result = array(
            'width'  => $to_width,
            'height' => $to_height
        );
        switch($this->method){
            case self::LANDSCAPE:
                $result['height'] = $this->calculateHeightByWidth($to_width);
                break;
            case self::EXACT:
                // SET THE SAME
                break;
            case self::PORTRAIT:
                $result['width'] = $this->calculateWidthByHeight($to_height);
                break;
            case self::CROP:
                $result = $this->calculateOptimalCrop($to_width,$to_height);
                break;
            case self::AUTO:
            default:
                $result = $this->calculateOptimalAuto($to_width,$to_height);
                break;
        }
        return $result;
    }
    private function calculateWidthByHeight($to_height)
    {
        // *** Get width and height
        $width  = $this->image->getWidth();
        $height = $this->image->getHeight();

        $ratio = $width / $height;
        if( $to_height != 0 )
            $to_width = $to_height * $ratio;
        else
            $to_width = $width;
        return $to_width;
    }

    private function calculateHeightByWidth($to_width){
        // *** Get width and height
        $width  = $this->image->getWidth();
        $height = $this->image->getHeight();
        $ratio =  $height / $width;
        $to_height = $to_width * $ratio;
        return $to_height;

    }
    private function calculateOptimalCrop($to_width,$to_height){
        $width  = $this->image->getWidth();
        $height = $this->image->getHeight();

        if( $to_height != 0)
            $heightRatio = $height / $to_height;
        else
            $heightRatio = 1;

        $widthRatio  = $width /  $to_width;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $height / $optimalRatio;
        $optimalWidth  = $width  / $optimalRatio;

        return array('width' => $optimalWidth, 'height' => $optimalHeight);

    }
    private function calculateOptimalAuto($to_width, $to_height)
    {
        // *** Get width and height
        $width  = $this->image->getWidth();
        $height = $this->image->getHeight();
        // *** Image to be resized is wider (landscape)
        if ($height < $width)
        {
            $optimalWidth = $to_width;
            $optimalHeight= $this->calculateHeightByWidth($to_width);
        }
        // *** Image to be resized is taller (portrait)
        elseif ($height > $width)
        {
            $optimalWidth = $this->calculateWidthByHeight($to_height);
            $optimalHeight= $to_height;
        }
        // *** Image to be resizerd is a square
        else
        {
            if ($to_height < $to_width) {
                $optimalWidth = $to_width;
                $optimalHeight= $this->calculateHeightByWidth($to_width);
            } else if ($to_height > $to_width) {
                $optimalWidth = $this->calculateWidthByHeight($image,$to_height);
                $optimalHeight= $to_height;
            } else { // *** Sqaure being resized to a square
                $optimalWidth = $to_width;
                $optimalHeight= $to_height;
            }
        }

        return array('width' => $optimalWidth, 'height' => $optimalHeight);
    }
} 