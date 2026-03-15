<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>tal y cuar</title>
	<link rel="stylesheet" href="stilo.css">
</head>
<body>
	<div class='bifase'>
		<div class='enlaces'>
			<div id="insercion">
				<input id='url' placeholder='url'>
				<button id="enlace">enviar</button>
				<button id="grabar">grabar</button>		
			</div>
<?php
	include("carganot.php");
?>			
			<div id="datos">
				<input class='elid' type='hidden'>
				<input class='sitio' type='text'>
				<input class='direccion' type='text'>
				<input class='titulo' type='text'>
				<input class='imagen' type='text'>
				<textarea class='descripcion'></textarea>
				<div class='urls'>
<?php					
				echo $uerre;
?>
				</div>	
			</div>		
		</div>		
		<div id="anuncios">
<?php			
		echo $linea;
?>
		</div>
	</div>
	<script type="text/javascript">
		var boton=document.querySelector("#enlace");
		boton.addEventListener("click",envio,false);
		var graba=document.querySelector("#grabar");
		graba.addEventListener("click",guardar,false);
		var anuncios=document.querySelector("#anuncios");
		window.addEventListener("load",dale,false);

		function dale(evt){
			var urls=document.querySelectorAll(".litUrl");
			for(i in urls)
				if(urls[i].tagName)
					urls[i].addEventListener("click",inpud,false);
			var records=document.querySelectorAll(".record");
			for(i in records)
				if(records[i].tagName)
					records[i].addEventListener("click",newReg,false);

			var delletes=document.querySelectorAll(".dellete");
			for(i in delletes)
				if(delletes[i].tagName)
					delletes[i].addEventListener("click",borra,false);

		}
		function guardar(evt){
			var datos=document.querySelector("#datos");
			var enlace=datos.querySelector(".direccion").value;
			var h3=datos.querySelector(".sitio").value;
			var h4=datos.querySelector(".titulo").value;
			var url=datos.querySelector(".direccion").value;
			var img=datos.querySelector(".imagen").value;
			var descripcion=datos.querySelector(".descripcion").value;
			var anuncio=document.getElementsByClassName(url);
			var anuncio=anuncio[0];
			var localiza=document.getElementById(enlace);
			var padre=localiza.parentNode;
			anuncio.querySelector("a").href=url;
			anuncio.querySelector("h3").textContent=h3;
			anuncio.querySelector("h4").textContent=h4;
			anuncio.querySelector("img").src=img;
			anuncio.querySelector("p").textContent=descripcion;
			padre.querySelector("span.h3").textContent=h3;
			padre.querySelector("span.url").textContent=url;
			padre.querySelector("span.h4").textContent=h4;
			padre.querySelector("span.img").textContent=img;
			padre.querySelector("span.descripcion").textContent=descripcion;

			//var params={'noticias':document.querySelector("#anuncios").innerHTML};
			var params={'url':url,'h3':h3,'h4':h4,'imagen':img,'descripcion':descripcion};
			var ajxx=new XMLHttpRequest();
			ajxx.open("POST","noticias.php",true);
			ajxx.setRequestHeader("Content-type","application/json;charset=UTF8");	
		//	ajxx.setRequestHeader("Connection", "close");
			ajxx.onreadystatechange=function(){
				if(ajxx.readyState!=4 || ajxx.status!=200) return;
				alert(ajxx.responseText);
			}			
			ajxx.send(JSON.stringify(params));
			//alert(evt.target.parentNode.id);

		}

		function borra(evt){
			if(!confirm("Estás serguro de querer borrar?"))
				return;
			var id=evt.target.parentNode;
			var url=id.firstElementChild.title;
			id.remove();

			var clase=document.getElementsByClassName(url);
			clase[0].remove();

			var params={"url":url};
			var ajxx=new XMLHttpRequest();
			ajxx.open("POST","borra.php",true);
			ajxx.setRequestHeader("Content-type","application/json;charset=UTF8");	
		//	ajxx.setRequestHeader("Connection", "close");
			ajxx.onreadystatechange=function(){
				if(ajxx.readyState!=4 || ajxx.status!=200) return;
				alert(ajxx.responseText);
			}			
			ajxx.send(JSON.stringify(params));
			//alert(evt.target.parentNode.id);
		}
		function inpud(evt){
			document.querySelector("#url").value=evt.target.title;
			var interior=evt.target.parentNode.querySelector(".interior");
			document.querySelector(".sitio").value=interior.querySelector("span.h3").textContent;
			document.querySelector(".direccion").value=interior.querySelector("span.url").textContent;
			document.querySelector(".titulo").value=interior.querySelector("span.h4").textContent;
			document.querySelector(".imagen").value=interior.querySelector("span.img").textContent;
			document.querySelector(".descripcion").value=interior.querySelector("span.descripcion").textContent;
			//document.querySelector(".elid").value=interior.querySelector("span.id").textContent;
		}
		function envio(evt){
			var url=document.querySelector("#url").value;
			var pattern=/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
			if(!url.match(pattern)){
				alert("url inválida");
				return;
			}
			var params={"url":url};
			var ajxx=new XMLHttpRequest();
			ajxx.open("POST","erscrrap.php",true);
			ajxx.setRequestHeader("Content-type","application/json;charset=UTF8");	
			//ajxx.setRequestHeader("Connection", "close");
			ajxx.onreadystatechange=function(){
				if(ajxx.readyState!=4 || ajxx.status!=200) return;
				var div=document.createElement("div");
				var nwUrl=document.createElement("div");
				var litUrl=document.createElement("span");
				var dellete=document.createElement("span");
				var record=document.createElement("span");
				nwUrl.className="nwUrl";
				litUrl.title=url;
				record.className="record";
				record.addEventListener("click",newReg,false);
				dellete.textContent="X";
				dellete.className="dellete";
				dellete.addEventListener("click",borra,false);
				litUrl.addEventListener("click",inpud,false);
				litUrl.innerHTML=url.substr(0,30);
				litUrl.className="litUrl";
				//nwUrl.id="nwUrl-"+Math.floor(Math.random() * (1000 - 1)) + 1;
				nwUrl.appendChild(litUrl);
				nwUrl.appendChild(record);
				nwUrl.appendChild(dellete);
				div.className='nuncio '+url;
				//div.id="a"+nwUrl.id;
				div.innerHTML=ajxx.responseText;
				document.querySelector("#anuncios").appendChild(div);
				var spanUrl=document.createElement("span");
				spanUrl.className="url";

				var spanh3=document.createElement("span");
				spanh3.className="h3";
				var spanh4=document.createElement("span");
				spanh4.className="h4";
				var spanImg=document.createElement("span");
				spanImg.className="img";
				var spanDesc=document.createElement("span");
				spanDesc.className="descripcion";
				var spanId=document.createElement("span");
				spanId.class="id";
				//spanId.textContent="#a"+nwUrl.id;
				var interieur=document.createElement("div");
				interieur.className="interior";
				//alert(div.id);
				var ultimo=document.querySelectorAll(".nuncio");
				ultimo=ultimo[ultimo.length-1];
				spanUrl.id=ultimo.querySelector("a").href;
				spanUrl.textContent=ultimo.querySelector("a").href;
				spanh3.textContent=ultimo.querySelector("h3").textContent;
				spanh4.textContent=ultimo.querySelector("h4").textContent;
				spanImg.textContent=ultimo.querySelector("img").src;
				spanDesc.textContent=ultimo.querySelector("p").textContent;
				//spanId.textContent="#a"+nwUrl.id;
				interieur.appendChild(spanUrl);
				interieur.appendChild(spanh3);
				interieur.appendChild(spanh4);
				interieur.appendChild(spanImg);
				interieur.appendChild(spanDesc);
				//interieur.appendChild(spanId);
				nwUrl.appendChild(interieur);
				document.querySelector(".urls").appendChild(nwUrl);								
				document.querySelector("#url").value="";
			}			
			ajxx.send(JSON.stringify(params));		

		}
		function newReg(evt){
			var padre=evt.target.parentNode.querySelector(".interior");
			//alert(padre.querySelector(".url").textContent);
			var params={"url":padre.querySelector(".url").textContent,"h3":padre.querySelector(".h3").textContent,"h4":padre.querySelector(".h4").textContent,"imagen":padre.querySelector(".img").textContent,"descripcion":padre.querySelector(".descripcion").textContent};
			var ajxx=new XMLHttpRequest();
			ajxx.open("POST","noticias.php",true);
			ajxx.setRequestHeader("Content-type","application/json;charset=UTF8");
			ajxx.onreadystatechange=function(){
				if(ajxx.readyState!=4 || ajxx.status!=200) return;
				alert(ajxx.responseText);
			}			
			ajxx.send(JSON.stringify(params));			
			
		}
</script>
</body>
</html>