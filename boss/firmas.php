<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Firmas, introducción Manual</title>
	<link rel="stylesheet" href="../css/estilo.css">
 	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet">
 	<style>
 	body{
 		line-height: inherit;
 		font-size:1rem;
 	}
	h2 {
	    font-size: 30px;
	} 	
	.inputs > input, .inputs > select {
		height:auto;
	}
	div.inputs {
	    margin-bottom: 1rem;
	}
	div.contacto{
		margin-top:3%;
	}	
	label.center {
	    margin-top: 0;
	}
	#mantener {
	    display: inline-block;
	    width: 20px;
	    margin-left: 5%;
	}
	.manten{
		color:white;
	}
 	</style>
</head>
<body>
	<section id="contacto" class='contacto'>
		<div class='datos'>
			<div class='contacto'>
				<form class="form">
					<div>
						<input class="name" required pattern="^([A-Za-z]|[0-9]){1}[0-9]{7}[A-Za-z]{1}$" id="dni" placeholder="DNI/NIE * [2445222R]" type="text">
					</div>
					<label class='center'>Selecciona <strong>cargo político</strong> si lo es y puede influir políticamente en que se lleve a cabo este proyecto, ya sea por pertenecer a un territorio afectado o por tener potestad para ponerlo en marcha.</label>
					<div class='cargox'>
						<div><input type='radio' checked name='cargo' value=0>Ciudadano de a pié</div>
						<div><input type='radio' name='cargo' value=1>Cargo político</div>
						<input type='hidden' id='cargo' name='cargo' class='cargo' value=0>
					</div>					
					<div class='inputs'>						
						<input class="name" required pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="name" placeholder="Nombre *" type="text">
						<input class="name" required pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="apellidos" placeholder="Apellidos *" type="text">
						<input class="name" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="profesion" placeholder="Profesión" type="text">
						<input class="email" id="email" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="Email" type="email">
						<input class="email" id="email2" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="Repetir email para evitar errores *" type="email">
						<input type="checkbox" id="mantener"><span class='manten'>Mantener localidad y provincia</span>
						<input required class="localidad" id="localidad" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" placeholder="Localidad *" type="text">
						<input required class="provincia" id="provincia" pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" placeholder="Provincia *" type="text">
						<select name="privacidad" id="privacidad">
							<option value="0" selected="true">No ME IMPORTA que GOOGLE me asocie con este MANIFIESTO</option>
							<option value="1">NO QUIERO que GOOGLE me asocie con este MANIFIESTO</option>
						</select>
					</div>
					<input class="enviar" value="Enviar" type="submit">
					<div class='pepito'></div>
				</form>
			</div>
		</div>
	</section>
	<section  class='firmas'>
		<div id="apoyo" class="apoyo">
			<h2>Apoyan</h2>
			<?php
				try{
				$conn = new PDO('mysql:host=localhost; dbname=vertebraragon', 'myelegirco', 'qR024AJp');
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
			<p class="middle">20 últimas firmas, <a rel="nofollow" target="_blank" href="https://vertebraragon.es/listado">Ver Listado completo</a></p>			
		</div>
		<?php
			include('../firmasmanifiesto.php');
		?>
	</section>
	<div class='sube'></div>
	<footer>
		<div class='footer-one'>
			<p>©vertebrAragón</p>
		</div>
	</footer>
	<script>
	document.addEventListener("DOMContentLoaded",initia,false);

	function initia(){
		var dni=document.getElementById("dni");
		dni.addEventListener("keyup",eldni,false);
		var boton=document.querySelector(".enviar");
	  	if(boton)
		    boton.addEventListener("click",envio,false);		
		var cargo=document.querySelectorAll(".cargox input");
		for(i in cargo)
		if(cargo[i].tagName)
		  cargo[i].addEventListener("change",camcargo,false);
	}

	function camcargo(evt){
		document.querySelector(".cargo").value=evt.target.value;
		if(evt.target.value==0)
		document.querySelector("#profesion").placeholder="Profesión";
		else
		document.querySelector("#profesion").placeholder="Cargo (Partido Político)";
	}


	function eldni(evt){
		evt.preventDefault();
		var dni=evt.target;
		if(!dni.checkValidity())
			return
		var parametros={"dni":dni.value};
		var ax=new XMLHttpRequest();
		ax.open("POST","dni.php",true);
		ax.setRequestHeader("Content-type","application/json;charset=UTF8");
		ax.onreadystatechange=function(){
			if(ax.readyState!=4 || ax.status!=200) return;
			if(ax.responseText.indexOf("ya ha firmado con este DNI")>-1){
			  alert(ax.responseText);
			  return;
			}else{
				dni.value=ax.responseText;
			}

		}
		ax.send(JSON.stringify(parametros));  
	}
	function envio(e){
		e.preventDefault();
		if(document.querySelector("form.form").checkValidity()==false){
			alert("Error en los datos introducidos, compruébalos");
		return;
		}
		var name = document.querySelector("input#name").value;
		var apellido = document.querySelector("input#apellidos").value;
		var dni = document.querySelector("input#dni").value;
		var profesion = document.querySelector("input#profesion").value;
		var email = document.querySelector("input#email").value;
		var email2=document.querySelector("input#email2").value;
		if(email2!=email){
		  alert("El correo electrónico no es el mismo, compruébalo.");
		return;
		}
		var localidad = document.querySelector("input#localidad").value;
		var provincia = document.querySelector("input#provincia").value;
		var cargo = document.querySelector("input#cargo").value;
		var privacidad = document.querySelector("select#privacidad").value;
		var parametros = {
			"name" : name,
			"apellidos" : apellido,
			"dni" : dni,
			"profesion" : profesion,
			"email" : email,
			"localidad" : localidad,
			"provincia" : provincia,
			"cargo" : cargo,
			"privacidad": privacidad
		  };
	  var ajax=new XMLHttpRequest();
	  ajax.open("POST","firmar.php",true);
	  ajax.setRequestHeader("Content-type","application/json;charset=UTF8");
	  ajax.onreadystatechange=function(){
	    if(ajax.readyState!=4 || ajax.status!=200) return;
	    if(ajax.responseText.indexOf("DNI existente")>-1){
	      alert(ajax.responseText);
	      return;
	    }
	    else{
			var num=document.querySelector(".numero");
			num.innerHTML=Number(num.innerHTML)+1;
			document.querySelector(".cuadro").innerHTML=ajax.responseText;
			var manten=document.querySelector("input#mantener").checked;
			document.querySelector(".contacto form").reset();
			if(manten){
				document.querySelector("input#mantener").checked=true;
				document.querySelector("input#localidad").value=localidad;
				document.querySelector("input#provincia").value=provincia;
			}
	    }
	  }
	  ajax.send(JSON.stringify(parametros));    
	}

	</script>
</body>
</html>