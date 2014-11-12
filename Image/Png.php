<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:42 PM
 */

namespace ImageManager\Image;


class Png extends ImageAbstract{

    protected function open(){
        $im = @imagecreatefrompng($this->file);
        if(!$im){
            throw new \Exception('PNG file can not be opened');
        }
        $this->resource = $im;
    }
    public function saveResource($file_path,$quality = 100){
        // *** Scale quality from 0-100 to 0-9
        $scaleQuality = round(($quality/100) * 9);
        // *** Invert quality setting as 0 is best, not 9
        $invertScaleQuality = 9 - $scaleQuality;
        return imagepng($this->resource, $file_path, $invertScaleQuality);
    }
} 