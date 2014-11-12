<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:09 PM
 */

namespace ImageManager;


class Factory {

    protected static $soported_mime_types = array(
        'gif' => 'image/gif',
//        'ief' => 'image/ief',
//        'jpe' => 'image/jpeg',
//        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
//        'pbm' => 'image/x-portable-bitmap',
//        'pgm' => 'image/x-portable-graymap',
        'png' => 'image/png',
//        'pnm' => 'image/x-portable-anymap',
//        'ppm' => 'image/x-portable-pixmap',
//        'ras' => 'image/cmu-raster',
//        'rgb' => 'image/x-rgb',
//        'tif' => 'image/tiff',
//        'xbm' => 'image/x-xbitmap',
//        'xpm' => 'image/x-xpixmap',
//        'xwd' => 'image/x-xwindowdump',
//        'wbmp' => 'image/vnd.wap.wbmp',
//        'svg' => 'image/svg+xml',
//        'svgz' => 'image/svg+xml',
//        'bmp' =>	'image/bmp'
    );


    public static function getImage($imageFile){
        if(!file_exists($imageFile)){
            throw new \Exception('The file was not found',404);
        }
        $mime = Utils::detectMimetype($imageFile);

        if(!in_array($mime,self::$soported_mime_types)){
            throw new \Exception('Unsuported image type',406);
        }
        $extention = array_search($mime,self::$soported_mime_types);

        if( $extention == 'gif' ){
            return new Image\Gif($imageFile,$extention,$mime);
        }
        if( $extention == 'jpe' || $extention == 'jpeg' || $extention == 'jpg'){
            return new Image\Jpg($imageFile,$extention,$mime);
        }
        if( $extention == 'png' ){
            return new Image\Png($imageFile,$extention,$mime);
        }
        if( $extention == 'bmp' ){
            //return
        }

    }
} 