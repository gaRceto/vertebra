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
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Listado Completo #vertebrAragón</title>
	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="../css/listado.css">
	<link rel="icon" sizes="64x64" href="https://vertebraragon.com/img/trenlogo.png">
</head>
<body>
<nav>
	<div  class='portada'></div>
	<div class='menu'>
		<div class='elmenu'>MENU</div>
		<ul class='ulportada'>
			<li class='inicio'><a class="active" href="https://vertebraragon.com/">Inicio</a></li>
			<li class='noticias'><a href="https://vertebraragon.com/noticias">Noticias</a></li>
			<li class='comentarios'><a href="https://vertebraragon.com/comentarios">Comentarios</a></li>
		</ul>
	</div>
</nav>
<section id="info" class='info'></section>
<section id='firmas' class='listadocompleto firmas'>
	<div class="apoyos">
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
	</div>
	<div class='cuadro'>
		<div class='titulos'>
			<div>Nombre</div>
			<!--<div>DNI</div>-->
			<div>Profesión/<span class='red'>Cargo</span></div>
			<div>Localidad</div>
			<!--<<div>Provincia</div>-->
		</div>
		<div class='listado'>
			<?php
				try{
					$result=$conn->prepare( "SELECT CONCAT(name,' ',apellidos) as name, profesion, localidad, provincia, cargo FROM firmas ORDER BY id DESC;");
					$result->execute();
					$resultado = $result->fetchAll();
					$line="";
				    foreach ($resultado as $valor) {
			    	$line.="<div class='linea";
			    	//$dni=$valor['dni'];

			    	$line.=($valor["cargo"]==1)?" cargada'>":"'>";
				        	$line.="<div>".$valor["name"]."</div>";
				        	//$line.="<div>".$dni."</div>";
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
</section>	
<div class='sube'></div>
<footer class='lst'>
	<p>©vertebrAragón</p>
</footer>
<script type="text/javascript">
var menu=document.querySelector(".elmenu");
menu.addEventListener("click",despliega,false); 
var inicio=document.querySelector("div.portada");
inicio.addEventListener("click",alinicio,false);
window.addEventListener("scroll",verScroll,false);
var sube=document.querySelector(".sube");
sube.addEventListener("click",tope,false);
sube.addEventListener("mouseover",fulla,false);
sube.addEventListener("mouseout",fori,false);
function tope(evt){
  window.scrollTo(0,0);
}
function fulla(evt){
  var sube=document.querySelector(".sube");
  if(sube.style.opacity>0)
    sube.style.opacity="1";
}
function fori(evt){
  var sube=document.querySelector(".sube");
  if(sube.style.opacity>0)
    sube.style.opacity="0.7";
}

function verScroll(evt){
  var sube=document.querySelector(".sube");
  if(window.scrollY > 100){
    sube.style.opacity="0.7";
    sube.style.width="60px";
    sube.style.cursor="pointer";
  }
  else{
    sube.style.opacity="0";
    sube.style.width="0";
    sube.style.cursor="initial";
  }
}
function alinicio(evt){
  document.querySelector(".ulportada li.inicio a").click();
}
function despliega(evt){
  evt.target.className=evt.target.className+" oculto";
  var portada=document.querySelector(".ulportada");
  portada.className=portada.className+" flexado";
  var span=document.createElement("span");
  span.className="cierre";
  span.textContent="X Cerrar";
  span.addEventListener("click",recoge,false);
  span.addEventListener("touchstart",recoge,false);
  var menu=document.querySelector(".menu");
  menu.appendChild(span);
}
function recoge(evt){
	evt.preventDefault();
  var cierre=document.querySelector(".menu .cierre");
  cierre.remove();
  var elmenu=document.querySelector(".elmenu");
  elmenu.className="elmenu";
  var portada=document.querySelector(".ulportada");
  portada.className="ulportada";
}
function activar(evt){
  var clase=document.querySelector(".ulportada li a.active");
  clase.className=clase.className.replace("active","");
  evt.target.className=evt.target.className="active";
  recoge(evt);
}
</script>
</body>
</html>