<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8"/>
	<title>Municipios</title>
	<meta name="description"	content="Municipios Ribera Alta"/>
	<meta name="viewport" 		content="width=device-width,initial-scale=1"/>
<!--	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="../datepicker.js"></script>	
	<link href="../datepicker.css" 	rel="stylesheet" type="text/css" media="screen" />-->
	<link href="../menu.css" 	rel="stylesheet" type="text/css" media="screen" />
	<!--<link rel="shortcut icon" 	type="image/x-icon" href="favico.ico" />
	<link href="estilo.css" 	rel="stylesheet" type="text/css" media="screen" />
	<script src="registro.js"></script>
	<link rel="author" 				type="text/plain" href="humans.txt" />
	<link rel="sitemap" 			type="application/xml" title="Sitemap" href="sitemap.xml" />	-->
	<style>
		html{
			background:rgba(100,30,200,.5);
			font-size:bold;
			height:100%;
			width:100%;
		}
		body{
			height:100%;
			width:100%;
		}
		.one, .two {
			box-sizing: border-box;
			margin: auto;
			padding: 1%;
			text-align: center;
			width: 80%;
		}
		form#tarifa{
			padding:0;
			width:100%;
		}
		form#tarifa > input{
			display:inline-block;
		}
		object {
		    width: 30%;
		    margin-top: 3rem;
		}		
		#encabezado {
		    display: flex;
		    flex-flow: row wrap;
		    justify-content: space-between;
		    background-color: green;
		    padding: 1%;
		}
		
		.lineas{
			color:white;
			background:rgba(20,20,240,.5);
			border-bottom:1px solid rgba(199, 178, 228, 0.5);
			line-height:20pt;
		}
		
		.lineas > div{
			display:inline-block;
		}
		
		.lineas *:first-child{
			color:black;
			width:2%;
		}
		.lineas *:first-child:hover{
			color:rgba(255,0,0,.6);
			cursor:pointer;
		}
		.lineas *:nth-child(2){
			width:8%;
		}
		.lineas *:nth-child(3){
			width:70%;
		}				
		.lineas *:nth-child(4){
			width:18%;
		}
		.municipio {
		    display: flex;
		    flex-flow: row wrap;
		    justify-content: space-between;
		    background-color: rgba(200,200,200,.6);
		    border:1px solid black;
		    padding:1%;
		}
		.municipio div {
		    flex-basis: 20%;
		    text-align: end;
		    align-content: center;
		    align-self: center;
		}
		.municipio .delete {
		    background-color: rgba(255,255,255,1);
		    transition: all .7s;
		    color: red;
		    opacity: .6;
		    border-radius: 50%;
		    padding: .5%;
		    cursor:pointer;
		}
		.municipio .delete:hover{
			opacity: 1;
		}
		.pct::after {
		    content: "%";
		}
		.pct {
		    font-size: .7rem;
		    transform: rotate(15deg);
		    color: red;
		    background-color: white;
		    align-self: center;
		    padding: 3px;
		}
		.tren {
			background-image: url(../img/trenpb.png);
			background-repeat: no-repeat;
		    margin-top: 2px;
		    color: white;
		    position: relative;
		    border-bottom: 1px solid;
		}
		.loca {
		    font-size: .8rem;
		    display: block;
		    text-align: right;
		}
	</style>
</head>
<body>
	<?php
		//include_once("../menu.php");
		//SELECT DATE_FORMAT(date(fecha),'%d-%m-%Y') as fecha, count(id) as num_firmas FROM `firmas` group by date(fecha) order by num_firmas desc
	?>
	<!--pattern="^[0-9]{9}$"-->
	<div class="one">
		<button id="limpiar">Limpiar</button>
		<button id="enviar">Enviar</button>
		<form name="pueblos" id="pueblos" class="formulario">
			<!--<input placeholder="acrónimo" name="acr" id="acr" maxlength="3" required>-->
			<input placeholder="localidad" name="localidad" id="localidad" maxlength="200" required>
			<input placeholder="encuentra" name="encuentra" id="encuentra" maxlength="200" required>
			<input placeholder="gentilicio" name="gentilicio" id="gentilicio" maxlength="200" required>
			<input placeholder="habitantes" name="habitantes" id="habitantes" maxlength="5" required>
		</form>
	</div>
	<div class="two">
		<div id="encabezado">
			<div id="descripcion">MUNICIPIO</div><div id="encuentra">ENCUENTRA</div><div id="gentilicio">GENTILICIO</div><div id="cuota">HABITANTES</div>
		</div>
		<div id="lineas">
		<?php
		try{
			$conn = new PDO('mysql:host=localhost; dbname=vertebraragon', 'myelegirco', 'qR024AJp');
			$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			//$user = array('localidad'=>$pueblo,'habitantes'=>$habitantes);
			include("lista.php");
}catch(PDOException $e ){
		echo $e -> getMessage();
}

$conn = null; 
		?>
		</div>
		<object data="../img/riberaltad.svg" width="100%" height="100%" type="image/svg+xml" id="svg1"></svg>
	</div>
	<script>
	var campoedit="";
	document.querySelector("#enviar").addEventListener("click",enviar,false);
	lineas();
	document.getElementById("svg1").addEventListener("load", function() {
	    var doc = this.getSVGDocument();
	    var rect = doc.querySelectorAll("#riberalta path"); // suppose our image contains a <rect>
	    for(i in rect)
	    	if(rect[i].tagName){
	    		//rect[i].setAttribute("fill", "green");
	    		//rect[i].setAttribute("stroke")
	    		//alert(rect[i].id);
	    		var pct=document.querySelector("."+rect[i].id+".pct");
	    		pct=pct.textContent;

	    		pct=(pct/100)+0.2;
	    		var fop="fill-opacity:"+pct;
	    		rect[i].style="fill:green;stroke:context-fill;stroke-width:.5;"+fop;
	    	}
	});


	function limpiar(){
		var form=document.querySelector("form");
		form.reset();
	}
	
	function enviar(evt){
		evt.preventDefault();
		var tarifa=document.querySelector("form#pueblos");
		var valido=(vacio() && tarifa.checkValidity());
		if(valido){
			var json=formaJSON();
			json['insercion']="si";
			var r = new XMLHttpRequest();
			r.open("POST", "dentropueblo.php", true);
			r.setRequestHeader("Content-type", "application/json;charset=UTF-8");
			// r.setRequestHeader("Content-length",json.length);
			// r.setRequestHeader("Connection", "close");		
			r.onreadystatechange = function () {
			 if (r.readyState != 4 || r.status != 200) return;
				document.querySelector("#lineas").innerHTML=r.responseText;
				limpiar();
				lineas();
			};
			r.send(JSON.stringify(json));
		}	
	}
	
	function vacio(){
		var form=document.querySelector("form");
		var els=form.querySelectorAll("input[name]:not([type='radio']):not([type='submit']),select,checkbox");
		for(var i in els){
			if(!!els[i].tagName){
				if(els[i].value.replace(/\s*$/g,"")==""){
					alert("Campo "+els[i].placeholder+" vacío");
					return false;
				}
			}	
		}
		return true;
	}
	
	
	function formaJSON(){
		var obj={};
		var form=document.querySelector("form");
		var els=form.querySelectorAll("input[name]:not([type='radio']):not([type='submit']),select,checkbox");
		for(var i in els)
		  if(!!els[i].tagName){
			obj[els[i].id]=els[i].value;
		}
		return obj;
	}


	function lineas(){
		var sec=document.querySelectorAll(".municipio div:not([class='delete'])");
		for(i in sec){
		   if(!!sec[i].tagName){
			 sec[i].addEventListener("keydown",cual,false);
			 sec[i].addEventListener("keypress",stopenter,false);
			 sec[i].addEventListener("click",conserpo,false);
			 sec[i].addEventListener("blur",primnome,false);
			 }
		 }

		 var del=document.querySelectorAll("#lineas .delete");
		 for(i in del)
			if(del[i].tagName)
				del[i].addEventListener("click",borrado,false);

		 
	}
			 
		// for(var i in encabeza)
			// if(!!encabeza[i].tagName)
				// encabeza[i].addEventListener("click",ordena,false);		

				
	function borrado(evt){
	
		var id=evt.target.nextElementSibling.value;
		if(!confirm("¿Estás seguro que quieres borrar la entrada "+id+"?")){
			return;
		}else{
			if(prompt("Confirma Pues!")!="confirmado")
				return;
		}
		var params={'id':id};
		var r = new XMLHttpRequest();
		r.open("POST", "borraP.php", true);
		r.setRequestHeader("Content-type", "application/json;charset=UTF-8");
		r.setRequestHeader("Content-length",params.length);
		r.setRequestHeader("Connection", "close");		
		r.onreadystatechange = function () {
		 if (r.readyState != 4 || r.status != 200) return;
			document.querySelector("#lineas").innerHTML=r.responseText;
			lineas();
		};
		r.send(JSON.stringify(params));				
	}
	
	
	function conserpo(evt){
		if(campoedit=="")
			campoedit=evt.target.textContent;
	}
	
	function primnome(evt){
		campoedit="";
	}
	
	function stopenter(evt){
		var tecla=(!evt.which)?evt.keycode:evt.which;
		if(tecla==13)
			evt.preventDefault();
	}
	
	function cual(evt){
		var tecla=(!evt.which)?evt.keycode:evt.which;
		console.log(tecla);
		if((tecla<48 || tecla>122) && tecla!=8 && tecla!=32 && tecla!=35 && tecla!=36 && tecla!=16 && tecla!=37 && tecla!=39 && tecla!=46)
			evt.preventDefault();
		if(tecla==27){
			evt.target.textContent=campoedit;
			evt.target.blur();
		}
		if(tecla==13){
			var rufi=campoedit;
			if(!confirm("¿Seguro que deseas actualizar?")){
				evt.target.textContent=rufi;
				evt.target.blur();
				return;
			}
			var id=evt.target.parentNode.querySelector("input[type='hidden']").value;
			var campo=evt.target.className;
			var valor=evt.target.textContent;
			var params={'id':id,'campo':campo,'valor':valor,'insercion':"no"};
			var r = new XMLHttpRequest();
			r.open("POST", "dentropueblo.php", true);
			r.setRequestHeader("Content-type", "application/json;charset=UTF-8");
			//r.setRequestHeader("Content-length",params.length);
			//r.setRequestHeader("Connection", "close");		
			r.onreadystatechange = function () {
			 if (r.readyState != 4 || r.status != 200) return;
				evt.target.blur();
				document.querySelector("#lineas").innerHTML=r.responseText;
				lineas();
			};
			r.send(JSON.stringify(params));			
		}
	}	
	</script>
</body>
</html>