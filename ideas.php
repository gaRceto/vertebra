<?php
@session_start();
?>
<form id='ideas' class='ideas'>
	<div class='intd'>
		<div class='losinputs'>
			<input class='inombre' name='inombre' placeholder='nombre' pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ)]{3,50}$" id="inombre" placeholder="Nombre y Apellidos">
			<input class='iemail' name='iemail' pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$" placeholder="email" type="email">
			<input class='ititulo' name='ititulo' pattern="^[(A-Za-z  áéíóúàèìòùÀÈÌÒÙÁÉÍÓÚÑñ,.)]{2,100}$" placeholder='asunto'/>
		</div>
		<div class='eltextarea'>
			<textarea class='iidea' name='iidea' placeholder='mensaje'></textarea>
		</div>
	</div>
	<label class='center'>Correo o Comentario, elegir</label>
	<select name='seccion' class='seccion'>
		<option class='mel' value='mel'>Correo</option>
		<option class='com' value='com'>Comentario</option>
	</select>
	<?php
		@include("sis/genera.php");
	?>
	<div class='parte'>
		<div class="kptz">
			<label class="intrucod">Introducir Código Imágen para enviar.</label>
			<img alt="captcha" title="Ingrese este código" src="https://vertebraragon.com/sis/captcha.php" class="cptz" />
			<div class="delcaptcha">
				<div>
					<input type="button"  value="recargar" class="recarga"/>
					<input type="text" maxlength='10' class="inserta" autocomplete="off" style="width:100px" id="claveReg" name="claveReg" required/>
				</div>
				<span></span>
			</div>
			<div class="respuesta"></div>
		</div>
		<div class='envio'>
			<input type="submit" id="send" value="Enviar">
		</div>
	</div>
</form>