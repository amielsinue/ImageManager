<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 8:54 PM
 */

namespace ImageManager\Test;
require_once '../Loader.php';
use \ImageManager\Factory;


class ImageTest extends \CakeTestCase{

    protected $images = array();

    public function setUp(){
        $this->images['jpg'] = dirname(__FILE__).DIRECTORY_SEPARATOR.'testing_image_manager.jpg';
    }
    public function testStrategies(){
//        $image = \ImageManager\Factory::getImage($this->images['png']);
//        $this->assertTrue($image instanceof \ImageManager\Image\Png);
        $image = \ImageManager\Factory::getImage($this->images['jpg']);
        $this->assertTrue($image instanceof \ImageManager\Image\Jpg);

    }

    public function testCopy(){
        $image = \ImageManager\Factory::getImage($this->images['jpg']);
        $target_path = '/tmp/copied.'.$image->getExtention();
        copy($image->getPathFile(),$target_path );
        $this->assertTrue(file_exists($target_path));
        unlink($target_path);
    }

    public function testResize(){
        $image = \ImageManager\Factory::getImage($this->images['jpg']);
        echo $image->__toString().PHP_EOL;
        $target_path = '/tmp/resized.'.$image->getExtention();
        $resizer = new \ImageManager\Utils\Resizer($image);
        $result = $resizer->process(100,100,$target_path);

        $this->assertTrue($result);

        $image = \ImageManager\Factory::getImage($target_path);
        echo $image->__toString().PHP_EOL;
        $this->assertTrue($image->getWidth() == 100);
        unlink($target_path);

    }

} 