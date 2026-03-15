<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8"/>
	<title>Mailing</title>
	<meta name="description"	content=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- <script defer type="text/javascript" src="basico.js"></script> -->
</head>
<body class='non'>
	<input name='asunto' id='asunto' value='Aragón, no pierdas tu tren!'>
	<textarea name='mensaje' id='mensaje' placeholder='mensaje'>Os esperamos en la estación de ferrocarril de Alagón a las 13:00 el Domingo 18.
Defendamos nuestro tren.</textarea>
	<input name='emails' id='emails' placeholder="emails">
	<button id='enviar'>Enviar</button>
<?php
	$conn = new PDO('mysql:host=localhost; dbname=vertebra', 'myfemmenca', '2959_0469');
	$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$result=$conn->prepare("SELECT email from firmas");
	try{
		$result->execute();
		$resultado=$result -> fetchAll();
	}catch(PDOException $e ){
		echo $e -> getMessage();
	}
	$line="";
	$i=0;
	foreach($resultado as $correos){
		$line.=($correos['email'])?$correos['email'].";":"";
		$i++;
		if($i % 50==0){
			echo '<div class="churro"><button class="fuera">fuera</button>'.$line."</div>";
			$line="";
		}
	}
?>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", initia, false);
function initia(evt){
	document.getElementById("enviar").addEventListener("click",enviar,false);
	var fueras=document.querySelectorAll(".fuera");
	for(i in fueras)
		if(fueras[i].tagName)
			fueras[i].addEventListener("click",function(evt){evt.target.parentNode.remove()},false);
}
function enviar(evt){
	var asunto=document.getElementById("asunto").value;
	var mensaje=document.getElementById("mensaje").value;
	var emails=document.getElementById("emails").value;
	var json={'asunto':asunto,'mensaje':mensaje,'emails':emails};
	fetch('mail.php', {
			method: 'POST',
			body: JSON.stringify(json)
		})
    	.then((res) => {return res.text() })
		.then(function(data){
			alert(data);
	    });		
}	
</script>
</body>
</html>