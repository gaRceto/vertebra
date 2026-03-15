		var direccion;
		var iconomapa,pos,icono,map;
		function initialize() {
			direccion=document.querySelector("#direccion").textContent;
			pos = new google.maps.LatLng(41.6318383, -0.8949107);
			
			if(window.innerWidth>880){
				var myOptions = {
					zoom: 16,
					center: pos,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
			}else{
				var myOptions = {
					zoom: 16,
					scrollwheel: false,
					center: pos,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					zoomControl: false,
					streetViewControl: false,
					mapTypeControl: false
				};
			}
			map = new google.maps.Map(document.getElementById("mapa"),myOptions);

			geocoder = new google.maps.Geocoder();
			geocoder.geocode({'address':direccion},mostrar_direccion);
			// alert(geocer.lat());
			// map.setZoom(6);
		}
		
		function setMarcador(punto,icono,texto){
			iconomap=getmarca(punto,icono,texto);
			iconomap.setMap(map);
			// centrar en punto
			map.setCenter(punto);
			return iconomap;
		}
		
		// Devuelve el marcador
		function getmarca(punto,icono,texto){
			return new google.maps.Marker({
				position:punto,
				title:texto,
				icon:icono
				});
		}

		
	  function mostrar_direccion(results,status){
			if(status==google.maps.GeocoderStatus.OK){
				var pos=results[0].geometry.location;
				icono="http://abrirpodemosaragon.es/img/abrirmap.png";
				iconomapa=setMarcador(pos,icono,"#AbrirPodemosAragón");
			}
		
		}