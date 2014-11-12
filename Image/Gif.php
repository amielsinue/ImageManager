<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:40 PM
 */

namespace ImageManager\Image;


class Gif extends ImageAbstract{

    protected function open(){
        $im = @imagecreatefromgif($this->file);
        if(!$im){
            throw new \Exception('GIF file can not be opened');
        }
        $this->resource = $im;
    }
    public function saveResource($file_path,$quality = 100){
        return imagegif($this->resource, $file_path);
    }
} 