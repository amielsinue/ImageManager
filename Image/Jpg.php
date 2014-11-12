<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:41 PM
 */

namespace ImageManager\Image;


class Jpg extends ImageAbstract{


    protected function open(){
        $im = @imagecreatefromjpeg($this->file);
        if(!$im){
            throw new \Exception('JPG file can not be opened');
        }
        $this->resource = $im;
    }

    public function saveResource($file_path,$quality = 100){
        return imagejpeg($this->resource, $file_path, $quality);
    }
} 