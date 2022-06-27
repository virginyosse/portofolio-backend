<?php
    $filename ='./images-'. $_GET['size'] . '/' . $_GET['name']. '.png' ;
    if (file_exists($filename)){
        header("Content-Type: image/png");
        readfile($filename);
    }
    else{
        $source = './images-xxxhdpi/' . $_GET['name'] . '.png';
        $image = imagecreatefrompng($source);

        $pixels = array(88,132,176,264,352);
        $sizes = array('mdpi','hdpi','xhdpi', 'xxhdpi', 'xxxhdpi');
        $i = array_search($_GET['size'],$sizes);

        $result = imagecreatetruecolor($pixels[$i],$pixels[$i]);
        imagealphablending($result,false);
        imagealphablending($result,true);
        $transparent = imagecolorallocatealpha($result, 255,255,255,127);
        imagefilledrectangle($result, 0,0, $pixels[$i],$transparent);
        imagecopyresampled($result, $image, 0,0,0,0, $pixels[$i],$pixels[$i],$pixels[4],$pixels[4]);

        imagepng($result,$filename);
        
        header("Content-Type: image/png");
        imagepng($result);

        imagedestroy($image);
        imagedestroy($result);
    }

?>