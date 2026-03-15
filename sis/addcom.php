<?php
	$id=$_GET['id'];
	$portada=(isset($_GET['portada']))?2:1;
	$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if($portada==2){
		$result=$conn->prepare("UPDATE comentarios SET aceptado=1 WHERE aceptado=2");
		$result->execute();
	}
	$result=$conn->prepare("UPDATE comentarios SET aceptado=".$portada." WHERE id=".$id);
	$result->execute();
	header('Location: https://vertebraragon.com/comentarios/');
	die();
?>