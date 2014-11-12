##Image Manager

This is a little library that could help you to treat your images without more work.
Right now I only added the support for GIF/JPG/PNG.

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
$result = $resizer->process($width,$height,$destination_image);
if($result){
    echo 'Resized!';
}
```

