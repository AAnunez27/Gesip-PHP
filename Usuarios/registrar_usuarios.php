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
    
    <form method="POST" action="registrar_usuarios.php">
        <div class="container">

            <?php
            $mensaje = "";
            if (isset($_POST['btn_env'])) {
                $rut = trim($_POST['rut']);
                if (strlen($rut) > 12 || strlen($rut) == 0) {
                    $mensaje = $mensaje . '- Ingrese rut valido \n';
                }

                $dir = trim($_POST['dir']);
                if (strlen($dir) > 30 || strlen($dir) == 0) {
                    $mensaje = $mensaje . '- Ingrese dirección valido \n';
                }

                $nom = trim($_POST['nom']);
                if (strlen($nom) > 30 || strlen($nom) == 0) {
                    $mensaje = $mensaje . '- Ingrese nombre valido \n';
                }

                $apep = trim($_POST['apep']);
                if (strlen($apep) > 30 || strlen($apep) == 0) {
                    $mensaje = $mensaje . '- Ingrese Apellido Paterno valido \n';
                }
                $apem = trim($_POST['apem']);
                if (strlen($apem) > 30 || strlen($apem) == 0) {
                    $mensaje = $mensaje . '- Ingrese Apellido Materno valido \n';
                }
                $fecnac = trim($_POST['fecnac']);
                if (strlen($fecnac) == 0) {
                    $mensaje = $mensaje . '- Ingrese Fecha de Nacimiento valida \n';
                }

                $idgen = trim($_POST['idgen']);
                if (!is_numeric($idgen)) {
                    $mensaje = $mensaje . '- Seleccione Genero \n';
                }
                $idrol = trim($_POST['idrol']);
                if (!is_numeric($idrol)) {
                    $mensaje = $mensaje . '- Seleccione Rol \n';
                }

                if (strlen($mensaje) == 0) {
                    $u = new Usuario("", $nom, $apep, $apem, $rut, "", $dir, $fecnac, $idgen, 1,$idrol);
                    $mensaje = $d->AgregarUsuario($u);
                }
                echo "<script>alert('" . $mensaje . "');</script>";
            } //cierre registrar
            ?>

            <card>
                <div class="col s12">
                    <center>
                        <h4 class="grey-text text-darken-3">Registrar Usuarios</h4>
                    </center>
                </div>
                <div class="row">
                    <div class="row col s12">
                        <div class="input-field col s3">
                            <input id="rut" type="text" class="validate" name="rut" autofocus>
                            <label for="rut">Rut</label>
                        </div>
                        <div class="col s1"></div>
                        <div class="input-field col s8">
                            <input id="dir" type="text" class="validate" name="dir">
                            <label for="dir">Dirección</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="nom" type="text" class="validate" name="nom">
                            <label for="nom">Nombre</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="apep" type="text" class="validate" name="apep">
                            <label for="apep">Apellido Paterno</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="apem" type="text" class="validate" name="apem">
                            <label for="apem">Apellido Materno</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <select id="idgen" name="idgen">
                                <option value="0" disabled selected>Género</option>
                                <?php
                                $lista = $d->lisgen();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $g = $lista[$i];
                                    $idg = $g->getid_gen();
                                    $nomg = $g->getnom_gen();
                                    echo "<option value='$idg'>$nomg</option>";
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Género</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="fecnac" type="text" class="datepicker" name="fecnac">
                            <label for="fecnac">Fecha de Nacimiento</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="idrol" name="idrol">
                                <option value="0" disabled selected>Rol</option>
                                <?php
                                $lista = $d->lisRol();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $r = $lista[$i];
                                    $idr = $r->getid_rol();
                                    $nomr = $r->getnom_rol();
                                    echo "<option value='$idr'>$nomr</option>";
                                }

                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Rol</label>
                        </div>
                    </div>
                    <div class="col s4 offset-s10">
                        <span class="flow-text">
                            <button class="waves-effect waves-light green btn" type="submit" name="btn_env" value="Registrar"><i class="material-icons right">save</i>Registrar</button>
                        </span>
                    </div>
                </div>
            </card>
        </div><!-- Fin Container -->
    </form>
</main>
<!-- Footer -->
<?php include '../footer.php' ?>
    <!-- JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>

</html>