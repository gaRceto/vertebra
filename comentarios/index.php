<?php
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada 
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos 
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 
?> 
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Comentarios#vertebrAragón</title>
 	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet">
	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="../css/comments.css">
	<link rel="icon" sizes="64x64" href="https://vertebraragon.com/img/trenlogo.png">
</head>
<body>
<nav>
	<div  class='portada'></div>
	<div class='menu'>
		<div class='elmenu'>MENU</div>
		<ul class='ulportada'>
			<li class='inicio'><a class="active" href="https://vertebraragon.com/">Inicio</a></li>
			<li class='comments'><a href="https://vertebraragon.com/noticias">Noticias</a></li>
		</ul>
	</div>
</nav>
<section class='info' id='info'>
</section>
<section id='inicio' class='imagenes dwn'>
		<h1>COMENTARIOS, IDEAS, DUDAS</h1>
	<!-- <div class="laportada"> -->
		<!-- <img src="../img/portadabrir.jpg" alt=""> -->
	<!-- </div> -->
</section>

<section id='comments' class='comments firmas'>
	<div class="apoyos">
		<?php
			try{
			$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}catch(PDOException $e ){
			echo $e -> getMessage();
		}
		?>
	</div>
	<div class='cuadro'>
		<div class='commentaires'>
			<?php
				$lst=array();
				try{
	        		$consulta="SELECT id, padre, nombre, fecha, titulo, comentario from comentarios WHERE aceptado>0 AND id=padre order by id DESC ";
	        		/*echo $consulta;*/
					$result=$conn->prepare($consulta);
					$result->execute();
					$resultado = $result->fetchAll();
					$line="";
				    foreach ($resultado as $valor) {
				    	//echo $valor['id'];
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
	</div>
<?php
function linea($id,$nombre,$titulo,$fecha,$comentario,$num,$final){
	$clase=($final==1)?" comm".$num:" padre";
	$line="<div id='comm".$id."' class='linea".$clase."'>";
	$line.="<div><span class='elnombre'>".$nombre."</span><h2 class='titul'>".$titulo."</h2></div>";
	$line.="<span class='ladat'>".date('d-m-Y, H:i:s',$fecha)."</span>";
	$line.="<div class='commentary'>".nl2br($comentario)."</div>";
	$line.="<p class='answer'><span>Responder</span></p>";
	$line.="</div>";
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

</section>
<footer class='lst'>
	<div class='footer-two' id='footer-two'>
	<?php
		include('../ideas.php');
	?>
	</div>		
	<div class='footer-one'>
		<p>©vertebrAragón</p>
	</div>
</footer>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded",initia,false);


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


function initia(evt){
	var inicio=document.querySelector("div.portada");
	inicio.addEventListener("click",alinicio,false);
	var menu=document.querySelector(".elmenu");
	menu.addEventListener("click",despliega,false); 
	var asinicio=document.querySelector("div.portada");
	asinicio.addEventListener("click",alinicio,false);	
	var responder=document.querySelectorAll(".answer span");
	var recargaR=document.querySelector(".recarga");
	  recargaR.addEventListener("click",recarga,false);
	  recarga();
	 for(i in responder)
	 	if(responder[i].tagName)
			responder[i].addEventListener("click",responde,false); 
	var send=document.querySelector("#send");
	send.addEventListener("click",sendos,false);
    //var close=document.querySelector(".close");
  	//close.addEventListener("click",contactae,false);
	var input=document.createElement("input");
	input.type="hidden";
	input.value=0;
	input.name="padre";
	input.className="padre";
	document.querySelector("form#ideas").appendChild(input);
	document.querySelector(".mel").remove();
	//var contactum=document.querySelector(".contactum");
	//contactum.addEventListener("click",contactae,false);

	var todos=document.querySelectorAll(".commentaires>div");
	for(i in todos){
	  if(todos[i].tagName){
	    if(todos[i].className.indexOf(todos[i].id>-1) && todos[i].className.indexOf("padre")<0){
	       var clase=todos[i].className.replace("linea ","");
	       var izda=document.querySelector("#"+clase).offsetLeft;

	        todos[i].style.marginLeft=(izda+20)-(todos[i].offsetLeft)+"px";
	          
	     }
	  }
	}
}
function alinicio(evt){
  document.querySelector(".ulportada li.inicio a").click();
}
function contactae(evt){
  var pcontactum=document.querySelector("p.contactum");
  var abrir=(evt.target.textContent.indexOf("Desplegar")>-1)?true:false;
  var ideas=document.querySelector("#ideas");
  ideas.style.top=(window.scrollY+100)+"px";
  var mel=document.querySelector(".seccion option.mel");
  if(mel)
  	mel.remove();  
  if(abrir){
      ideas.className=ideas.className+" abierto";
      pcontactum.textContent=pcontactum.textContent.replace("Desplegar","Cerrar");
  }else{
      ideas.className=ideas.className.replace(" abierto","");
      pcontactum.textContent=pcontactum.textContent.replace("Cerrar","Desplegar");
  }
}

function cerrar(evt){
	var ideas=document.querySelector("#ideas");
	var contactae=document.querySelector(".contactum");
	ideas.className="ideas";
	ideas.querySelector("#ideas .padre").value=0;
	contactae.textContent=contactae.textContent.replace("Cerrar","Desplegar");
}

function responde(evt){
    var mel=document.querySelector(".seccion option.mel");
    if(mel)
  	  mel.remove();  
	//var contactae=document.querySelector(".contactum");
	var padre=document.querySelector(".padre");
	padre.value=evt.target.parentNode.parentNode.id.substr("comm".length);
	var ideas=document.querySelector("#ideas");
	if(ideas.className.indexOf("abierto")==-1)
		ideas.className=ideas.className+" abierto";
	window.scrollTo(0,window.scrollMaxY);
	//ideas.style.top=(window.scrollY+100)+"px";
	//contactae.textContent=contactae.textContent.replace("Desplegar","Cerrar");
}
function recarga(evt) {
  var imagen=document.querySelector(".cptz");    
  var respuesta=document.querySelector(".respuesta");
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
      imagen.src="../sis/captcha.php?"+Date();
  };
  xhr.open('GET', '../sis/genera.php', true);
  xhr.send();    
}
function sendos(evt){
  evt.preventDefault();
  var email=document.querySelector(".iemail");
  var titulo=document.querySelector(".ititulo");
  var nomape=document.querySelector(".inombre");
  var comentario=document.querySelector(".iidea");
  var captcha=document.querySelector("#claveReg");
  var seccion=document.querySelector(".seccion");
  var padre=document.querySelector(".padre");
  var params={'email':email.value,'nombre':nomape.value,'titulo':titulo.value,'comentario':comentario.value,'captcha':captcha.value,'seccion':seccion.value,'padre':padre.value};
  var ajox=new XMLHttpRequest();
  ajox.open("POST","../sis/replies.php",true);
 // ajox.setRequestHeader("Content-type","application/json;charset=UTF8");
  ajox.setRequestHeader("Content-length",params.length);    
  //ajox.setRequestHeader("Connection", "close");
  ajox.onreadystatechange=function(){
    if(ajox.readyState!=4 || ajox.status!=200) return;
      if(ajox.responseText.indexOf("ce el código")>-1 || ajox.responseText.indexOf("código introducido")>-1 || ajox.responseText.indexOf("mal")>-1){
        alert(ajox.responseText);
        return;
      }
	  var form=document.querySelector("form.ideas");
	  form.reset();
	  form.className="ideas";
//	  var contactae=document.querySelector(".contactum");
//	  contactae.textContent=contactae.textContent.replace("Cerrar","Desplegar");
	  alert(ajox.responseText);
  }
  ajox.send(JSON.stringify(params));      
}
</script>
</body>
</html>