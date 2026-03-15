<?php
	$json=json_decode(file_get_contents('php://input'));
	$url=$json->url;
	$h3=$json->h3;
	$h4=$json->h4;
	$imagen=$json->imagen;
	$descripcion=$json->descripcion;



	//$con = mysqli_connect("localhost", "myelegirco", "qR024AJp","vertebraragon");
	//$sql=$con->query($consult);
	try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$consulta="SELECT id FROM noticias WHERE url='".$url."'";
				
				$resulta=$conn->prepare($consulta);
				$resulta->execute();
				$resulto = $resulta->fetch(PDO::FETCH_ASSOC);				
				if($resulto['id']){
					$consulta="UPDATE noticias SET url='".$url."', h3='".$h3."', h4='".$h4."', descripcion='".$descripcion."' WHERE id='".$resulto['id']."'";
					
					$resulta=$conn->prepare($consulta);
					$resulta->execute();
				}else{
					$datos = array('url'=>$url,'h3'=>$h3, 'h4'=>$h4,'imagen'=>$imagen,'descripcion'=>$descripcion);
					$consulta="INSERT INTO noticias(url, h3, h4, imagen, descripcion) 
						VALUES(:url, :h3, :h4, :imagen, :descripcion);";
					//echo $consulta;
					print_r($consulta);
					$result=$conn->prepare($consulta);
					$result->execute($datos);					
				}
//				echo $consulta;
	}catch(PDOException $e ){
			echo $e -> getMessage();
	}

	$conn = null; 

/*	$noticias=$json->noticias;
	$index="../noticias/index.php";
	$html=creaHTML($noticias);
    if (!$gestor = fopen($index, 'w')) {
         echo "No se puede abrir el archivo ($index)";
         exit;
    }
    if (fwrite($gestor, $html) === FALSE) {
        echo "No se puede escribir en el archivo ($index)";
        exit;
    }
    echo "Noticas actualizadas";
	function creaHTML($noticias){
		$header ='<!DOCTYPE html>'.PHP_EOL;
		$header.='<html lang="es">'.PHP_EOL;
		$header.='<head>'.PHP_EOL;
		$header.='<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'.PHP_EOL;
		$header.="\t".'<meta charset="UTF-8">'.PHP_EOL;
		$header.="\t".'<title>Noticias Relacionadas</title>'.PHP_EOL;
		$header.="\t".'<link rel="stylesheet" type="text/css" href="https://vertebraragon.es/css/noticias.css">'.PHP_EOL;
		$header.="\t".'<link rel="stylesheet" type="text/css" href="https://vertebraragon.es/css/estilo.css">'.PHP_EOL;
		$header.="\t".'<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet">';
		$header.="\t".'<link rel="icon" sizes="64x64" href="https://vertebraragon.es/img/trenlogo.png">'.PHP_EOL;
		$header.="\t".'<script src="../js/custom.js"></script>';
		$header.='</head>'.PHP_EOL;
		$header.='<body>'.PHP_EOL;
		$body=  '<?php include("../menu2.php"); ?>'.PHP_EOL;
		$body.=  "\t".'<div class="padprov">'.PHP_EOL;
		$body.= "\t\t".'<h2 class="notRel">Noticias relacionadas</h2>'.PHP_EOL;
		$body.= "\t".'</div>'.PHP_EOL;
		$body.= "\t".'<div id="noticias">'.PHP_EOL;
		$body.=  "\t\t".$noticias.PHP_EOL;
		$body.= "\t".'</div>'.PHP_EOL;
		$body.= "\t".'<div class="replicas">'.PHP_EOL;
		$body.=  "\t\t<a href='https://vertebraragon.es/comentarios'><h2 class='notRel underl'>Comentarios y réplicas</h2>".PHP_EOL;
		$body.= "\t".'</div>'.PHP_EOL;
		$body.= "\t".'<div class="sube"></div>'.PHP_EOL;
		$body.= "\t\t".'<footer>'.PHP_EOL;
		$body.= "\t\t\t".'<div class="footer-two" id="footer-two">'.PHP_EOL;
		$body.='<?php include("../ideas.php");?>';
		$body.="\t\t\t".'</div>'.PHP_EOL;
		$body.="\t\t\t".'<div class="footer-one">'.PHP_EOL;
		$body.="\t\t\t\t".'<p>©vertebrAragón</p>'.PHP_EOL;
		$body.="\t\t\t".'</div>'.PHP_EOL;
		$body.="\t\t".'</footer>'.PHP_EOL;
		$body.=  '</body>'.PHP_EOL;
		$body.=  '</html>'.PHP_EOL;
	return $header.$body;
	}*/
?>