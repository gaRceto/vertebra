<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
	<title>Noticias Relacionadas</title>
	<link rel="stylesheet" type="text/css" href="../css/noticias.css">
	<link rel="stylesheet" type="text/css" href="../css/estilo.css">
	<link href="https://fonts.googleapis.com/css?family=Abel|Kaushan+Script" rel="stylesheet">	<link rel="icon" sizes="64x64" href="https://vertebraragon.com/img/trenlogo.png">
	<script src="../js/custom.js"></script></head>
<body>
<?php include("../menu2.php"); ?>
	<div class="padprov">
		<h2 class="notRel">Noticias relacionadas</h2>
	</div>
	<div id="noticias">
<?php
	include("../boss/carganot.php");
	echo $linea;
?>
	</div>
	<div class="replicas">
		<a href='https://vertebraragon.com/comentarios'><h2 class='notRel underl'>Comentarios y réplicas</h2></a>
	</div>
	<div class="sube"></div>
		<footer>
			<div class="footer-two" id="footer-two">
			<?php include("../ideas.php");?>
			</div>
			<div class="footer-one">
				<p>©vertebrAragón</p>
			</div>
		</footer>	
</body>
</html>