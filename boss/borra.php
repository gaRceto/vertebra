<?php
	$json=json_decode(file_get_contents('php://input'));
	$url=$json->url;
	$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
	$consult="DELETE FROM noticias WHERE url='".$url."'";
	$result=$conn->prepare($consulta);
	$result->execute();		
	//$sql=$con->query($consult);
	$consult="ALTER TABLE noticias AUTO_INCREMENT=1";
	$consult="DELETE FROM noticias WHERE url='".$url."'";
	$result=$conn->prepare($consulta);
	$result->execute();		
	echo "Registro eliminado";
?>