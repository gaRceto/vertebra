<?php
session_start();
header("Content-type: image/png");
$img1 = imagecreatefrompng("../img/imagen1.png");
$img2 = imagecreatefrompng("../img/imagen2.png");
$color1 = rand(0,8);
$color2 = rand(0,7);
$color3 = rand(0,9);
$inclina = rand(-10,10);
$altura = 30+$inclina;
/*echo "<h1>$inclina</h1>";*/
$izda=rand(0,60);
$fuente = "Anonymous_Pro-webfont.ttf";
$color = imagecolorallocate($img1,255,250,250);
imagettftext($img1,25,$inclina,$izda,$altura, $color,$fuente,$_SESSION['willi']); 
imagecopymerge($img1,$img2,0,0,0,0,200,175,50);
imagegif($img1);
imagedestroy($img2);
imagedestroy($img1);
?>
