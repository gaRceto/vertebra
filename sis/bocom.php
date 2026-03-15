<?php
	$id=$_GET['id'];
	$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$result=$conn->prepare("DELETE FROM comentarios WHERE id=".$id);
	$result->execute();
	$result=$conn->prepare("ALTER TABLE comentarios AUTO_INCREMENT=1");
	$result->execute();
	header('Location: https://vertebraragon.com');
	die();
?>