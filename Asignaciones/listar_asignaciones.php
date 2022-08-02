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
					<h4 class="grey-text text-darken-3">Listado de Asignaciones</h4>
				</center>
			</div>
			<div class="row">

				<table class="responsive-table centered">
				
					<thead>
						<tr>
							<th>Dispositivo Asignado</th>
							<th>Usuario a Cargo</th>
							<th>Ubicación</th>
							<th>Fecha de Entrega</th>
							<th>Fecha de Devolución</th>
							<th>Estado</th>
                            <!--<th>Modificar</th>
							<th>Eliminar</th>-->
						</tr>
					</thead>

					<tbody>
						<?php
						$mensaje = "";
						$lista = $d->ListarAsignaciones();
						for ($i = 0; $i < count($lista); $i++) {
							$as = $lista[$i];
							$lista = $d->ListarAsignaciones();
							echo "<tr>";
							echo"<td>". $as->getid_dis() ."</td>";
							echo"<td>". $as->getid_usu() ."</td>";
							echo"<td>". $as->getid_ubi() ."</td>";
							echo"<td>". $as->getfece_asi() ."</td>";
							echo"<td>". $as->getfecd_asi() ."</td>";							
							echo"<td>". $as->getid_est() ."</td>";
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