<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Metas -->
	<?php  require 'layout/structure/metas.php' ?>

	<!-- Styles -->
	<?php  require 'layout/structure/styles.php' ?>

	<!-- Scripts -->
	<?php  require 'layout/structure/scripts.php' ?>

	<!-- Tomamos el título del archivo main.conf.json -->
	<title><?= $settings['main_conf']['title'] ?></title>
</head>
<body>
	<input type="text" placeholder="usuario" id="user_input">
	<input type="password" placeholder="contraseña" id="password_input">
	<button onclick="login($('#user_input').val(), $('#password_input').val());">Iniciar sesión</button>
	<button onclick="createUser($('#user_input').val(), $('#password_input').val());">Crear cuenta</button>
	<br><br>
	<textarea id="chat_area" cols="45" rows="10" readonly onload="rawMessages();"></textarea>
	<input type="text" placeholder="pon algo sencillo" id="chat_input">
	<button onclick="chat();" id="chat_btn">Chatear</button>
	
</body>
</html>