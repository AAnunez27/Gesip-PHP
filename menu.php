<?php
require 'Class/DAO.php';
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
  <link rel="icon" href="IMG/G.png">
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--Import materialize.css-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection" />
  <link href="CSS/estilos.css" rel="stylesheet" type="text/css">
</head>
<main>

  <body>
    <!-- Barra superior -->
    <nav>
      <div class="nav-wrapper white" id="barra">
        <a href="menu.php" class="brand-logo"><img src="IMG/Logo.png" alt="logo" id /></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down ">
          <!-- Dropdown 1 -->
          <li><a class="dropdown-trigger grey-text text-darken-3" href="#!" data-target="dropdown1">Usuarios<i class="material-icons right">arrow_drop_down</i></a></li>
          <!--Estructura Dropdown -->
          <ul id="dropdown1" class="dropdown-content">
            <li><a href="Usuarios/registrar_usuarios.php" class="grey-text text-darken-3 modal-trigger">Registrar Usuarios</a></li>
            <li><a href="Usuarios/listar_usuario.php" class="grey-text text-darken-3">Listar Usuarios</a></li>
          </ul>
          <!-- Dropdown 2 -->
          <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown2'>Dispositivos<i class='material-icons right'>arrow_drop_down</i></a></li>
          <!--Estructura Dropdown -->
          <ul id='dropdown2' class='dropdown-content'>
            <li><a href='Dispositivos/agregar_dispositivos.php' class='grey-text text-darken-3'>Agregar
                Dispositivos</a></li>
            <li><a href='Dispositivos/listar_dispositivos.php' class='grey-text text-darken-3'>Listar
                Dispositivos</a></li>
          </ul>
          <!-- Dropdown 3 -->
          <li><a class='dropdown-trigger grey-text text-darken-3' href='#!' data-target='dropdown3'>Asignaciones<i class='material-icons right'>arrow_drop_down</i></a></li>
          <!--Estructura Dropdown -->
          <ul id='dropdown3' class='dropdown-content'>
            <li><a href='Asignaciones/asignar_dispositivos.php' class='grey-text text-darken-3'>Asignar
                Dispositivos</a></li>
            <li><a href='Asignaciones/listar_asignaciones.php' class='grey-text text-darken-3'>Listar
                Asignaciones</a></li>
          </ul>
          <!-- Dropdown 3 -->
          <li><a class="dropdown-trigger grey-text text-darken-3" href="#!" data-target="dropdown4"><i class="material-icons">person</i></a></li>
          <!--Estructura Dropdown -->
          <ul id="dropdown4" class="dropdown-content" type="submit">
            <li><a href='Usuarios/perfil_usuario.php' class='grey-text text-darken-3'>Perfil de Usuario</a></li>
            <li><a href="cerrar.php" class="grey-text text-darken-3">Cerrar Sesión</a></li>
          </ul>

        </ul>
      </div>
    </nav>
    <form method="POST" action="menu.php">
      <?php

      $mensaje = "";
      if (isset($_POST['btn_des'])) {
        if (strlen($mensaje) == 0) {
          $es = new Est_Pag(1, 2);
          $mensaje = $d->CambiarEstadoPagina($es);
        }
        echo "<script>alert('" . $mensaje . "');</script>";
      } //cierre desactivar
      if (isset($_POST['btn_act'])) {
        if (strlen($mensaje) == 0) {
          $es = new Est_Pag(1, 1);
          $mensaje = $d->CambiarEstadoPagina($es);
        }
        echo "<script>alert('" . $mensaje . "');</script>";
      } //cierre desactivar
      ?>
      <div class="container">
        <div class="masonry row">
          <!-- titulo -->
          <div class="col s12">
            <center>
              <h3>Menú</h3>
            </center>
          </div>
          <div class="row">
            <!-- Card -->
            <div class="col s6">
              <div class="card horizontal">
                <div class="card-stacked">
                  <div class="card-content green-text">
                    <h5>
                      <center><i class="tiny material-icons">assignment</i> Usuarios</center>
                    </h5>
                  </div>
                  <div class="card-action">
                    <center>
                      <a href="Usuarios/registrar_usuarios.php" class="green-text">Registrar</a>
                      <a href="Usuarios/listar_usuario.php" class="green-text">Listar</a>
                    </center>
                  </div>
                </div>
              </div>
            </div>
            <div class="col s6">
              <div class="card horizontal">
                <div class="card-stacked">
                  <div class="card-content green-text">
                    <h5>
                      <center><i class="tiny material-icons">devices</i> Dispositivos</center>
                    </h5>
                  </div>
                  <div class="card-action">
                    <center>
                      <a href="Asignaciones/asignar_dispositivos.php" class="green-text">Asignar </a>
                      <a href="Dispositivos/listar_dispositivos.php" class="green-text">Listar </a>
                      <a href="Dispositivos/agregar_dispositivos.php" class="green-text">Agregar</a>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php

          if ($user == "admin") {
            echo "<div class='row'>";
            echo "<div class='col s6 offset-s3'>";
            echo "  <div class='card horizontal'>";
            echo "    <div class='card-stacked'>";
            echo "      <div class='card-content green-text'>";
            echo "        <h5>";
            echo "          <center><i class='tiny material-icons'>build</i> Mantenimiento</center>";
            echo "        </h5>";
            echo "      </div>";
            echo "      <div class='card-action'>";
            echo "        <center><a href='#modal' class='green-text modal-trigger'>Cambiar estado del Sistema</a></center>";
            echo "      </div>";
            echo "      <div id='modal' class='modal '>";
            echo "        <div class='modal-content center'>";
            echo "          <h4>Cambiar estado del Sistema</h4>";
            echo "          <br />";
            echo "          <h6>Esta a punto de cambiar el estado de la pagina</h6>";
            echo "          <br />";
            echo "          <button class='modal-action modal-close btn green darken-1' type='submit' name='btn_act' value='Desactivar'>Activar</button>";
            echo "          <button class='modal-action modal-close btn red darken-1' type='submit' name='btn_des' value='Desactivar'>Desactivar</button>";
            echo "        </div>";
            echo "      </div>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
      <!-- Modal Sorry -->

      </div><!-- Container -->

      <!-- Footer -->
      <footer class="page-footer green darken-2 " style="position:fixed;bottom:0;left:0;width:100%;">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text text-white">Gesip</h5>
              <p class="white-text text-white">Gestión de inventario de dispositivos</p>
            </div>
            <div class="col l4 offset-l2 s12">
              <h5 class="white-text text-white">Contacto</h5>
              <ul>
                <li><i class="tiny material-icons">phone</i><a class="letra navigation" href="tel:900000000"> 900000000</a></li>
                <li><i class="tiny material-icons">email</i><a class="white-text text-white" href="mailto:soporte@gesip.cl" target="_top"> soporte@gesip.cl</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
            © 2022 Copyright
          </div>
        </div>
      </footer>
  </body>
  </form>
</main>

<!-- JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="js/funcionesLogin.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>

</body>

</html>