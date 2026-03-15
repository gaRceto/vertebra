<?php
	try{
		$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$consulta="SELECT * FROM noticias ORDER BY id DESC;";	
		$result=$conn->prepare($consulta);
		$result->execute();
		$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
		$linea="";
		$uerre="";
		foreach ($resultado as $valor) {
			$url=$valor['url'];
			$h3=$valor['h3'];
			$h4=$valor['h4'];
			$img=$valor['imagen'];
			$desc=$valor['descripcion'];
			$uerre.="\t<div class='nwUrl'>".PHP_EOL;
				$uerre.="\t\t<span class='litUrl' title='".$url."'>".substr($url,0,30)."</span>".PHP_EOL;
				$uerre.="\t\t<span class='record'></span>".PHP_EOL;
				$uerre.="\t\t<span class='dellete'>X</span>".PHP_EOL;
				$uerre.="\t\t<div class='interior'>".PHP_EOL;
					$uerre.="\t\t\t<span class='url' id='".$url."'>".$url."</span>".PHP_EOL;
					$uerre.="\t\t\t<span class='h3'>".$h3."</span>".PHP_EOL;
					$uerre.="\t\t\t<span class='h4'>".$h4."</span>".PHP_EOL;
					$uerre.="\t\t\t<span class='img'>".$img."</span>".PHP_EOL;
					$uerre.="\t\t\t<span class='descripcion'>".$desc."</span>".PHP_EOL;
				$uerre.="\t\t</div>".PHP_EOL;
			$uerre.="\t</div>".PHP_EOL;
			$linea.="<div class='nuncio ".$url."'>".PHP_EOL;
				$linea.="\t<a href='".$url."' target='_blank'>".PHP_EOL;
				$linea.="\t\t<h3>".$h3."</h3>".PHP_EOL;
				$linea.="\t\t<h4>".$h4."</h4>".PHP_EOL;
				$linea.="\t\t<img src='".$img."'/>".PHP_EOL;
				$linea.="\t\t<p>".$desc."</p>".PHP_EOL;
				$linea.="\t</a>".PHP_EOL;
			$linea.="</div>".PHP_EOL;
		}
	}catch(PDOException $e ){
			echo $e -> getMessage();
	}

	$conn = null; 		
?>