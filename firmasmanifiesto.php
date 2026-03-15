<div class='cuadro'>
	<div class='titulos'>
		<div>Nombre</div>
		<!--<div>Dni</div>-->
		<div>Profesión/<span class='red'>Cargo</span></div>
		<div>Localidad</div>
		<!--<div>Provincia</div>-->
	</div>
	<div class='listado'>
		<?php
			try{
				$result=$conn->prepare( "SELECT CONCAT(name,' ',apellidos) as name, profesion, localidad, provincia, cargo FROM firmas WHERE privacidad=0 ORDER BY id DESC LIMIT 20;");
				$result->execute();
				$resultado = $result->fetchAll();
				$line="";
			    foreach ($resultado as $valor) {
			    	$line.="<div class='linea";
			    	$line.=($valor["cargo"]==1)?" cargada'>":"'>";
			        	$line.="<div>".$valor["name"]."</div>";
				        //$line.="<div>".$valor["dni"]."</div>";
				        $line.="<div>".$valor["profesion"]."</div>";
				        $line.="<div>".$valor["localidad"]." (".$valor["provincia"].")</div>";
			        $line.="</div>";
			    }				
				echo $line;
			}catch(PDOException $e ){
					echo $e -> getMessage();
			}
			$conn = null; 
		?>
	</div>
</div>
