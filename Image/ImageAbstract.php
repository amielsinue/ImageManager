<?php
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 1:02 PM
 */
namespace ImageManager\Image;

abstract class ImageAbstract implements iImage{

    /**
     * Image resource
     * @var resource
     */
    protected $resource;
    /**
     * Image extention
     * @var string
     */
    protected $extention;
    /**
     * Image height
     * @var int
     */
    protected $height;
    /**
     * Image width
     * @var int
     */
    protected $width;
    /**
     * image size in bites.
     * @var int
     */
    protected $size;
    /**
     * Image mime type
     * @var string
     */
    protected $mimetype;
    /**
     * image file physical location
     * @var string
     */
    protected $file;

    public function __construct($filename,$ext,$mimetype){
        if(!file_exists($filename)){
            throw new \Exception('File ['.$filename.'] not found',404);
        }
        $this->extention = $ext;
        $this->mimetype = $mimetype;
        $this->file = $filename;
        $this->setAttributes($filename);
        // Only called if needed
        //$this->getResource();
    }

    /**
     * Method to
     * @param string $file
     */
    protected function setAttributes($file){
        $get    = getimagesize($file);
        $this->width  = $get[0];
        $this->height = $get[1];
//        $type   = $get[2];
//        $attr   = $get[3];
        $this->size   = $get['bits'];
        //$mime   = $get['mime'];
    }

    /**
     * Create a new image from file
     * @return resource
     */
    public function getResource(){
        if(is_null($this->resource)){
            $this->open();
        }
        return $this->resource;
    }
    /**
     * Set an image resource to the current object.
     * @param resource
     * @return void
     */
    public function setResource($resource){
        $this->resource = $resource;
    }

    /**
     * Open the image based in the type, JPG, GIF, PNG
     * @return void
     */
    abstract protected function open();
    /**
     * Save the current Image resource into the file path defined
     * @param string $file_path
     * @param int $quality
     * @return boolean
     */
    abstract public function saveResource($file_path,$quality = 100);

    /**
     * Method to get the file extention
     * @return string
     */
    public function getExtention()
    {
        return $this->extention;
    }

    /**
     * Method to get the image height
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Method to get the image width
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Method to get the image size
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    public function getPathFile(){
        return $this->file;
    }

    /**
     * Method to get the image mime type
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    public function __toString(){
        $description = array(
            'Object: '.__CLASS__,
            'File: '.$this->file,
            'Width: '.$this->width,
            'Height: '.$this->height,
            'Size: '.   $this->size,
            'Extention: '.$this->extention

        );
        return implode(' | ',$description);
    }
}