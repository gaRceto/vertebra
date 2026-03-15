<?php
session_start();
$json=json_decode(file_get_contents('php://input'));
if($json->captcha!=$_SESSION['willi']){
	if($json->captcha=="")
		echo "Introduce el código de la imágen.";
	else
		echo "El código introducido no es válido.";
}else{
/*	$abuelo=$_POST['abuelo'];
	$padre=isset($_POST['padre'])?substr($_POST['padre'],5):"-1";*/
	$fecha=strtotime('now');
	$nombre=$json->nombre;
	$email=$json->email;
	$titulo=$json->titulo;
	$comentario=$json->comentario;
	$seccion=$json->seccion;
	if($nombre=="" || strlen($nombre)==1)
		die("Campo nombre mal cumplimentado");
	if($email=="" || !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
		die("Campo email mal cumplimentado");
	if($nombre=="" || strlen($nombre)<3)
		die("Campo nombre mal cumplimentado");
	if($titulo=="" || strlen($titulo)<3 )
		die("Campo titulo mal cumplimentado");
	if($comentario=="" || strlen($comentario)<10)
		die("Campo comentario corto o mal cumplimentado");


	if($seccion!='mel'){
		$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$consulta="INSERT INTO comentarios (nombre, email, fecha, titulo, comentario) VALUES ('".$nombre."','".$email."','".$fecha."','".$titulo."','".$comentario."')";
		/*echo $consulta;*/
		$result=$conn->prepare($consulta);
		$result->execute();
		$consulta="SELECT max(id) as id FROM comentarios";
		/*echo $consulta;*/
		$result=$conn->prepare($consulta);
		$result->execute();
		$resultado = $result->fetch(PDO::FETCH_ASSOC);
		$resultado = $resultado['id'];
		$id=$resultado;
		$consulta="UPDATE comentarios set padre=".$id." WHERE id=".$id;
		//echo $consulta;
		$result=$conn->prepare($consulta);
		$result->execute();
	}
	$headers = "From: $email\r\n";
	$headers .= 'Bcc: guillermogarciarouge@gmail.com' . "\r\n";
	// $headers .= 'Bcc: yoar72@hotmail.com;guillermo@artesanoweb.es;' . "\r\n";
	/*$headers .= 'Bcc: jonangc@gmail.com;guillermogarciarouge@gmail.com' . "\r\n";*/
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .='Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .='Content-Transfer-Encoding: 8bit';
	$ast=($seccion=="com")?"Comentario web":"Email";
	$asunto=$ast." en #vertebrAragón";
	$mensaje .="<h1>".$ast." de ".$nombre.", <span style='font-size:0.5em'>&#8249;".$email."&#8250;</span></h1>";
	$mensaje .="<h2>".$titulo."</h2>";
	$mensaje .="<p class='fecha'>".date('d-m-Y',strtotime('now'))."</p>";
	$mensaje .="<p class='comentario'>".nl2br($comentario)."</p>";
	if($seccion=='com'){
		$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/addcom.php?id=".$id."'>Incluir este comentario</a></p>";
		$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/addcom.php?id=".$id."&portada=1'>Incluir este comentario, y en portada también</a></p>";
		$mensaje .="<p><a target='_blank' href='https://vertebraragon.com/sis/bocom.php?id=".$id."'>Borrar este comentario</a></p>";
	}
	// if(mail("guillermo@cineymusica.es",$asunto,$mensaje,$headers))
	if(mail("info@vertebraragon.com",$asunto,$mensaje,$headers))
	{
	 echo "Mensaje Enviado Correctamente.";
	}else{
	 echo "Lo sentimos el envío ha resultado fallido, vuelve a intentarlo más tarde, gracias.";
	 }
 }
?>