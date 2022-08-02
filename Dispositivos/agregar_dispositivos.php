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

        <form method="POST" action="agregar_dispositivos.php">
            <div class="container">

                <?php
                require '../Class/Dispositivo.php';
                $mensaje = "";
                $nom = "";
                $ser = "";
                $cod = "";
                $alm = "";
                $obs = "";
                $idtip = 0;
                $idmar = 0;
                $idso = 0;
                $idpro = 0;
                $mod = "";

                if (isset($_POST['btn_env'])) {
                    $nom = trim($_POST['nom_dis']);
                    if (strlen($nom) > 20 || strlen($nom) == 0) {
                        $mensaje = $mensaje . '- Ingrese nombre valido \n';
                    }
                    $cod = trim($_POST['cod_inv']);
                    if (strlen($cod) > 20 || strlen($cod) == 0) {
                        $mensaje = $mensaje . '- Ingrese codigo valido \n';
                    }
                    $alm = trim($_POST['alm_dis']);
                    if (strlen($alm) > 20 || strlen($alm) == 0) {
                        $mensaje = $mensaje . '- Ingrese almacenamiento valido \n';
                    }
                    $ser = trim($_POST['ser_dis']);
                    if (strlen($ser) > 20 || strlen($ser) == 0) {
                        $mensaje = $mensaje . '- Ingrese serie valido \n';
                    }
                    $mod = trim($_POST['mod_dis']);
                    if (strlen($mod) > 20 || strlen($mod) == 0) {
                        $mensaje = $mensaje . '- Ingrese modelo valido \n';
                    }
                    $obs = trim($_POST['obs_dis']);

                    $idmar = trim($_POST['id_mar']);
                    if (!is_numeric($idmar)) {
                        $mensaje = $mensaje . '- Seleccione Marca \n';
                    }
                    $idtip = trim($_POST['id_tip']);
                    if (!is_numeric($idtip)) {
                        $mensaje = $mensaje . '- Seleccione Tipo \n';
                    }
                    $idpro = trim($_POST['id_pro']);
                    if (!is_numeric($idpro)) {
                        $mensaje = $mensaje . '- Seleccione Procesador \n';
                    }
                    $idso = trim($_POST['id_so']);
                    if (!is_numeric($idso)) {
                        $mensaje = $mensaje . '- Seleccione Sistema Operativo \n';
                    }


                    if (strlen($mensaje) == 0) {
                        $di = new Dispositivo("", $nom, $ser, $cod, $alm, $obs, $idtip, $idmar, $idso, $idpro, $mod, 1);
                        $mensaje = $d->AgregarDispositivos($di);
                    }
                    echo "<script>alert('" . $mensaje . "');</script>";
                }
                ?>
                <card>
                    <!-- titulo -->
                    <div class="col s12">
                        <center>
                            <h4 class="grey-text text-darken-3">Agregar Dispositivos</h4>
                        </center>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="nom_dis" name="nom_dis" type="text" class="validate">
                            <label for="nom_dis">Nombre</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="cod_inv" name="cod_inv" type="text" class="validate">
                            <label for="cod_inv">Codigo de Inventario</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="alm_dis" name="alm_dis" type="text" class="validate">
                            <label for="alm_dis">Almacenamiento</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="ser_dis" name="ser_dis" type="text" class="validate">
                            <label for="ser_dis">Serie de dispositivos</label>

                        </div>
                        <div class="input-field col s4">
                            <input id="mod_dis" name="mod_dis" type="text" class="validate">
                            <label for="mod_dis">Modelo de dispositivo</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="id_mar" name="id_mar">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                $lista = $d->lisMar();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $m = $lista[$i];
                                    $idm = $m->getid_mar();
                                    $nomm = $m->getnom_mar();
                                    echo "<option value='$idm'>$nomm</option>";
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Marca</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <select id="id_tip" name="id_tip">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                $lista = $d->lisTip();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $lt = $lista[$i];
                                    $idt = $lt->getid_tip();
                                    $nomt = $lt->getnom_tip();

                                    echo "<option value='$idt'>$nomt</option>";
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Tipo de dispositivo</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="id_pro" name="id_pro">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                $lista = $d->lisPro();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $lp = $lista[$i];
                                    $idp = $lp->getid_pro();
                                    $nomp = $lp->getnom_pro();

                                    echo "<option value='$idp'>$nomp</option>";
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Procesador</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="id_so" name="id_so">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <?php
                                $lista = $d->lisSo();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $ls = $lista[$i];
                                    $ids = $ls->getid_so();
                                    $noms = $ls->getnom_so();

                                    echo "<option value='$ids'>$noms</option>";
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Sistema Operativo</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s8">
                            <textarea id="obs_dis" name="obs_dis" class="materialize-textarea"></textarea>
                            <label for="obs_dis">Observaciones</label>
                        </div>
                        <div class="col s2">
                            <span class="flow-text">
                                <a class="waves-effect waves-light green btn"><i class="material-icons right">cached</i>limpiar</a>
                            </span>
                        </div>
                        <div class="col s2">
                            <span class="flow-text">
                                <button class="waves-effect waves-light green btn" type="submit" name="btn_env" value="Registrar"><i class="material-icons right">save</i>Guardar</button> </span>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
</script>
<script type="text/javascript" src="../js/funciones.js"></script>
</body>

</html>