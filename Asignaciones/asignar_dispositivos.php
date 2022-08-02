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
    <form method="POST" action="asignar_dispositivos.php">
        <?php
       
        require '../Class/Dispositivo.php';  
        $nod = "";
        $fece_reg = "";
        $fecd_reg = "";
        $id_usu = 0;
        $id_ubi = 0;
        $mensaje = "";

        
        if (isset($_GET['id_dis'])) {
            $id = trim($_GET['id_dis']);
            $as = $d->BuscarAsignaciones($id);
            if ($as == 1) {
                echo "<script>alert('Dispositivo ya se encuentra Asignado');location.href = 'asignar_dispositivos.php';</script>";
            } else {
                $di = $d->MostrarDispositivo($id);
                $idd = $di->getid_dis();
                $nod = $di->getnom_dis();
            }
        }
        if (isset($_GET['id_disq'])) {
            $id = trim($_GET['id_disq']);
            $mensaje = $d->QuitarAsignacion($id);
            echo "<script>alert('" . $mensaje . "');location.href = 'asignar_dispositivos.php';</script>";
        }
        //cierre listar asi
        if (isset($_POST['btn_env'])) {

            $nom = trim($_POST['nom_dis']);
            if (strlen($nom) == 0) {
                echo "<script>alert('- Seleccione Dispositivo');location.href = 'asignar_dispositivos.php';</script>";
            } else {
                $di = $d->BuscarDispositivoxNombre($nom);
                $id_dis = $di->getid_dis();
                $fece_reg = trim($_POST['fece_reg']);
                if (strlen($fece_reg) == 0) {
                    $mensaje = $mensaje . '- Ingrese Fecha de Registro valida \n';
                }
                $fecd_reg = trim($_POST['fecd_reg']);
                if (strlen($fecd_reg) == 0) {
                    $mensaje = $mensaje . '- Ingrese Fecha de Devolución valida \n';
                }
                $id_usu = trim($_POST['id_usu']);
                if (!is_numeric($id_usu)) {
                    $mensaje = $mensaje . '- Seleccione Usuario \n';
                }
                $id_ubi = trim($_POST['id_ubi']);
                if (!is_numeric($id_ubi)) {
                    $mensaje = $mensaje . '- Seleccione Ubicación \n';
                }
                $obs_asi = trim($_POST['obs_dis']);
                if (strlen($mensaje) == 0) {
                    $a = new Asignacion("", $obs_asi, $fece_reg, $fecd_reg, $id_ubi, $id_dis, $id_usu, 3);
                    $mensaje = $d->AsignarDispositivo($a);
                    echo "<script>alert('" . $mensaje . "');location.href = 'asignar_dispositivos.php';</script>";
                } else {
                    echo "<script>alert('" . $mensaje . "');location.href = 'asignar_dispositivos.php';</script>";
                }
            }
        }
        ?>

        <body>
            <!-- Barra superior -->
            <?php include '../nav.php' ?>

            <div class="container">
                <!-- titulo -->
                <div class="col s12">
                    <center>
                        <h4 class="grey-text text-darken-3">Asignación de Dispositivos</h4>
                    </center>
                </div>
            </div><!-- Container -->

            <div class="row">
                <!-- Card Dispositvos -->
                <div class="col s8">
                    <div class="card">
                        <div class="card-stacked">
                            <div class="card-content grey-text text-darken-3">
                                <center>
                                    <h6>Dispositivos</h6>
                                </center>
                            </div>
                            <div class="card-content green-text">
                                <table class="responsive-table centered">
                                    <!-- <div id="default-table-example_filter" class="dataTables_filter col s5">
                                        <label>
                                            <input type="search" class="" placeholder="Buscar dispositivo" aria-controls="default-table-example">
                                        </label>
                                    </div>-->
                                    <thead>
                                        <tr>
                                            <th>Nombre Dispositivo</th>
                                            <th>Codigo de inventario</th>
                                            <th>Tipo</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $lista = $d->ListarDispositivos();
                                        for ($i = 0; $i < count($lista); $i++) {
                                            $di = $lista[$i];
                                            $lista = $d->ListarDispositivos();
                                            echo "<tr>";
                                            echo "<td>" . $di->getnom_dis() . "</td>";
                                            echo "<td>" . $di->getcod_dis() . "</td>";
                                            echo "<td>" . $d->busnomtip($di->getid_tip()) . "</td>";
                                            if($d->BuscarAsignaciones($di->getid_dis())==0){
                                                echo "<td><a class='waves-effect waves-light btn-small green disabled' >Quitar Asignación</a></td>";
                                                echo "<td><a class='waves-effect waves-light btn-small green 'href='asignar_dispositivos.php?id_dis=" . $di->getid_dis() . "'>Seleccionar</a></td>";
                                            }else{
                                                echo "<td><a class='waves-effect waves-light btn-small green 'href='asignar_dispositivos.php?id_disq=".$d->Seleccionarasignacion($di->getid_dis())."'>Quitar Asignación</a></td>";
                                                echo "<td><a class='waves-effect waves-light btn-small green disabled'>Seleccionar</a></td>";
                                            }
                                            
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Asignación -->
                <div class="col s4">
                    <div class="card horizontal">
                        <div class="card-stacked">
                            <div class="card-action">
                                <center>
                                    <h6>Asignación</h6>
                                </center>
                            </div>

                            <div class="input-field col s12">
                                <input id="nom_dis" name="nom_dis" readonly class="materialize-textarea" value="<?php echo $nod ?>"></input>
                            </div>
                            <div class="input-field col s12">
                                <input id="fece_reg" name="fece_reg" type="text" class="datepicker">
                                <label for="fece_reg">Fecha de Entrega</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="fecd_reg" name="fecd_reg" type="text" class="datepicker">
                                <label for="fecd_reg">Fecha de Devolución</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="id_usu" name="id_usu">
                                    <option value="" disabled selected>Seleccione un Usuario</option>
                                    <?php
                                    $lista = $d->ListarUsuario();
                                    for ($i = 0; $i < count($lista); $i++) {
                                        $u = $lista[$i];
                                        echo "<option value='" . $u->getid_usu() . "'>" . $u->getrut_usu() . " " . $u->getnom_usu() . "</option>";
                                    }
                                    ?>
                                </select>
                                <label class="grey-text text-darken-1">Usuario</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="id_ubi" name="id_ubi">
                                    <option value="" disabled selected>Seleccione una Ubicación</option>
                                    <?php
                                    $lista = $d->lisUbi();
                                    for ($i = 0; $i < count($lista); $i++) {
                                        $ub = $lista[$i];
                                        $idubi = $ub->getid_ubi();
                                        $nomubi = $ub->getnom_ubi();
                                        echo "<option value='$idubi'>$nomubi</option>";
                                    }
                                    ?>
                                </select>
                                <label class="grey-text text-darken-1">Ubicación</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="obs_dis" name="obs_dis" class="materialize-textarea"></textarea>
                                <label for="obs_dis">Observaciones</label>
                            </div>
                            <div class="card-action">
                                <div class="col s12">
                                    <center>
                                        <button class="waves-effect waves-light  green btn">Limpiar</button>
                                        <button class="waves-effect waves-light green btn" type="submit" name="btn_env" value="Asignar"><i class="material-icons right">save</i>Asignar</button> </span>
                                    </center>
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

</body>

</html>