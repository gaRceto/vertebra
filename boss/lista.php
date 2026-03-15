<?php
					//$line=$consulta."<br/>";
					$consulta="SELECT * FROM municipios;";	
					$result=$conn->prepare($consulta);
					$result->execute();
					$resultado = $result->fetchAll(PDO::FETCH_ASSOC);
					foreach ($resultado as $valor) {
						$line.="<div class='municipio'>".PHP_EOL;
						$line.="\t\t<div contenteditable='true' class='localidad'>".$valor['localidad']."</div>".PHP_EOL;
						$line.="\t\t<div contenteditable='true' class='encuentra'>".$valor['encuentra']."</div>".PHP_EOL;
						$line.="\t\t<div contenteditable='true' class='gentilicio'>".$valor['gentilicio']."</div>".PHP_EOL;
						$line.="\t\t<div contenteditable='true' class='habitantes'>";
						$cons="SELECT count(*) as signatures FROM firmas WHERE localidad LIKE '%".$valor['encuentra']."%'";	
						$res=$conn->prepare($cons);
						$res->execute();
						$resto = $res->fetch();
						$votos=$resto['signatures'];
						$porcentaje=round((($votos*100)/$valor['habitantes']),2);
						$line.="<span style='color:green'>".$votos."</span><span style='font-weight:bold'>/</span><span style='color:blue'>".$valor['habitantes']."</span></div>".PHP_EOL;
						$line.="\t\t<span class='".$valor['encuentra']." pct'>".$porcentaje."</span>".PHP_EOL;

						$line.="\t\t<span class='delete'>x</span><input type='hidden' class='elid' value='".$valor['id']."'>".PHP_EOL;

						$line.="</div>".PHP_EOL;
						$trenes.='<div class="tren" style="background-position-x:'.(10+$porcentaje).'%"><span class="loca">'.$valor['localidad'].'</span></div>'.PHP_EOL;
					}
					echo $line."<div class='trenes'>".$trenes."</div>";
?>