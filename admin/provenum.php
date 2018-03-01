<?php
session_start();

$rand = "";

for($i = 0;$i < 4;$i++){
	$rand.= dechex(rand(1,15));
} 
$_SESSION['authImg'] = $rand;

$im = imagecreatetruecolor(100,35);//尺寸 

$bg = imagecolorallocate($im,255,255,255);	//背景色

imagefill($im,0,0,$bg);

$te = imagecolorallocate($im,0,0,0);			//字符串颜色

$te2 = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));

for($i = 0; $i < 3; $i++){
	imageline($im,rand(0,100),0,100,30,$te2);
}

for($i = 0;$i < 200;$i++){
    imagesetpixel($im,rand(0,100),rand(0,30),$te2);
}

imagestring($im,6,25,6,$rand,$te);//输出图像的位置（数字验证）

header('Content-type:image/jpeg');

imagejpeg($im);

imagedestroy($im);
?>