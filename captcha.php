<?php


session_start();
$text = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz"), 0, 6);

$_SESSION['code'] = $text;

$img_width = 200;
$img_height = 40;

header('Content-type: image/png');
$image = imagecreate($img_width, $img_height); // create background image with dimensions
imagecolorallocate($image, 0, 0, 0); // set background color
$line_color = imagecolorallocate($image, 183, 249, 234);
$text_color = imagecolorallocate($image, 255, 255, 255); // set captcha text color
for($i=0; $i < 3; $i++) {

    imageline($image, 0, rand()%50, 200, rand()%50, $line_color);
}
imagestring($image, 10, 0, 0, $text, $text_color);

imagepng($image);
imagedestroy($image);
?>