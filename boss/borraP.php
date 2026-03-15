<?php
	$json=json_decode(file_get_contents('php://input'));
	$id=$json->id;
	try{
		$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$consulta="DELETE FROM municipios WHERE id='".$id."'";
		$result=$conn->prepare($consulta);
		$result->execute();	
		$consulta="ALTER TABLE municipios AUTO_INCREMENT=1";
		$result=$conn->prepare($consulta);
		$result->execute();	
		$consulta="SELECT * FROM municipios;";	
		$result=$conn->prepare($consulta);
		$result->execute();
		$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultado as $valor) {
			$line.="<div class='municipio'>".PHP_EOL;
			$line.="\t\t<div contenteditable='true' class='localidad'>".$valor['localidad']."</div>".PHP_EOL;
			$line.="\t\t<div contenteditable='true' class='gentilicio'>".$valor['gentilicio']."</div>".PHP_EOL;
			$line.="\t\t<div contenteditable='true' class='habitantes'>".$valor['habitantes']."</div>".PHP_EOL;
			$cons="SELECT count(*) as signatures FROM firmas WHERE localidad LIKE '%".$valor['localidad']."%'";	
			$res=$conn->prepare($cons);
			$res->execute();
			$resto = $res->fetch();
			$porcentaje=round((($resto['signatures']*100)/$valor['habitantes']),2);
			$line.="\t\t<span class='pct'>".$porcentaje."</span>".PHP_EOL;

			$line.="\t\t<span class='delete'>x</span><input type='hidden' class='elid' value='".$valor['id']."'>".PHP_EOL;

			$line.="</div>".PHP_EOL;
		}
		echo $line;
	}catch(PDOException $e ){
			echo $e -> getMessage();
	}

	$conn = null; 
			
?>