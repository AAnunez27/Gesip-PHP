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

        <form method="POST" action="modificar_dispositivos.php">
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
                    $id = trim($_POST['id_dis']);

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

                    $obs = trim($_POST['obs_dis']);

                    if (strlen($mensaje) == 0) {
                        $di = new Dispositivo($id, $nom, $ser, $cod, $alm, $obs, $idtip, $idmar, $idso, $idpro, $mod, 1);
                        $mensaje = $d->ModificarDispositivo($di);
                        echo "<script>alert('" . $mensaje . "');location.href = 'listar_dispositivos.php';</script>";
                    } else {
                        echo "<script>alert('" . $mensaje . "');location.href = 'modificar_dispositivos.php?id=" . $id . "';</script>";
                    }
                } //modificar

                //Carga de dipositivo
                if (isset($_GET['id'])) {
                    $id = trim($_GET['id']);

                    $di = $d->MostrarDispositivo($id);
                    $id = $di->getid_dis();
                    $nom =   $di->getnom_dis();
                    $cod =   $di->getcod_dis();
                    $alm =   $di->getalm_dis();
                    $ser =   $di->getser_dis();
                    $mod =   $di->getmod_dis();
                    $obs =   $di->getobs_dis();
                    $idma =  $di->getid_mar();
                    $idtip = $di->getid_tip();
                    $idpro = $di->getid_pro();
                    $idso =  $di->getid_so();
                }
                ?>
                <card>
                    <!-- titulo -->
                    <div class="col s12">
                        <center>
                            <h4 class="grey-text text-darken-3">Modificar Dispositivos</h4>
                        </center>
                    </div><br />
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="id_dis" name="id_dis" type="text" class="validate" readonly value="<?php echo $id ?>">
                            <label for="id_dis">ID</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="nom_dis" name="nom_dis" type="text" class="validate" value="<?php echo $nom ?>">
                            <label for="nom_dis">Nombre</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="cod_inv" name="cod_inv" type="text" class="validate" value="<?php echo $cod ?>">
                            <label for="cod_inv">Codigo de Inventario</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="alm_dis" name="alm_dis" type="text" class="validate" value="<?php echo $alm ?>">
                            <label for="alm_dis">Almacenamiento</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="ser_dis" name="ser_dis" type="text" class="validate" value="<?php echo $ser ?>">
                            <label for="ser_dis">Serie de dispositivos</label>

                        </div>
                        <div class="input-field col s4">
                            <input id="mod_dis" name="mod_dis" type="text" class="validate" value="<?php echo $mod ?>">
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
                                    if ($idm == $idma) {
                                        echo "<option value='$idm' selected='selected'>$nomm</option>";
                                    } else {
                                        echo "<option value='$idm'>$nomm</option>";
                                    }
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
                                    if ($idt == $idtip) {
                                        echo "<option value='$idt' selected='selected'>$nomt</option>";
                                    } else {
                                        echo "<option value='$idt'>$nomt</option>";
                                    }
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
                                    if ($idp == $idpro) {
                                        echo "<option value='$idp' selected='selected'>$nomp</option>";
                                    } else {
                                        echo "<option value='$idp'>$nomp</option>";
                                    }
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
                                    if ($ids == $idpro) {
                                        echo "<option value='$ids' selected='selected'>$noms</option>";
                                    } else {
                                        echo "<option value='$ids'>$noms</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Sistema Operativo</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s8">
                            <textarea id="obs_dis" name="obs_dis" class="materialize-textarea"><?php echo $mod ?></textarea>
                            <label for="obs_dis">Observaciones</label>
                        </div>

                        <div class="col s4">
                            <span class="flow-text">
                                <button class="waves-effect waves-light green btn" type="submit" name="btn_env" value="Registrar"><i class="material-icons right">save</i>Guardar</button> </span>
                        </div>
                    </div>

                </card>

            </div><!-- Fin Container -->
        </form>

        <!-- Footer -->
        <?php include '../footer.php' ?>

</main>

<!-- JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js"></script>
</body>

</html>