<?php
$id=$_GET['prov'];
$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
try{
	$consulta="UPDATE firmas set privacidad=1 WHERE id='".$id."';";
	$result=$conn->prepare($consulta);
	$result->execute();
}catch(PDOException $e ){
	echo $e -> getMessage();
}
$conn = null; 
header('Location: http://www.vertebraragon.com');
?>