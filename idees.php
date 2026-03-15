<?php
@session_start();
?>
<form id='ideas' class='ideas'>
	<div class="atencion">
		<span class='lit'>Cuéntanos qué te parecen las primarias!</span>
		<span class='close'>x Cerrar</span>
	</div>
	<div class='inputs'>
		<input class='inombre' name='inombre' placeholder='nombre' pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="inombre" placeholder="Nombre">
		<input class='iemail' name='iemail' pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="Email" type="email">
		<input class='ititulo' name='ititulo' pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ,.)]{2,100}$" placeholder='Titulo'/>
		<textarea class='iidea' name='iidea' placeholder='comentario'></textarea>
	</div>

	<select name='seccion' class='seccion'>
		<option value='mel'>Correo</option>
		<option value='com'>Comentario</option>
	</select>
	<?php
		@include("sis/genera.php");
	?>					
	<div class="kptz">
		<div class='ktpzIm'>
			<label class="intrucod">Introducir Código Imágen para enviar.</label>
			<img alt="captcha" title="Ingrese este código" src="https://vertebraragon.com/sis/captcha.php" class="cptz" />
		</div>
		<div class="delcaptcha">
			<div>
				<input type="button"  value="recargar" class="recarga"/>
				<input type="text" maxlength='10' class="inserta" autocomplete="off" style="width:100px" id="claveReg" name="claveReg" required/>
			</div>
			<span></span>
		</div>
		<div class="respuesta"></div>
	</div>
	<input type="submit" id="send" value="Enviar">
</form>