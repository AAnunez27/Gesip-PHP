<?php
 require '../Class/DAO.php';
$d = new DAO();

session_name('Mantenedor');
session_start();

$est = $d->BuscarEstadoPagina();
$user = $_SESSION['rut'];

if (isset($_SESSION['rut']) == false) {
  header("Location: index.php?usuario");
}
if ($user != "admin" && $est == 2) {
  header("Location: mantenimiento.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Gesip</title>
	<link rel="icon" href="../IMG/G.png">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!--Import materialize.css-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />
	<link type="text/css" rel="stylesheet" href="../CSS/estilos.css" />
</head>
<main>
<body>
	<!-- Barra superior -->
	<?php include '../nav.php' ?>
	
	<div class="container">
		<card>
			<!-- titulo -->
			<div class="col s12">
				<center>
					<h4 class="grey-text text-darken-3">Listar Usuarios</h4>
				</center>
			</div>
			<div class="row">

				<table class="responsive-table centered">
					
					<thead>
						<tr>
							<th>Rut</th>
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Fecha de nacimiento</th>
							<th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$mensaje = "";

						if (isset($_GET['rut_eli'])) {
							$rut = trim($_GET['rut_eli']);
							if (strlen($rut) > 12 || strlen($rut) == 0) {
								$mensaje = $mensaje . " - Rut no valido ";
							} else {
								$mensaje = $d->EliminarUsuario($rut);
							}
							echo "<script>alert('" . $mensaje . "');</script>";
						} //cierre eliminar

						$lista = $d->ListarUsuario();
						for ($i = 0; $i < count($lista); $i++) {
							$u = $lista[$i];
							echo "<tr>";
							echo "<td>" . $u->getrut_usu() . "</td>";
							echo "<td>" . $u->getnom_usu() . "</td>";
							echo "<td>" . $u->getapep_usu() . "</td>";
							echo "<td>" . $u->getapem_usu() . "</td>";
							echo "<td>" . $u->getfec_usu() . "</td>";
							echo "<td><a class='waves-effect waves-light btn-small green 'href='modificar_usuario.php?rut=" . $u->getrut_usu() . "'>Modificar</a></td>";
							echo "<td><a class='waves-effect waves-light btn-small green 'href='listar_usuario.php?rut_eli=" . $u->getrut_usu() . "'>Eliminar</a></td>";
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</card>

	</div><!-- Fin Container -->
	</main>

	<!-- Footer -->
    <?php include '../footer.php' ?>
	
	<!-- JS -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script type="text/javascript" src="../js/funcionesLogin.js"></script>
	<script type="text/javascript" src="../js/funciones.js"></script>

</body>

</html>