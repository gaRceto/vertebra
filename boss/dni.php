<?php
$json=json_decode(file_get_contents('php://input'));
$dni=strtoupper(trim($json->dni));
try{
	$dni=LetraNIF($dni);
  $conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$result=$conn->prepare( "SELECT name,apellidos,localidad,dni FROM firmas where dni='".$dni."';");
	$result->execute();
	$resultado = $result->fetch(PDO::FETCH_ASSOC);
	if($resultado['dni']==$dni)
		die($resultado['name']." ".$resultado['apellidos'].", de ".$resultado['localidad'].", ya ha firmado con este DNI");
	else
		echo $dni;

}catch(PDOException $e ){
		echo $e -> getMessage();
}
$conn = null;

function LetraNIF ($dni) {
	//echo $dni;
    $primera=substr($dni,0,1);
    $ultima=substr($dni,strlen($dni)-1,1);
    if(ctype_alpha($primera))
        $dni=substr($dni,1);
    else
        $primera="";
    if(ctype_alpha($ultima))
        $dni=substr($dni,0,strlen($dni)-1);
    else
        $ultima="";
    
/* Obtiene letra del NIF a partir del DNI */

  $valor= (int) ($dni / 23);

  $valor *= 23;

  $valor= $dni - $valor;

  $letras= "TRWAGMYFPDXBNJZSQVHLCKEO";

  $letraNif= substr ($letras, $valor, 1);

  return $primera.$dni.$letraNif;
}
?>