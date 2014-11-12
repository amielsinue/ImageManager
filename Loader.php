<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 9:15 PM
 */

namespace ImageManager;


class Loader{

    protected static $instance;

    protected $path;

    private function __construct(){
        $this->path = dirname(__FILE__).DIRECTORY_SEPARATOR;
    }

    public static function singleton(){
        if(!(self::$instance instanceof \ImageManager\Loader)){
            self::$instance = new \ImageManager\Loader();
        }
        return self::$instance;
    }

    public function load($class_name){
//        echo $class_name.'<br/>';
        if(empty($class_name) || strpos($class_name,__NAMESPACE__) !== 0){

            return true;
        }
        //echo $class_name.'<br/>';
        //$class_file_name = str_replace(__NAMESPACE__,'',$class_name);
        $class_file_name = $this->path. $class_name.'.php';
        //echo $class_file_name.'<br/>';
        $class_file_name = str_replace('\\',DIRECTORY_SEPARATOR,$class_file_name);
        //echo $class_file_name.'<br/>';
        $class_file_name = str_replace(__NAMESPACE__.DIRECTORY_SEPARATOR.__NAMESPACE__,__NAMESPACE__,$class_file_name);
        //echo $class_file_name.'<br/>';
        //die();
        /*$class_file_name = str_replace('_',DIRECTORY_SEPARATOR,$class_file_name).'.php';*/
        //$class_file_name = str_replace('\\',DIRECTORY_SEPARATOR,$class_name). ".php";
//        echo $this->path. $class_file_name.'<br/>';
        if(file_exists($class_file_name)){
            require_once $class_file_name;
            return true;
        }
        return false;


    }

    public function register(){
        spl_autoload_register(array($this,'load'));
    }
}
Loader::singleton()->register();
