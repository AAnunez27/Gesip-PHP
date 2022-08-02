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
    
    <form method="POST" action="modificar_usuario.php">
        <div class="container">

            <?php
            $mensaje = "";
            $nom_usu="";$apep_usu="";$apem_usu="";$rut_usu="";$con_usu="";$dir_usu="";$fec_usu="";$id_gen="";$id_est="";$id_rol="";

            if (isset($_POST['btn_env'])) {
                $rut = trim($_POST['rut']);
                if (strlen($rut) > 12 || strlen($rut) == 0) {
                    $mensaje = $mensaje . '- Ingrese rut valido \n';
                }

                $dir = trim($_POST['dir']);
                if (strlen($dir) > 30 || strlen($dir) == 0) {
                    $mensaje = $mensaje . '- Ingrese dirección valida \n';
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
                    $u = new Usuario("", $nom, $apep, $apem, $rut, "", $dir, $fecnac, $idgen, 1 , $idrol);
                    $mensaje = $d->ModificarUsuario($u);
                    echo "<script>alert('" . $mensaje . "');location.href = 'listar_usuario.php';</script>";
                }else{
                    echo "<script>alert('" . $mensaje . "');location.href = 'modificar_usuario.php?rut=" .$rut."';</script>";
                }
                
            } //cierre registrar
            //Carga de usuario
            if(isset($_GET['rut'])){
                $rut = trim($_GET['rut']);
        
                if(strlen($rut)>12 || strlen($rut) == 0){
                    $mensaje = $mensaje." - Error en la casilla del Rut <br/>";
                    echo "<h2>".$mensaje."</h2>";
                }else{
                    $u = $d->MostrarUsuario($rut);
                    $id_usu = $u->getid_usu();
                    $rut_usu = $u->getrut_usu();
                    $dir_usu = $u->getdir_usu();
                    $nom_usu = $u->getnom_usu();
                    $apep_usu = $u->getapep_usu();
                    $apem_usu = $u->getapem_usu();
                    $fec_usu = $u->getfec_usu();
                    $id_gen = $u->getid_gen();
                    $id_rol = $u->getid_rol();
                }        
            }
            ?>

            <card>
                <div class="col s12">
                    <center>
                        <h4 class="grey-text text-darken-3">Modificar Usuarios</h4>
                    </center>
                </div>
                <div class="row">
                    <div class="row col s12">
                        <div class="input-field col s3">
                            <input id="rut" type="text" class="validate" name="rut" readonly value="<?php echo $rut_usu ?>" autofocus>
                            <label for="rut">Rut</label>
                        </div>
                        <div class="col s1"></div>
                        <div class="input-field col s8">
                            <input id="dir" type="text" class="validate" name="dir" value="<?php echo $dir_usu ?>" >
                            <label for="dir">Dirección</label>
                        </div>
                    </div>
                    <div class="row col s12">
                        <div class="input-field col s4">
                            <input id="nom" type="text" class="validate" name="nom" value="<?php echo $nom_usu ?>" >
                            <label for="nom">Nombre</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="apep" type="text" class="validate" name="apep" value="<?php echo $apep_usu ?>" >
                            <label for="apep">Apellido Paterno</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="apem" type="text" class="validate" name="apem" value="<?php echo $apem_usu ?>" >
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
                                    ;
                                    if($id_gen == $idg){
                                        echo "<option value='$idg' selected='selected'>$nomg</option>";
                                    }else{
                                        echo "<option value='$idg'>$nomg</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Género</label>
                        </div>
                        <div class="input-field col s4">
                            <input id="fecnac" type="text" class="datepicker" name="fecnac" value="<?php echo $fec_usu ?>">
                            <label for="fecnac">Fecha de Nacimiento</label>
                        </div>
                        <div class="input-field col s4">
                            <select id="idrol" name="idrol">
                                <option value="" disabled selected>Rol</option>
                                <?php
                                $lista = $d->lisRol();
                                for ($i = 0; $i < count($lista); $i++) {
                                    $r = $lista[$i];
                                    $idr = $r->getid_rol();
                                    $nomr = $r->getnom_rol();
                                    
                                    if($id_rol == $idr){
                                        echo "<option value='$idr' selected='selected'>$nomr</option>";
                                    }else{
                                        echo "<option value='$idr'>$nomr</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="grey-text text-darken-1">Rol</label>
                        </div>
                    </div>
                    <div class="col s4 offset-s10">
                        <span class="flow-text">
                            <button class="waves-effect waves-light green btn" type="submit" name="btn_env" value="Registrar"><i class="material-icons right">save</i>Guardar Cambios</button>
                        </span>
                    </div>
                </div>
            </card>
        </div><!-- Fin Container -->
    </form>

    <!-- Footer -->
	<footer class="page-footer green darken-2 "style="position:fixed;bottom:0;left:0;width:100%;">
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
                            </main>

    <!-- JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/funciones.js"></script>
</body>

</html>