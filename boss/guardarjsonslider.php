<?php
$json=json_decode(file_get_contents('php://input'));
if($json=="")
	die();
file_put_contents('../slider.json',json_encode($json));
echo "Slider actualizado";
?>
