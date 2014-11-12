##Image Manager

This is a little library that could help you to treat your images without more work.
Right now I only added the support for GIF/JPG/PNG.

###Utils::Resizer

The resizer is very useful when you want to resize your images without distort them. You can use one of the following methods.

* AUTO (default): will decide which is he best method to resize your image.
* LANDSCAPE: will resize your image based in the width.
* EXACT: will resize using both width/height values.
* PORTRAIT: will resize your image based in the height.
* CROP: will resize based in the ratio to decide the best dimensions. 




### How to use it
```php
<?php
require_once 'Vendors/ImageManager/Loader.php';
use \ImageManager\Factory;
$image = dirname(__FILE__).DIRECTORY_SEPARATOR.'testing_image_manager.jpg';

$width = 100;
$height = 100;

$destination_image = dirname(__FILE__).DIRECTORY_SEPARATOR.$width.'x'.$height.DIRECTORY_SEPARATOR.'testing_image_manager.jpg';

$image = \ImageManager\Factory::getImage($image);
$resizer = new \ImageManager\Utils\Resizer($image);
$resizer->setMethod($resizer::AUTO);
$result = $resizer->process($width,$height,$destination_image);
if($result){
    echo 'Resized!';
}
```





