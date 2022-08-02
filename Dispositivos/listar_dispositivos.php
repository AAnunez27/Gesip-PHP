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
					<h4 class="grey-text text-darken-3">Listado de Dispositivos</h4>
				</center>
			</div>
			<div class="row">

				<table class="responsive-table centered">
					
					<thead>
						<tr>
							<th>Nombre Dispositivo</th>
							<th>Codigo de inventario</th>
							<th>Almacenamiento</th>
							<th>Serial</th>
							<th>Modelo</th>
							<th>Marca</th>
                            <th>Tipo</th>
                            <th>Procesador</th>
                            <th>Sistema</th>
                            <th>Modificar</th>
							<th>Eliminar</th>
						</tr>
					</thead>

					<tbody>
						<?php
						require '../Class/Dispositivo.php';
						$mensaje = "";

						if (isset($_GET['id_eli'])) {
							$id = trim($_GET['id_eli']);
							if (strlen($id) == 0) {
								$mensaje = $mensaje . " - ID no valido ";
							} else {
								$mensaje = $d->EliminarDispositivo($id);
							}
							echo "<script>alert('" . $mensaje . "');</script>";
						} //cierre eliminar

						$lista = $d->ListarDispositivos();
						for ($i = 0; $i < count($lista); $i++) {
							$di = $lista[$i];
							$lista = $d->ListarDispositivos();
							echo "<tr>";
							echo"<td>". $di->getnom_dis() ."</td>";
							echo"<td>". $di->getcod_dis() ."</td>";
							echo"<td>". $di->getalm_dis() ."</td>";
							echo"<td>". $di->getser_dis() ."</td>";
							echo"<td>". $di->getmod_dis() ."</td>";
                            echo"<td>". $d->busnomar($di->getid_mar()) ."</td>";
                            echo"<td>". $d->busnomtip($di->getid_tip()) ."</td>";
                            echo"<td>". $d->busnompro($di->getid_pro()) ."</td>";
                            echo"<td>". $d->busnomso($di->getId_So() )."</td>";
							echo "<td><a class='waves-effect waves-light btn-small green 'href='modificar_dispositivos.php?id=". $di->getid_dis() ."'>Modificar</a></td>";
							echo "<td><a class='waves-effect waves-light btn-small green 'href='listar_dispositivos.php?id_eli=". $di->getid_dis() ."'>Eliminar</a></td>";
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