document.addEventListener("DOMContentLoaded",initia,false);
var goo_skp=false;


function toStart(evt){
  window.scrollTo(0,0);
}
function initia(evt)  {
  var inicio=document.querySelector("div.portada");
  inicio.addEventListener("click",alinicio,false);
  var start=document.querySelector("#start");
  start.addEventListener("click",toStart,false);
  var menu=document.querySelector(".elmenu");
  var menus=document.querySelectorAll(".ulportada li a");
  var cargo=document.querySelectorAll(".cargox input");
  for(i in cargo)
    if(cargo[i].tagName)
      cargo[i].addEventListener("change",camcargo,false);
  for(i in menus){
    if(menus[i].tagName)
      menus[i].addEventListener("click",activar,false);
  }  
  menu.addEventListener("click",despliega,false);  
  var boton=document.querySelector(".enviar");
  if(boton)
    boton.addEventListener("click",envio,false);
  // var idioma=document.querySelector(".idioma");
  // idioma.addEventListener("change",cambio,false);
  // tempo = setInterval("cambia()", 5000);
  // setTimeout("comienza()",10000);  
  // google_scripts();
  var portada=document.querySelector("div.portada");
  portada.addEventListener("click",porta,false);
  //var contactum=document.querySelector(".contactum");
  //contactum.addEventListener("click",contactae,false);
  var recargaR=document.querySelector(".recarga");
  recargaR.addEventListener("click",recarga,false);
  recarga();
  var send=document.querySelector("#send");
  send.addEventListener("click",sendos,false);
  //var close=document.querySelector(".close");
 // close.addEventListener("click",contactae,false);
  window.addEventListener("scroll",verScroll,false);
  var sube=document.querySelector(".sube");
  sube.addEventListener("click",tope,false);
  sube.addEventListener("mouseover",fulla,false);
  sube.addEventListener("mouseout",fori,false);
  if(document.getElementById("svg1")){
    document.getElementById("svg1").addEventListener("load", function() {
        var doc = this.getSVGDocument();
        var rect = doc.querySelectorAll("#riberalta path"); // suppose our image contains a <rect>
        for(i in rect)
          if(rect[i].tagName){
            //rect[i].setAttribute("fill", "green");
            //rect[i].setAttribute("stroke");
            console.log(rect[i].id);
            var pct=document.querySelector("."+rect[i].id+".pct");
            pct=pct.value;
            pct=((pct/100)*2)+0.1;
            var fop="fill-opacity:"+pct;
//            rect[i].style="fill:green;stroke:context-fill;stroke-width:.5;"+fop;
            rect[i].style="fill:green;stroke:context-fill;stroke-width:.5;"+fop;
          }
    });
  }
};

function camcargo(evt){
  document.querySelector(".cargo").value=evt.target.value;
  if(evt.target.value==0)
    document.querySelector("#profesion").placeholder="Profesión";
  else
    document.querySelector("#profesion").placeholder="Cargo (Partido Político)";
}

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
    sube.style.opacity=".7";
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

function porta(evt){
  document.location.href="https://vertebraragon.com/";
}

function alinicio(evt){
  document.querySelector(".ulportada li.inicio a").click();
}
function contactae(evt){
  var pformulario=document.querySelector("p#formulario");
  var abrir=(pformulario.textContent.indexOf("Desplegar")>-1)?true:false;
  var ideas=document.querySelector("#ideas");
  if(abrir){
      ideas.className=ideas.className+" abierto";
      pformulario.textContent=pformulario.textContent.replace("Desplegar","Cerrar");
  }else{
      ideas.className=ideas.className.replace(" abierto","");
      pformulario.textContent=pformulario.textContent.replace("Cerrar","Desplegar");
  }
}
function recarga(evt) {
  var imagen=document.querySelector(".cptz");    
  var respuesta=document.querySelector(".respuesta");
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
      imagen.src="https://vertebraragon.com/sis/captcha.php?"+Date();
  };
  xhr.open('GET', 'https://vertebraragon.com/sis/genera.php', true);
  xhr.send();    
} 
function google_scripts() {
  if (goo_skp) return;
  var scriptG = document.createElement("script");
  scriptG.type = "text/javascript";
  scriptG.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyCj1cxC5cf9kO7KN1t-GuCPW8Mv5xAD54w&callback=initialize";
  document.head.appendChild(scriptG);
  goo_skp = true;
};
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
};
function recoge(evt){
  // evt.preventDefault();
 //  var cierre=document.querySelector(".menu .cierre");
  // cierre.remove();
  var elmenu=document.querySelector(".elmenu");
  elmenu.className="elmenu";
  var portada=document.querySelector(".ulportada");
  portada.className="ulportada";
};
function activar(evt){
  var clase=document.querySelector(".ulportada li a.active");
  clase.className=clase.className.replace("active","");
  evt.target.className="active";
  recoge(evt);
};

function sendos(evt){
  evt.preventDefault();
  var email=document.querySelector(".iemail");
  var titulo=document.querySelector(".ititulo");
  var nomape=document.querySelector(".inombre");
  var comentario=document.querySelector(".iidea");
  var captcha=document.querySelector("#claveReg");
  var seccion=document.querySelector(".seccion");
  var params={'email':email.value,'nombre':nomape.value,'titulo':titulo.value,'comentario':comentario.value,'captcha':captcha.value,'seccion':seccion.value};
  var ajox=new XMLHttpRequest();

  ajox.open("POST","https://vertebraragon.com/sis/comentarios.php",true);
  ajox.setRequestHeader("Content-type","application/json;charset=UTF8");
//  ajox.setRequestHeader("Content-length",params.length);    
  //ajox.setRequestHeader("Connection", "close");
  ajox.onreadystatechange=function(){
    if(ajox.readyState!=4 || ajox.status!=200) return;
      if(ajox.responseText.indexOf("ce el código")>-1 || ajox.responseText.indexOf("código introducido")>-1 || ajox.responseText.indexOf("mal")>-1){
        alert(ajox.responseText);
        return;
      }
      document.querySelector("form.ideas").reset();
      alert(ajox.responseText);
      if(document.querySelector(".contactum"))
        document.location.href="#aki";
  }
  ajox.send(JSON.stringify(params));      
}


// function cambio(e){
//     var inicio={'espanol':"Inicio,Manifiesto,Firma,Asamblea,Apoyan,Comentarios","aragones":"Inicio,Manifesto,Firma,Asamblea,Apoyan,Comentarios","catala":"Inici,Manifest,Signatura,Asamblea,Recolzen,Comentaris"};
//     var langue=e.target.value;
//     var literales=inicio[langue].split(",");
//     var idioma=document.querySelector(".ulportada");
//     idioma.children[0].firstElementChild.innerHTML=literales[0];
//     idioma.children[1].firstElementChild.innerHTML=literales[1];
//     idioma.children[2].firstElementChild.innerHTML=literales[2];
//     idioma.children[3].firstElementChild.innerHTML=literales[3];
//     var xhr = new XMLHttpRequest();
//     xhr.onload = function () {
//         document.querySelector(".manifiest").innerHTML = this.response;
//         document.querySelector("li.manifiesto a").click();
//     };
//     xhr.open('GET', langue+'.html', true);
//     xhr.send();
// };

function envio(e){
	e.preventDefault();
  if(document.querySelector("form.form").checkValidity()==false){
    alert("Error en los datos introducidos, compruébalos");
    return;
  }
  var gracias={'espanol':'Muchas gracias por tu firma.','aragones':'Muchas gracias por tu firma.','catala':'Muchas gracias por tu firma.'};
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
  ajax.open("POST","firma.php",true);
  ajax.setRequestHeader("Content-type","application/json;charset=UTF8");
 // ajax.setRequestHeader("Content-length",parametros.length);    
  //ajax.setRequestHeader("Connection", "close");
  ajax.onreadystatechange=function(){
    if(ajax.readyState!=4 || ajax.status!=200) return;
    if(ajax.responseText.indexOf("Ya has firmado")>-1){
      alert(ajax.responseText);
      return;
    }
    else{
      var num=document.querySelector(".numero");
      num.innerHTML=Number(num.innerHTML)+1;
      document.querySelector(".cuadro").innerHTML=ajax.responseText;
      document.querySelector(".contacto form").reset();
      var contacto=document.querySelector("div.contacto");
      contacto.className=contacto.className+" oculto";
      var grazzie=document.querySelector(".agradecimientos");
      grazzie.className="agradecimientos";
      document.querySelector(".agradecimientos h2").innerHTML=gracias[document.querySelector("select.idioma").value];
      document.querySelector("li.firma a").click();
    }
  }
  ajax.send(JSON.stringify(parametros));    
}
function comienza(){
  var imgLoaded = document.getElementsByTagName( 'figure' ).length;
  var imgTotal = document.getElementById( 'figurinas' );
  if( imgTotal.length  != 0){
      for( i = 3; i < imgTotal.length; i++ ){
          var image = imgTotal.options[i];
          var imageId = image.getAttribute("data-id");
          var imageSrc = image.textContent;
          var imageTitle = image.getAttribute("data-alt");
          var imageUrl =  image.getAttribute("data-url");
          document.getElementById('images').appendChild( newFigure( imageId, imageSrc, imageTitle, imageUrl ) );   
      }
  }
}

function newFigure( imageId, imageSrc, imageTitle, imageUrl ){
  var figure = document.createElement("figure");
  figure.className = 'imagenes';
  var figcaption = document.createElement("figcaption");
  figcaption.textContent=imageTitle;
  var a = document.createElement("a");
  a.setAttribute("href",imageSrc.replace("slides","normal"));
  a.setAttribute("target","_blank");
  var imagen=document.createElement("img");
  imagen.setAttribute("id",imageId);
  imagen.setAttribute("title",imageTitle);
  imagen.setAttribute("src",imageSrc);
  a.appendChild(imagen);
  figure.appendChild(a);
  figure.appendChild(figcaption);
  /*figure.innerHTML = '<img id="' + imageId + '" alt="' + imageTitle + '" src="' + imageSrc + '" /><figcaption><a class="enlaceSpan" href="' + imageUrl +  '">' + imageTitle + '<span class="willy willy-mano"></span></a></figcaption>';
  node.appendChild(figure);*/
return figure;
}

function cambia(){
  var imgFigures = document.getElementsByTagName( 'figure' );
  for( i = 0; i < imgFigures.length; i++ ){
      if( imgFigures[i].classList.contains( 'actiu' ) ){
          imgFigures[i].classList.remove( 'actiu' );
          j = ( i != imgFigures.length-1 ) ? i+1 : 0;
          imgFigures[j].classList.add( 'actiu' );
          i = imgFigures.length;
      }
  }
}