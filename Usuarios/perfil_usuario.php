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
    <link type="text/css" rel="stylesheet" href="../CSS/estilos.css" />
</head>
<main>

    <body>
        <!-- Barra superior -->
        <?php include '../nav.php' ?>

        <form method="POST" action="perfil_usuario.php">
            <div class="container">

                <?php

                $mensaje = "";
                $nom_usu = "";
                $apep_usu = "";
                $apem_usu = "";
                $rut_usu = "";
                $con_usu = "";
                $dir_usu = "";
                $fec_usu = "";
                $id_gen = "";
                $id_est = "";
                $id_rol = "";

                //Carga de usuario


                $u = $d->MostrarUsuario($user);
                $id_usu = $u->getid_usu();
                $rut_usu = $u->getrut_usu();
                $dir_usu = $u->getdir_usu();
                $nom_usu = $u->getnom_usu();
                $apep_usu = $u->getapep_usu();
                $apem_usu = $u->getapem_usu();
                $fec_usu = $u->getfec_usu();
                $id_gen = $u->getid_gen();
                $id_rol = $u->getid_rol();

                ?>



                <div class="col s12">
                    <div class="card-panel">
                        <div class="row">
                            <center>
                                <h5 class="grey-text text-darken-3">Perfil de Usuario</h5>
                            </center>
                            <br />

                            <div class="row col s12">
                                <div class="input-field col s4">
                                    <input id="nom" type="text" class="placeholder" name="nom" readonly value="<?php echo $nom_usu ?>">
                                    <label for="nom">Nombre</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="apep" type="text" class="placeholder" name="apep" readonly value="<?php echo $apep_usu ?>">
                                    <label for="apep">Apellido Paterno</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="apem" type="text" class="placeholder" name="apem" readonly value="<?php echo $apem_usu ?>">
                                    <label for="apem">Apellido Materno</label>
                                </div>
                            </div>
                            <div class="row col s12">
                                <!--<div class="input-field col s3">
                                    <input id="rut" type="text" class="placeholder" name="rut" readonly value="<?php echo $rut_usu ?>" autofocus>
                                    <label for="rut">Rut</label>
                                </div>
                                <div class="col s4"></div>-->
                                <div class="input-field col s8">
                                    <input id="dir" type="text" class="placeholder" name="dir" readonly value="<?php echo $dir_usu ?>">
                                    <label for="dir">Dirección</label>
                                </div>
                                <div class="input-field col s4">
                                <?php
                                        $lista = $d->lisgen();
                                        for ($i = 0; $i < count($lista); $i++) {
                                            $g = $lista[$i];
                                            $idg = $g->getid_gen();
                                            $nomg = $g->getnom_gen();;
                                            if ($id_gen == $idg) {
                                                // echo "<option value='$idg' selected='selected'>$nomg</option>";
                                                echo "<input id='gen' type='text' class='placeholder' name='gen' readonly value=" . $nomg . ">";
                                            } else {
                                                // echo "<option value='$idg'>$nomg</option>";
                                            }
                                        }
                                        ?>
                                    <label class="grey-text text-darken-1">Género</label>
                                </div>
                            </div>
                            <div class="row col s12">

                                <div class="input-field col s4">
                                    <input disabled id="fecnac" type="text" class="placeholder" name="fecnac" readonly value="<?php echo $fec_usu ?>">
                                    <label for="fecnac">Fecha de Nacimiento</label>
                                </div>
                                <div class="input-field col s4">   
                                <?php
                                        $lista = $d->lisRol();
                                        for ($i = 0; $i < count($lista); $i++) {
                                            $r = $lista[$i];
                                            $idr = $r->getid_rol();
                                            $nomr = $r->getnom_rol();

                                            if ($id_rol == $idr) {
                                                // echo "<option value='$idr' selected='selected'>$nomr</option>";
                                                echo "<input id='rol' type='text' class='placeholder' name='rol' readonly value=" . $nomr . ">";
                                            } else {
                                                // echo "<option value='$idr'>$nomr</option>";
                                            }
                                        }
                                        ?>
                                         <label class="grey-text text-darken-1">Rol</label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </form>
</main>
<!-- Footer -->
<?php include '../footer.php' ?>


<!-- JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="../js/funciones.js"></script>

</html>