<?php
@session_start();
$json=json_decode(file_get_contents('php://input'));
$asunto=$json->asunto;
$lacab="<!DOCTYPE html>".PHP_EOL;
$lacab.="<html>".PHP_EOL;
$lacab.="<head>".PHP_EOL;
$lacab.='<meta http-equiv="Content-type" content="text/html; charset=utf-8" />'.PHP_EOL;
$lacab.="<style>body{text-align:center}</style>";
$lacab.="</head>".PHP_EOL;
$lacab.="<body>".PHP_EOL;
$lacab.="<h2>Convocatoria para la defensa del cercanías</h2>".PHP_EOL;
$mensaje .="<main>".$json->mensaje.PHP_EOL;
$mensaje.='<div class="milieu"><img src="https://vertebraragon.es/img/vertebra.jpg" class="imas"></div></main>'.PHP_EOL;
$mensaje .="<br/><br/>Recibe cordiales saludos de #vertebrAragón.".PHP_EOL."</body>".PHP_EOL."</html>";
$mensaje=$lacab.PHP_EOL.$mensaje;
$headers = 'From: vertebrAragón<info@vertebraragon.es>'."\r\n";
$headers .= 'Bcc:'.$json->mails."\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .='Content-type: text/html; charset=utf-8' . "\r\n";
$headers .='Content-Transfer-Encoding: 8bit';
if(mail('info@vertebraragon.es',$asunto,$mensaje,$headers))
{
	echo "Correo Enviado";
}else{
 echo "\nLo sentimos el envío ha resultado fallido, vuelve a intentarlo más tarde, gracias.\n";
}
function enlaces($texto){
	preg_match_All('/(?i)\b((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/', $texto, $output_array);

	$enlaces=$output_array[0];
	foreach($enlaces as $enlace){
	    $texto=str_replace($enlace,"<a class='enlaceT' href='".$enlace."' target='_blank' rel='nofollow'>$enlace</a>",$texto);
	}
	return $texto;	
}
?>