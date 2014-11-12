<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:22 PM
 */

namespace ImageManager;


class Utils {

    public static function detectMimetype($filename){
        if(!file_exists($filename)){
            throw new Exception('File ['.$file.'] not found',404);
        }

        if(function_exists('mime_content_type')){
            $mimetype = mime_content_type($filename);
            return $mimetype;
        }

        if(function_exists('finfo_open') ){
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }

    }
} 