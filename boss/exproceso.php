<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>ExProceso</title>
	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="../css/listado.css">
	<link rel="icon" sizes="64x64" href="https://vertebraragon.es/img/trenlogo.png">
</head>
<body>
	<?php
		$headers = 'From: info@vertebraragon.es'."\r\n";
		//$headers.='Bcc: guillermogarciarouge@gmail.com;sinnoticiasdejoe@gmail.com;guillermo@artesnanoweb.es;'. "\r\n";

		try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$result=$conn->prepare( "SELECT email FROM firmas;");
				$result->execute();
				$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
				$correos="";
				foreach ($resultado as $datos) {
					$correos.=$datos['email'].";";
				}
				$headers.='Bcc: '.$correos."\r\n";
				$mensaje="<style>p{font-size:1.1em;text-align:justify}</style>";
				$mensaje.="<h3>Buenos días!</h3>";
				$mensaje.="<p>Ante todo os DISCULPAS por el correo anterior, es un correo que se mandó ";
				$mensaje.="días atrás debido a una modificación del último punto, los \"afectados\" ya lo recibieron en su día y la cosa fue ya aclarada.</p>";
				$mensaje.="<p>Ha sido una metida de pata del informático!!! (yo mismo :( ))</p>";
				$mensaje.="<h2>Presentación del #manifiesto vertebrAragón:</h2>";
				$mensaje2="<p>En esta ocasión, nos ponemos en contacto contigo, como firmante del #manifiesto vertebrAragón, para comunicarte";
				$mensaje2.=" que HOY, día 8 de junio a las 19h, presentaremos el manifiesto con una ponencia en:</p>";
				$mensaje2.="<p style='text-align:center'>CENTRO CÍVICO ANTONIO FERNÁNDEZ MOLINA,<br/><br/>C/Damas 8-10 Alagón</p>";
				$mensaje2.="<div style='text-align:center'><img src='https://vertebraragon.es/img/antonio-fernandez-molina.png' alt='Centro Cívico Alagón'></div>";
				$mensaje3="<br/><br/><p>Sin más, nos despedimos emplazándote a divulgar un manifiesto que nos parece imprescindible para el desarrollo de nuestra Comunidad Autónoma así como del nivel de vida de sus habitantes.</p>";
				$mensaje3.="<div><a href='https://vertebraragon.es/'><img width='100%' src='https://vertebraragon.es/img/cartel2.png' alt='#manifiesto vertebrAragón'></a></div>";
				$mensaje3.="<br/><br/><p>Saludos desde la plataforma <a href='https://vertebraragon.es/'>#vertebrAragón</a>, Nos vemos luego ;),</p><br/><br/>";
				$titulo="<h1>Querid@ firmante del #manifiesto vertebrAragón,</h1><br/><br/>";
				//$nombre=$datos["nombre"];
				//$mail=$datos["email"];
				//$remove="<br/><a href='https://vertebraragon.es/sis/removedatos.php?mail=".$mail."'>Pulsa aquí para borrar tu firma y datos</a>";
				$headers.= 'MIME-Version: 1.0' . "\r\n";
				$headers.='Content-type: text/html; charset=utf-8' . "\r\n";
				$headers.='Content-Transfer-Encoding: 8bit';					
				$mensaje=$titulo.$mensaje.$mensaje2.$mensaje3;
/*				if(mail("info@vertebraragon.es","Presentación del #manifiesto vertebrAragón",$mensaje,$headers))
					$envio="Mailing efectuado";
				else
					$envio="Problema de envío";*/
			echo $correos;		
				
	}catch(PDOException $e ){
			echo $e -> getMessage();
	}
	?>
</body>
</html>