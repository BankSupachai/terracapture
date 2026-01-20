<?php
        $dir = "image/";
        $a = scandir($dir);
        $ck_width[]     = 0;
        $ck_height[]    = 0;
        for($i=2;$i<count($a);$i++){
            list($width, $height, $type, $attr) = getimagesize("image/$a[$i]");
            // echo "File Name : $a[$i]";
            // echo "Width of image : " . $width . "<br>";
            // echo "Height of image : " . $height . "<br>";
            // echo "Image type :" . $type . "<br>";
            // echo "<hr>";
            array_push($ck_width, $width);
            array_push($ck_height, $height);
        }
        $max_width = max($ck_width);
        $max_height= max($ck_height);

        //echo $max_height;

        header("Content-type: image/jpeg");
        $images = ImageCreate($max_width,$max_height);
        $color = ImageColorAllocate($images,255,250,0);
        $photo = ImageColorAllocate($images,0,0,0);
        //ImageRectangle($images, 0, 0, 299, 199, $photo);
        ImageJpeg($images);
        ImageDestroy($images);
?>
