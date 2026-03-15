<?php
	$json=json_decode(file_get_contents('php://input'));
	//if(isset(trim($json->localidad)) && isset(trim($json->habitantes))){
		try{
					$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
					$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
					if($json->insercion=="si"){
						$localidad=trim($json->localidad);
						$habitantes=trim($json->habitantes);
						$gentilicio=trim($json->gentilicio);
						$encuentra=trim($json->encuentra);
						$user = array('localidad'=>$localidad,'gentilicio'=>$gentilicio,'encuentra'=>$encuentra, 'habitantes'=>$habitantes);
						$consulta="INSERT INTO municipios(localidad, gentilicio, encuentra, habitantes) 
							VALUES(:localidad, :gentilicio, :encuentra, :habitantes);";
						$result=$conn->prepare($consulta);
						$result->execute($user);
					}else{
						$consulta="UPDATE municipios set ".$json->campo."='".$json->valor."' WHERE id='".$json->id."'";
						$result=$conn->prepare($consulta);
						$result->execute();
					}
//					$line=$consulta."<br/>";
					include("lista.php");
		}catch(PDOException $e ){
				echo $e -> getMessage();
		}

		$conn = null; 

	//}	




?>