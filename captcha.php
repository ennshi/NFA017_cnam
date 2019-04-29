<?php


session_start();
$text = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz"), 0, 6);

$_SESSION['code'] = $text;
//$font='captcha.ttf'; 
//$font_size = 5;
$img_width = 200;
$img_height = 40;

header('Content-type: image/png');
$image = imagecreate($img_width, $img_height); // create background image with dimensions
imagecolorallocate($image, 255, 255, 255); // set background color

$text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color

//imagettftext($image,$font_size,0,5,5,$text_color,$font,$text);
imagestring($image, 10, 0, 0, $text, $text_color);

imagepng($image);
imagedestroy($image);
?>