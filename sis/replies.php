<?php
session_start();
$json=json_decode(file_get_contents('php://input'));
if($json->captcha!=$_SESSION['willi']){
	if(trim($_POST['clave'])=="")
		echo "Introduce el código de la imágen.";
	else
		echo "El código introducido no es válido.";
}else{
/*	$abuelo=$_POST['abuelo'];
	$padre=isset($_POST['padre'])?substr($_POST['padre'],5):"-1";*/
	$fecha=strtotime('now');
	$nombre=trim($json->nombre);
	$email=trim($json->email);
	$titulo=trim($json->titulo);
	$comentario=trim($json->comentario);
	if($nombre=="" || strlen($nombre)==1)
		die("Campo nombre mal cumplimentado");
	if($email=="" || !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
		die("Campo email mal cumplimentado");
	if($nombre=="" || strlen($nombre)<3)
		die("Campo nombre mal cumplimentado");
	if($titulo=="" || strlen($titulo)<3)
		die("Campo titulo mal cumplimentado");
	if($comentario=="" || strlen($comentario)<10)
		die("Campo comentario corto o mal cumplimentado");

	/*$seccion=$json->seccion;*/
	$padre=$json->padre;
	$conn = new PDO('mysql:host=localhost; dbname=vertebraragon', 'myelegirco', 'qR024AJp');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	if($padre!='0' && $padre!=''){
		$consulta="INSERT INTO comentarios (padre, nombre, email, fecha, titulo, comentario ) VALUES ('".$padre."','".$nombre."','".$email."','".$fecha."','".$titulo."','".$comentario."')";
		$result=$conn->prepare($consulta);
		$result->execute();		
		$consulta="SELECT max(id) as id FROM comentarios";
		$result=$conn->prepare($consulta);
		$result->execute();
		$resultado = $result->fetch(PDO::FETCH_ASSOC);
		$resultado = $resultado['id'];
		$id=$resultado;
	}else{
		$consulta="INSERT INTO comentarios (nombre, email, fecha, titulo, comentario) VALUES ('".$nombre."','".$email."','".$fecha."','".$titulo."','".$comentario."')";
		$result=$conn->prepare($consulta);
		$result->execute();		
		$consulta="SELECT max(id) as id FROM comentarios";
		$result=$conn->prepare($consulta);
		$result->execute();
		$resultado = $result->fetch(PDO::FETCH_ASSOC);
		$resultado = $resultado['id'];
		$id=$resultado;
		$consulta="UPDATE comentarios set padre=".$id." WHERE id=".$id;
		$result=$conn->prepare($consulta);
		$result->execute();
	}
	$headers = "From: $email\r\n";
	// $headers .= 'Bcc: yoar72@hotmail.com;guillermo@artesanoweb.es;' . "\r\n";
	$headers .= 'Bcc: jonangc@gmail.com;guillermogarciarouge@gmail.com' . "\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .='Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	$asunto= "#vertebrAragón: comentario WEB";
	$mensaje .="<h1>Comentario de ".$nombre.": ".$email."</h1>";
	$mensaje .="<h2>".$titulo."</h2>";
	$mensaje .="<p class='fecha'>".date('d-m-Y',strtotime('now'))."</p>";
	$mensaje .="<p class='comentario'>".nl2br($comentario)."</p>";
	$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/addcom.php?id=".$id."'>Incluir este comentario</a></p>";
	$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/addcom.php?id=".$id."&portada=1'>Incluir este comentario, y en portada también</a></p>";	
	$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/bocom.php?id=".$id."'>Borrar este comentario</a></p>";
	if(mail("info@vertebraragon.com",$asunto,$mensaje,$headers))
	{
	 echo "Mensaje Enviado Correctamente.";
	}else{
	 echo "Lo sentimos el envío ha resultado fallido, vuelve a intentarlo más tarde, gracias.";
	 }
 }

?>