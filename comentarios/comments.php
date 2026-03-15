<?php
	function linea($id,$nombre,$titulo,$fecha,$comentario,$num,$final){
		$clase=($final==1)?" comm".$num:" padre";
		$line="<article id='comm".$id."' class='linea".$clase."'>";
		$line.="<div><span class='elnombre'>".$nombre."</span><h2 class='titul'>".$titulo."</h2></div>";
		$line.="<span class='ladat'>".date('d-m-Y, H:i:s',$fecha)."</span>";
		$line.="<div class='commentary'>".nl2br($comentario)."</div>";
		$line.="<p class='answer'><span>Responder</span></p>";
		$line.="</article>";
		/*echo $id.",".$titulo.",".$fecha.",".$comentario."<br/>";*/
	return $line;
	}

	function sigue($id,$conn){
		$line="";
		/*$a=0;*/
		try{
			$consulte="SELECT id,padre,nombre,fecha,titulo,comentario FROM comentarios WHERE padre=".$id." AND id!=".$id." AND aceptado>0 order by id ASC";
			/*echo $consulte."<br/>";*/
			$resulta=$conn->prepare($consulte);
			$resulta->execute();
			$res=$resulta->fetchAll();
			if(count($res)>0){
				foreach($res as $rezul){
					$line.=linea($rezul['id'],$rezul['nombre'],$rezul['titulo'],$rezul['fecha'],$rezul['comentario'],$rezul['padre'],1);
					$line.=sigue($rezul['id'],$conn);
				}
				return $line;
			}
			$a=0;
		}catch(PDOException $e ){
			echo $e -> getMessage();
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <style>
		div.portada {
		    background-image: url("../img/trenlogo.png");
		    background-repeat: no-repeat;
		    background-size: 60% 83%;
		    flex-basis: 6%;
		    margin-left: 2%;
		}
		form#ideas {
		    font-size: 0.8em;
		    left: 25%;
		    line-height: 1em;
		    position: absolute;
		    text-align: center;
		    width: 100%;
		    z-index: 100;
		}		
		header {
		    display: flex;
		    flex-flow: row wrap;
		    justify-content: space-between;
		    min-height: 80px;
		}
		header.portada {
		    background-image: url("../img/loggo.png");
		    background-repeat: no-repeat;
		    flex-basis: 12%;
		    height: 151px;
		    vertical-align: middle;
		    width: 200px;
		}
		header ul {
		    display: flex;
		    flex-flow: row wrap;
		    justify-content: space-around;
		    list-style-type: none;
		    vertical-align: middle;
		}		
		nav {
		    flex-grow: 1;
		    height: 3em;
		    vertical-align: middle;
		}		
	</style>
	</head>
	<body>
		<header>
			<div class='portada'></div>
			<nav>
				<ul>
					<li class='inicio'><a class="active" href="#info">Inicio</a></li>
					<li class='comentar'><a href="#comentarios">Comentarios</a></li>
				</ul>
			</nav>
		</header>
		<div id="main">
			<div id="principal">
				<section class='primera'>
					<h1>COMENTARIOS, IDEAS, DUDAS</h1>
					<div class='correo'>
						<p>Para cualquier duda o sugerencia, enviar un correo a <a href="&#109;&#97;&#105;&#108;&#116;&#111;&#58;&#115;&#101;&#103;&#117;&#105;&#109;&#111;&#115;&#101;&#110;&#99;&#111;&#110;&#115;&#116;&#114;&#117;&#99;&#99;&#105;&#111;&#110;&#64;&#103;&#109;&#97;&#105;&#108;&#46;&#99;&#111;&#109;"><strong>info<img src='https://vertebraragon.com/img/arroba.png' alt='arroba'/>vertebraragon.com</strong></a></p>
						<p class='contactum'>Desplegar para agregar comentarios</p>
					</div>
					<?php
						include("../idees.php");
					?>
					<div class='comentarios'>
						<?php
							try{
								$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
								$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
							}catch(PDOException $e ){
								echo $e -> getMessage();
							}			
							$lst=array();
							try{
				        		$consulta="SELECT id, padre, nombre, fecha, titulo, comentario from comentarios WHERE aceptado>0 AND id=padre order by id DESC";
				        		/*echo $consulta;*/
								$result=$conn->prepare($consulta);
								$result->execute();
								$resultado = $result->fetchAll();
							    foreach ($resultado as $valor) {
							    	$father=$valor['padre'];
							    	$line.=linea($valor['id'],$valor['nombre'],$valor['titulo'],$valor['fecha'],$valor['comentario'],$valor['id'],0);
									$line.=sigue($valor['id'],$conn);
						        }
							}catch(PDOException $e ){
									echo $e -> getMessage();
							}
							echo $line;
							$conn = null; 
						?>
					</div>
				
					<aside>
					</aside>
				</section>
			</div>
		</div>
		<footer>
			<p>@vertebrAragón</p>
		</footer>
	</body>
</html>	