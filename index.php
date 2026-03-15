<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada 
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos 
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 
//oficial
?> 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>vertebrAragón</title>
	<meta property='og:description'   content='Si quieres cercanías a Gallur, Pedrola o Alagón, firma #vertebrAragón!' />
	<meta property='og:title' content='Manifiesto #vertebrAragón' />
	<meta property='og:type' content='website' />
	<meta property='og:url' content='https://vertebraragon.com/' />
	<meta property='og:image' content='https://vertebraragon.com/img/447Cercanias.jpg' />
	<meta property='og:image:alt' content='Cercanías para Alagón, Pedrola y Gallur' />
	<meta property='fb:app_id' content='575524579499276' />
	<meta name='twitter:card' content='summary' />
	<meta name='twitter:site' content='https://vertebraragon.com/' />
	<meta name='twitter:title" content='Manifiesto #vertebrAragón, Firmalo!' />
	<meta name='twitter:description' content='Si quieres cercanías a Gallur, Pedrola o Alagón, firma #vertebrAragón!' />
	<meta name='twitter:image' content='https://vertebraragon.com/img/447Cercanias.jpg' />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://vertebraragon.com/img/447Cercanias.jpg" rel="image_src" />
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="icon" sizes="64x64" href="https://vertebraragon.com/img/trenlogo.png">
<!-- 	<script src="js/mapa.js"></script> -->
	<script src="js/custom.js"></script>
 	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet">
</head>
<body>
<?php
	include("menu.php");
?>
	<section id="info" class='info'>
			<div class="miraflores-gallur"></div>

		<?php
			try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$consulta="SELECT id, nombre, fecha, titulo, comentario FROM comentarios WHERE aceptado=2";
				$result=$conn->prepare($consulta);
				$result->execute();
				$resultat=$result->fetch(PDO::FETCH_ASSOC);
				if($resultat && $resultat['id']){
					$line="<a class='nd' href='https://vertebraragon.com/comentarios#comm".$resultat['id']."' target='_blank'><div class='comentary'>";
					$line.="<div><span class='elnombre'>".$resultat['nombre']."</span><h2 class='titul'>".$resultat['titulo']."</h2></div>";
					$line.="<span class='ladat'>".date('d-m-Y, H:i:s',$resultat['fecha'])."</span>";
					$line.="<div class='commentary'>".nl2br($resultat['comentario'])."</div></div></a>";
					echo $line;
				}
			}catch(PDOException $e ){
				echo $e -> getMessage();
			}
			?>
	</section>
	<section id='manifiest' class='elmanifiesto'>
<!--		<div class='entrada'>
			<p>HOY, DÍA 8 DE JUNIO A LAS 19h, PRESENTACIÓN DEL #MANIFIESTO VERTEBRARAGON</p>
			<p>CENTRO CÍVICO ANTONIO FERNÁNDEZ MOLINA, C/Damas nº8-10, ALAGÓN</p>
		</div>-->
		<div class='tutisa'>
			<h2>Plataforma vertebrAragón</h2>
		</div>
		<div class='manifiest'>
			<?php
				include_once("manifiesto.html");
			?>
		</div>
	</section>
	<section id="inicio" class='imagenes'>
		<p class='correo'>Para cualquier duda o sugerencia, enviar un correo a <a href="mailto:&#105;&#110;&#102;&#111;&#64;&#118;&#101;&#114;&#116;&#101;&#98;&#114;&#97;&#114;&#97;&#103;&#111;&#110;&#46;&#101;&#115;"><strong>info<img src='https://vertebraragon.com/img/arroba.png' alt='arroba'/>vertebraragon.com</strong></a>
		</p>
		<p id='aki' class='center'>O rellenar el formulario de<a class='salto' href='#footer-two'>Contacto</a></p>
		<p class='center'><a target="_blank" href='https://www.facebook.com/VertebrArag%C3%B3n-614037938932187/'>Síguenos en Facebook</a></p>
		<p class='ppcs'>Para publicar <span>COMENTARIOS</span> elegid "Comentarios" en el <a href='#footer-two'>formulario de contacto</a>.</p>
	</section>
	<section id="contacto" class='contacto'>
		<div class='datos'>
			<div class='contacto'>
				<h2>FIRMA EL MANIFIESTO</h2>
				<form class="form">
					<label class='center'>Selecciona <strong>cargo político</strong> si lo eres y puedes influir políticamente en que se lleve a cabo este proyecto, ya sea por pertenecer a un territorio afectado o por tener potestad para ponerlo en marcha.</label>
					<div class='cargox'>
						<div><input type='radio' checked name='cargo' value=0>Ciudadano de a pié</div>
						<div><input type='radio' name='cargo' value=1>Cargo político</div>
						<input type='hidden' id='cargo' name='cargo' class='cargo' value=0>
					</div>					
					<div class='inputs'>						
						<input class="name" required pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="name" placeholder="Nombre *" type="text">
						<input class="name" required pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="apellidos" placeholder="Apellidos *" type="text">
						<input class="name" required pattern="^([A-Za-z]|[0-9]){1}[0-9]{7}[A-Za-z]{1}$" id="dni" placeholder="DNI/NIE *" type="text">
						<input class="name" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="profesion" placeholder="Profesión" type="text">
						<input class="email" required id="email" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="Email  *" type="email">
						<input class="email" id="email2" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="Repetir email para evitar errores *" type="email">
						<input required class="localidad" id="localidad" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" placeholder="Localidad *" type="text">
						<input required class="provincia" id="provincia" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" placeholder="Provincia *" type="text">
						<select name="privacidad" id="privacidad">
							<option value="0" selected="true">No ME IMPORTA que GOOGLE me asocie con este MANIFIESTO</option>
							<option value="1">NO QUIERO que GOOGLE me asocie con este MANIFIESTO</option>
						</select>
					</div>
					<p class='firsta'>* Datos Obligatorios</p>
					<p>De conformidad con lo dispuesto en la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, te informamos de que los datos personales que nos proporciones serán incorporados a un fichero automatizado de datos de carácter personal, con la finalidad de gestionar las comunicaciones que podamos realizar contigo.</p>
					<p>Así mismo se publicarán, nombre, apellidos, profesión, municipio y provincia del o de la firmante de este manifiesto en este mismo portal web, como firmante del propio documento.</p>
					<p>Para ejercitar los derechos de acceso, rectificación, oposición y cancelación reconocidos por la legislación vigente, el interesado deberá realizar una comunicación a info@vertebraragon.com, indicando como asunto “Protección de datos”. </p>
					<p>Asumimos que al registrarte estás conforme con estas advertencias legales. </p>
					<input class="enviar" value="Enviar" type="submit">
					<div class='pepito'></div>
				</form>
				<p>Según parece algunos dispositivos están teniendo problemas para poder firmar, les da un error. Con el fin de tratar de corregir el mismo os rogaríamos que nos enviárais un mensaje si ese es vuestro caso, desde el <a href="#ideas">formulario de contacto</a>, indicándonos desde que dispositivo estáis intentando firmar, marca y modelo. Si en vuestro caso aparece el error, al margen de mandarnos un mensaje con lo solicitado, podéis tratar de firmar con otro dispositivo mientras se resuelve la incidencia, gracias por vuestra comprensión.</p>				
			</div>
			<div class='agradecimientos oculto'>
				<h2>Muchas gracias por tu firma. </h2>
				<div class="dos">
					<a target="_blank" href="http://www.facebook.com/sharer.php?u=https://vertebraragon.com&amp;t=Manifiesto"><img src="https://vertebraragon.com/img/fb.png" title="compartir en facebook" alt="compartir en fb">Compartir en FaceBook</a>
					<a href="http://twitter.com/home?status=Manifiesto%20vertebrAragón%20https://vertebraragon.com" title="Compartir en Twitter" target="_blank"><img src="https://vertebraragon.com/img/tw.png" title="compartir en Twitter" alt="compartir en Twitter">Compartir en Twitter</a>
				</div>			
			</div>
		</div>
<?php
					$consulting="SELECT * FROM municipios;";	
					$resultaka=$conn->prepare($consulting);
					$resultaka->execute();
					$resultadoak = $resultaka->fetchAll(PDO::FETCH_ASSOC);
					$trenes=array();
					$lestrains="";
					$i=0;
					$pueblos=array();
					foreach ($resultadoak as $valores) {
						$cons="SELECT count(*) as signatures FROM firmas WHERE localidad LIKE '%".$valores['encuentra']."%'";
						$res=$conn->prepare($cons);
						$res->execute();
						array_push($pueblos,$valores['localidad']);	
						$resto = $res->fetch();
						$porcentaje=round((($resto['signatures']*100)/$valores['habitantes']),2);
						$linek="\t\t<input type='hidden' class='".$valores['encuentra']." pct' value='".$porcentaje."'>".PHP_EOL;
						$trenes[$porcentaje.$i++]='<div class="tren" style="background-position-x:'.(10+$porcentaje).'%"><span class="loca">'.$valores['localidad'].'</span></div>';
						if($valores['localidad']=='Pleitas')$porcentaje=-0.6;
						$lestrains.='<div class="tren" style="background-position-x:'.(10+$porcentaje).'%"><span class="loca">'.$valores['localidad'].'</span></div>'.PHP_EOL;

						echo $linek;
					}
					
?>		
		<div class='mapa'>
			<object data="img/riberaltad.svg" width="100%" height="100%" type="image/svg+xml" id="svg1"></object>
		</div>
	</section>
	<section class='trenada'>
<?php
	rsort($trenes);
	$texto=implode($trenes,PHP_EOL);
	//echo $texto;
	echo $lestrains;
?>
	</section>
	<section  class='firmas'>
		<div id="apoyo" class="apoyo">
			<h2>Apoyan</h2>
			<?php
				try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
				$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$result=$conn->prepare("SELECT * from firmas;");
				$result->execute();
				$CountReg = $result -> fetchAll();
				$numero = count($CountReg);
			}catch(PDOException $e ){
				echo $e -> getMessage();
			}
			?>
			<h4><span class='numero'><?php echo $numero; ?></span>  personas ya han firmado el manifiesto</h4>
			<p class="middle">20 últimas firmas, <a rel="nofollow" target="_blank" href="https://vertebraragon.com/listado/">Ver Listado completo</a></p>			
		</div>
		<?php
			include('firmasmanifiesto.php');
		?>
		<p class='middle'><a rel="nofollow" target="_blank" href="https://vertebraragon.com/listado/">Ver Listado completo</a></p>		
	</section>
	<section class='sitios'>
		<div class='tutisa'>
			<h2>Municipios que apoyan el manifiesto</h2>
		</div>
		<div class='munipoyo'>
			<div class='titulos'>
				<div class='tit'>Municipo</div><div class='cont'>Contribución porcentual al total</div>
			</div>
<?php
	try{
		$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$resulta=$conn->prepare("SELECT distinct(localidad), count(*) as firmas FROM `firmas` group by localidad order by firmas desc");
		$resulta->execute();
		$resultados= $resulta->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultados as $valoress){
			//print_r($pueblos);
			if((!in_array($valoress['localidad'],$pueblos))){
				echo "<div class='linea adhesiones'><div class='pbl'>".$valoress['localidad']."</div><div class='percent'>".round((($valoress['firmas']*100)/$numero),2)."</div></div>";
			}
		}
	}catch(PDOException $e ){
		echo $e -> getMessage();
	}		
?>
		</div>
	</section>	
	<div class='sube'></div>
	<footer>
		<div class='footer-two' id='footer-two'>
		<?php
			include('ideas.php');
		?>
		</div>		
		<div class='footer-one'>
			<p>©vertebrAragón</p>
		</div>
	</footer>
</body>
</html>