<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-">
	<title>Slider</title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="nav.css">
	<style type="text/css">
	h3{
		text-align:center;
	}
	.container {
	    display: flex;
	    flex-flow: column;
	}
	.lossliders > div {
	    display: flex;
	}	
	
	.lossliders div span {
	    align-self: center;
	    background-color: #eee;
	    border: 1px solid;
	    display: block;
	    margin: 0.4em;
	    width: 122px;
	}

	.lossliders button {
	    background-color: #c01f39;
	    color: white;
	    cursor: pointer;
	    font-size: 1.2em;
	    font-weight: bold;
	    margin: 0.4em 1em;
  		-webkit-transition: all 0.5s ease-in-out 0s;
	  	transition: all 0.5s ease-in-out 0s;		
	    width: 110px;
	}

	.lossliders button:hover {
	    background-color: #888;
	    color: #000;
	}
	.nombre{
		text-align: center;
	}
	.nombre span.nom,.nombre span.delete {
	    background-color: #fff;
	    border: 1px solid black;
	    padding: 7px 14px;
	}
	.nombre span.delete:hover{
		border: 1px solid red;
		color:red
	}
	.videos {
	    background-color: #ddd;
	    border: 1px solid;
	    flex-basis: 20%;
	    padding: 2em;
	    display:flex;
	    justify-content:space-around;
	}
	.lossliders{
		flex-basis: 40%;
	}
	.slides {
	    display: flex;
	    flex-basis: 40%;
	    flex-flow: column;
	    position: relative;
	}
	.slides figure{
		position: absolute;
		opacity:0;
	}
	.slides figure.active{
		opacity:1;
	}
	.slides figure img{
		max-width: 100%;
	}
	.figuras {
	    flex-basis: 25%;
	}
	.botonacos {
	    flex-basis: 2%;
	    text-align: center;
	}

	figcaption {
	    color: white;
	    font-size: 1.2em;
	    left: 28%;
	    position: absolute;
	    text-shadow: 1px 1px 1px red;
	    top: 34%;
	    max-width: 250px;
	}	
	</style>
</head>
<body>
	<div id="main">

		<section>
			<div class="container">
                <?php $images = scandir( '../images/slides' ); unset( $images[0], $images[1] ); ?>
                <input type="hidden" id="imagesSlider" name="imagesSlider" value="<?php echo join( ",", $images ); ?>" />
				<h3>Slider</h3>
				<div class="botones">
					<button class="importar">Importar</button>
					<button class="guardar">Guardar</button>
				</div>
				<div class="videos">
					<div class="lossliders"></div>
					<div class="slides">
						<div class="nombre"><span class="nom"></span><span class='delete'>X</span></div>
						<div class="figuras"></div>
						<div class="botonacos"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script type="text/javascript">
		window.addEventListener("load",initia,false);
		var documento;
		var borrado=false;
		function importar(){
			var imgs = document.getElementById( 'imagesSlider' ).value.split( ',' );
			var del=document.querySelector(".delete");
			del.addEventListener("click",borraImg,false);
            document.querySelector(".lossliders").innerHTML="";
            document.querySelector(".figuras").innerHTML="";
            document.querySelector(".botonacos").innerHTML="";
			var params={'fecha':Date()};
			var xml=new XMLHttpRequest();
			xml.open("GET","../slider.json",true);
			xml.setRequestHeader("Content-type","text/xml;charset=UTF8");
			xml.setRequestHeader("Content-length", params.length);
			xml.setRequestHeader("Connection","close");
			xml.onreadystatechange=function(){
			if(xml.readyState!=4 || xml.status!=200) return;
				documento=JSON.parse(xml.responseText);
                for( i = 0; i < documento['slider'].length; i++ ){
                    imgs.splice( imgs.indexOf( documento['slider'][i].img ), 1 );
                    newLine(documento['slider'][i].img, documento['slider'][i].url, documento['slider'][i].title, 0 );
                }
                for( i = 0; i < imgs.length; i++ ){
                    newLine( imgs[i], '', '', 0 );
                }
				var boton=document.createElement("button");
				boton.className="anade";
				boton.innerHTML="+";
				boton.addEventListener("click",anade,false);
				document.querySelector(".lossliders").appendChild(boton);
				 // console.log(documento['videos'][top].video[a]);
				 var diapos=document.querySelector(".slides .figuras");
				 var botonacos=document.querySelector(".slides .botonacos");
				 imgs = document.getElementById( 'imagesSlider' ).value.split( ',' );
				 var losfigcaption=document.querySelectorAll(".lossliders div span:nth-child(3)");
				 var traeimagen=document.querySelectorAll(".lossliders div span");
				 for(i in traeimagen)
				 	if(traeimagen[i].tagName)
				 		traeimagen[i].addEventListener("click",traela,false);
				 for(i in imgs){
				 	var imagen=document.createElement("img");
			 		var figure=document.createElement("figure");
			 		figure.className=imgs[i].substr(0,imgs[i].lastIndexOf("."));
				 	if(i==0)
				 		figure.className+=" active";
				 	var figcaption=document.createElement("figcaption");
				 	imagen.src="../images/slides/"+imgs[i];				 	
				 	figure.appendChild(imagen);
				 	figcaption.textContent=losfigcaption[i].textContent;
				 	figure.appendChild(figcaption);
				 	diapos.appendChild(figure);
				 }
				 var boton=document.createElement("button");
				 var botonA=document.createElement("button");
				 boton.textContent="siguiente";
				 botonA.textContent="anterior";
				 botonA.addEventListener("click",siguiente,false);
				 boton.addEventListener("click",siguiente,false);
				 botonacos.appendChild(botonA);
				 botonacos.appendChild(boton);
				 document.querySelector(".nombre span.nom").innerHTML=imgs[0];
/*				 var up=document.querySelector(".slides");
				 var span=document.createElement("span");
				 span.textcontent="Nombre";
				 up.appendChild("span");
				 */
			}
			xml.send(params);
		}

		function traela(evt){
			var t=document.querySelectorAll("figure");
			var num=hijoH4(evt.target.parentNode);
			var actif=document.querySelector("figure.active");
			actif.className=actif.className.replace(" active","");
			/*alert(actif.querySelector("img").src);*/
/*			actif.removeAttribute("class");*/
			t[num].className+=" active";
			var nomtif=t[num].querySelector("img").src;
			nomtif=nomtif.substr(nomtif.lastIndexOf("/")+1);
			document.querySelector(".nombre .nom").textContent=nomtif;
		}

		function siguiente(evt){
			var t=document.querySelectorAll("figure");
			var actif=document.querySelector("figure.active");
			var nombre=document.querySelector(".nombre span.nom");
			var num=hijoH4(actif);
			actif.className=actif.className.replace(" active","");
			var anterior=evt.target.textContent=="anterior";
			if(!anterior)
				num=(num<t.length-1)?num+1:0;
			else
				num=(num>0)?num-1:t.length-1;
			t[num].className+=" active";
			var nome=t[num].querySelector("img").src;
			nome=nome.substr(nome.lastIndexOf("/")+1);
			nombre.textContent=nome;
		}

		// function diapositivas()

		function anade(evt){
			newLine( '', '', '', 1 );
		}

		function borraImg(evt){
			if(!confirm("Estás seguro de borrar la foto?"))
				return;
			borrado=true;
			var cual=evt.target.previousElementSibling.textContent;
			cual=cual.substr(0,cual.lastIndexOf("."));
			var antes=document.querySelector("#"+cual);
			document.querySelector(".botonacos").firstChild.click();
			document.querySelector("."+cual).remove();
			document.querySelector("#"+cual).click();

		}
		function borra(evt){
			if(borrado==false){
				if(!confirm("Estás seguro de borrar la foto?"))
					return;				
				var elnom=evt.target.parentNode.firstChild.textContent;
				elnomc=elnom.substr(0,elnom.lastIndexOf("."));
				if(elnom==document.querySelector(".nombre .nom").textContent){
					document.querySelector(".delete").click();
				}else{
					document.querySelector("figure."+elnomc).remove();
				}
			}
			evt.target.parentNode.remove();
			borrado=false;
		}
		function initia(){
			document.querySelector("button.guardar").addEventListener("click",guardar,false);
			document.querySelector("button.importar").addEventListener("click",importar,false);
		}
		function queteclaes(evt){
			var ev = (evt) ? evt : event;
			try{
				var tecla=(ev.which) ? ev.which:event.keyCode;
			}catch(e){
				return;
			}
			if(tecla==13)
				evt.preventDefault();
			if(evt.target.className=="titulon"){
				var num=hijoH4(evt.target.parentNode);
				var fc=document.querySelectorAll("figcaption");
				fc[num].textContent=evt.target.textContent;
			}

		}
        function newLine( img, url, title, last ){
            var div=document.createElement("div");
			var spanImg=document.createElement("span");
			var spanUrl=document.createElement("span");
			var spanTitle=document.createElement("span");
            var boton=document.createElement("button");
			boton.innerHTML="-";
			boton.id=img.substr(0,img.lastIndexOf("."));
            spanImg.contentEditable=true;
			spanImg.addEventListener("keyup",queteclaes,false);
			spanImg.textContent=img;
			spanUrl.contentEditable=true;
			spanUrl.addEventListener("keyup",queteclaes,false);
			spanUrl.textContent=url;
			spanTitle.contentEditable=true;
			spanTitle.className="titulon";
			spanTitle.addEventListener("keyup",queteclaes,false);
			spanTitle.textContent=title;
            div.appendChild(spanImg);
			div.appendChild(spanUrl);
            div.appendChild(spanTitle);
			div.appendChild(boton);
            boton.addEventListener("click",borra,false);
			if( last == 1 ){
		      document.querySelector(".lossliders").insertBefore(div,document.querySelector(".lossliders").lastChild);
			} else {
		      document.querySelector(".lossliders").appendChild(div);
			}
        }
        
		function guardar(evt){
            var lines=document.querySelectorAll(".lossliders div span");
            var obj = '';
            for( i = 0; i < lines.length; i++ ){
                obj = ( obj != '' ) ? obj + ',' : '';
                obj = obj + '{"img":"' + lines[i].textContent + '","url":"' + lines[i+1].textContent + '","title":"' + lines[i+2].textContent + '"}';
                i++;
                i++;
            }
            var json = '{"slider":['+obj+']}';
            if(!confirm("Estás a punto de sobreescribir las imágenes, ¿Deseas Continuar?"))return;
			var r = new XMLHttpRequest();
			r.open("POST","guardarjsonslider.php", true);
			r.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
			r.setRequestHeader("Content-length", documento.length);
			r.setRequestHeader("Connection", "close");	
			r.onreadystatechange = function () {
				if (r.readyState != 4 || r.status != 200) return;
				alert(r.responseText);
			};
			r.send(json);
		}		
		function hijoH4(a) {
		    var t;
		    var b = Array.prototype.slice.call(a.parentNode.children);
		    t = (b.indexOf(a));
		    return t;
		}		
	</script>
</body>
</html>