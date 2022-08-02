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
    <link type="text/css" rel="stylesheet" href="CSS/estilos.css" />
</head>
<main>

    <body>
        <!-- Barra superior -->
        <nav>
            <div class="nav-wrapper white" id="barra">
                <a href="menu.php" class="brand-logo"><img src="IMG/Logo.png" alt="logo" id /></a>

        </nav>
        <br/> <br/> 
        <div class="container">
        <div class="col s12">
            <div class="card-panel">
                <div class="row">
                     <center>
                        <h3 class="grey-text text-darken-3">Lo sentimos <i class=' material-icons'>build</i></h3>
                    </center>
                    <center>
                        <h4 class="grey-text text-darken-3">El sistema se encuentra en mantenimiento</h4>
                    </center>
                    <center>
                        <h4 class="grey-text text-darken-3">vuelva a intentarlo en un momento</h4>
                    </center>
                    <br />
                    <center>
                    <a href="cerrar.php" class="waves-effect waves-light green btn">volver</a>
                    </center>
                    
                </div>
            </div>
        </div>
        </div>
</main>
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