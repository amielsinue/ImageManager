<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:44 PM
 */

namespace ImageManager\Image;


class Bmp extends ImageAbstract {

    protected function open(){
        #TODO: Add support for Bmp
        throw new \Exception('GIF file can not be opened');
//        $im = @imagecreatefromwbmp($this->file);
//        if(!$im){
//            throw new \Exception('GIF file can not be opened');
//        }
//        $this->resource = $im;
    }
} 