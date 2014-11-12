<?php
namespace ImageManager\Image;
/**
 * Created by PhpStorm.
 * User: sinueyanez
 * Date: 4/26/14
 * Time: 12:44 PM
 */
interface iImage {

    /**
     * Method to get the file extention
     * @return string
     */
    public function getExtention();

    /**
     * Method to get the image height
     * @return int
     */
    public function getHeight();

    /**
     * Method to get the image width
     * @return int
     */
    public function getWidth();

    /**
     * Method to get the image size
     * @return int
     */
    public function getSize();

    /**
     * Method to get the image mime type
     * @return string
     */
    public function getMimetype();

    /**
     * Method to get the image resource defined by the type is from.
     * jpg,png,gif and so on.
     * @return resource
     */
    public function getResource();

    /**
     * Set an image resource to the current object.
     * @param resource
     * @return void
     */
    public function setResource($resource);

    /**
     * Save the current Image resource into the file path defined
     * @param string $file_path
     * @param int $quality
     * @return boolean
     */
    public function saveResource($file_path,$quality=100);

}