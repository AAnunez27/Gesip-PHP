<!DOCTYPE html>
<html>

<head>
	<title>Gesip</title>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--Import materialize.css-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />
	<link type="text/css" rel="stylesheet" href="CSS/estilos.css" />
</head>

<main style="background-color: #d6ffd6;">
	<?php
	session_name('Mantenedor');
	session_start();

	if (isset($_GET['btn_cerrar'])) {
		$_SESSION = array();
		session_destroy();
		echo "<h2>Sesion cerrada correctamente</h2>";
	}

	if (isset($_GET['rut'])) {
		echo "<h2>Debe iniciar sesion</h2>";
	}

	?>

	<div class="row" id="login">
		<div class="col s12 m8 l4 offset-m2 offset-l4">
			<div class="card">
				<div class="card-action grey-text text-darken-3">
					<h3>
						<center>Iniciar Sesión</center>
					</h3>
				</div>
				<div class="card-content">
					<div class="form-field">
						<label for="txt_rut">Nombre de Usuario</label>
						<input type="text" name="txt_rut" id="txt_rut" maxlength="12">
					</div><br>

					<div class="form-field">
						<label for="txt_pas">Contraseña</label>
						<input type="password" name="txt_pas" id="txt_pas" maxlength="8">
					</div><br>

					<div class="form-field">
						<button onclick="iniciar();" class="btn-large waves-effect green darken-2" style="width:100%;" >Iniciar Sesión</button>
					</div><br>
				</div>
			</div>
		</div>
	</div>

	<!-- JS -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script type="text/javascript" src="js/funcionesLogin.js"></script>
	<script type="text/javascript" src="js/funciones.js"></script>


</main>

</html>