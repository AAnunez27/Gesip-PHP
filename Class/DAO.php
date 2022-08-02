<?php
require 'Usuario.php';
require 'Genero.php';
require 'Rol.php';
require 'Marca.php';
require 'Tipo.php';
require 'Procesador.php';
require 'So.php';
require 'Ubicacion.php';
require 'Asignacion.php';
require 'Est_pag.php';

class DAO
{
	private $mi;

	private function conexion()
	{
		// new mysql("IP SERVIDOR","USUARIO","CONTRASEÑA DEL USUARIO","BD");
		$this->mi = new mysqli("localhost", "root", "", "gesip");
		if ($this->mi->connect_errno) {
			die("Error al establecer la conexion a la BD");
		}
	}

	private function desconexion()
	{
		$this->mi->close();
	}

	public function ListarUsuario()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from usuarios where id_est = 1;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$iu = $rs['id_usu'];
			$nu = $rs['nom_usu'];
			$au = $rs['apep_usu'];
			$aum = $rs['apem_usu'];
			$ru = $rs['rut_usu'];
			$cu = $rs['con_usu'];
			$du = $rs['dir_usu'];
			$fn = $rs['fec_nac'];
			$ig = $rs['id_gen'];
			$ie = $rs['id_est'];
			$ir = $rs['id_est']; //cambiar id_est por id_rol
			$u = new Usuario($iu, $nu, $au, $aum, $ru, $cu, $du, $fn, $ig, $ie, $ir);
			$lista[] = $u;
		}
		$this->desconexion();
		return $lista;
	}
	public function ListarDispositivos()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from dispositivos where id_est = 1;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$id = $rs['id_dis'];
			$nd = $rs['nom_dis'];
			$sd = $rs['ser_dis'];
			$ci = $rs['cod_inv'];
			$ad = $rs['alm_dis'];
			$od = $rs['obs_dis'];
			$md = $rs['mod_dis'];
			$it = $rs['id_tip'];
			$im = $rs['id_mar'];
			$is = $rs['id_so'];
			$ip = $rs['id_pro'];
			$di = new Dispositivo($id,$nd,$sd,$ci,$ad,$od,$it,$im,$is,$ip,$md,1);
			$lista[] = $di;
		}
		$this->desconexion();
		return $lista;
	}
	//lista genero
	public function lisGen()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Genero;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idgen = $rs['id_gen'];
			$nomgen = $rs['nom_gen'];
			$g = new Genero($idgen, $nomgen);
			$lista[] = $g;
		}
		$this->desconexion();
		return $lista;
	}

	//lista rol
	public function lisRol()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Roles;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idrol = $rs['id_rol'];
			$nomrol = $rs['nom_rol'];
			$r = new Rol($idrol, $nomrol);
			$lista[] = $r;
		}
		$this->desconexion();
		return $lista;
	}
	public function AgregarUsuario(Usuario $u)
	{
		$rut = $u->getrut_usu();
		$id = $this->obtenerIdUsuarios();
		$verificar = $this->BuscarUsuario($rut);
		$mensaje = "";
		if ($verificar == 0) {
			$this->conexion();
			$dir = $u->getdir_usu();
			$nom = $u->getnom_usu();
			$apep = $u->getapep_usu();
			$apem = $u->getapem_usu();
			$fecn = $u->getfec_usu();
			$idgen = $u->getid_gen();
			$idrol = $u->getid_rol();

			$sql = "INSERT INTO `usuarios`(`nom_usu`, `apep_usu`, `apem_usu`, `rut_usu`, `con_usu`, `dir_usu`, `fec_nac`, `id_gen`, `id_est`) VALUES ('$nom','$apep','$apem','$rut','','$dir','$fecn','$idgen','1'); ";
			$st = $this->mi->query($sql);
			$sql2 = "INSERT INTO `nub_usu_rol`(`id_rol`, `id_usu`) VALUES ($idrol,$id);";
			$st = $this->mi->query($sql2);
			$this->desconexion();
			$mensaje = "Usuario registrado correctamente";
		} else {
			$mensaje = "El usuario ya se encuentra registrado o se a eliminado";
		}
		return $mensaje;
	}
	public function BuscarUsuario($rut)
	{
		$this->conexion();
		$sql = "select count(*) from usuarios where rut_usu = '$rut';";
		$st = $this->mi->query($sql);
		$valor = mysqli_fetch_array($st);
		$this->desconexion();
		return $valor[0];
	}
	public function MostrarUsuario($rut)
	{
		$verificar = $this->BuscarUsuario($rut);
		if ($verificar == 0) {
			$u = new Usuario("", "", "", "", "", "", "", "", "", "", "");
		} else {
			$this->conexion();
			$lista = array();
			$sql = "SELECT usuarios.id_usu,rut_usu ,dir_usu,nom_usu,apep_usu,apem_usu,id_gen,fec_nac,id_rol FROM `usuarios`inner JOIN nub_usu_rol on usuarios.id_usu = nub_usu_rol.id_usu where usuarios.rut_usu = '$rut'";
			$st = $this->mi->query($sql);
			while ($rs = mysqli_fetch_array($st)) {
				$id = $rs['id_usu'];
				$rut = $rs['rut_usu'];
				$dir = $rs['dir_usu'];
				$nom = $rs['nom_usu'];
				$apep = $rs['apep_usu'];
				$apem = $rs['apem_usu'];
				$idgen = $rs['id_gen'];
				$fecn = $rs['fec_nac'];
				$idrol = $rs['id_rol'];
				$u = new Usuario($id, $nom, $apep, $apem, $rut, "", $dir, $fecn, $idgen, 1, $idrol);
			}
			$this->desconexion();
		}
		return $u; 
	}

	public function obtenerIdUsuarios()
	{
		$this->conexion();
		$sql = "SELECT COUNT(id_usu)+1 FROM usuarios;";
		$st = $this->mi->query($sql);
		$id = mysqli_fetch_array($st);
		$this->desconexion();
		return $id[0];
	}
	public function busidusu($rut)
	{
		$this->conexion();
		$sql = "SELECT `id_usu`FROM `usuarios` WHERE rut_usu = $rut;";
		$st = $this->mi->query($sql);
		$id = mysqli_fetch_array($st);
		$this->desconexion();
		return $id[0];
	}

	public function ModificarUsuario(Usuario $u)
	{
		$rut = $u->getrut_usu();
		$verificar = $this->BuscarUsuario($rut);
		$id = $this->busidusu($rut);
		$mensaje = "";
		if ($verificar == 0) {
			$mensaje = "El Usuario no se encuentra registrado";
		} else {
			$this->conexion();
			$dir = $u->getdir_usu();
			$nom = $u->getnom_usu();
			$apep = $u->getapep_usu();
			$apem = $u->getapem_usu();
			$fecn = $u->getfec_usu();
			$idgen = $u->getid_gen();
			$idrol = $u->getid_rol();

			$sql = "UPDATE `usuarios` SET `nom_usu`='$nom',`apep_usu`='$apep',`apem_usu`='$apem',`dir_usu`='$dir',`fec_nac`='$fecn',`id_gen`='$idgen' where rut_usu = '$rut';";
			$st = $this->mi->query($sql);
			$sql2 = "UPDATE `nub_usu_rol` SET `id_rol`='$idrol' WHERE id_usu = '$id'";
			$st = $this->mi->query($sql2);
			$this->desconexion();
			$mensaje = "Usuario modificado correctamente";
		}
		return $mensaje;
	}
	public function EliminarUsuario($rut)
	{
		$verificar = $this->BuscarUsuario($rut);
		$mensaje = "";
		if ($verificar == 0) {
			$mensaje = "El usuario no se encuentra registrado";
		} else {
			$sql = "UPDATE `usuarios` SET `id_est`='2' WHERE rut_usu = '$rut'";
			$this->conexion();
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Usuario eliminado correctamente";
		}
		return $mensaje;
	}


	// Metodos para dispositivos 
	public function lisMar()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Marcas;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idmar = $rs['id_mar'];
			$nomar = $rs['nom_mar'];
			$m = new Marca($idmar, $nomar);
			$lista[] = $m;
		}
		$this->desconexion();
		return $lista;
	}
	public function lisTip()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Tipos;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idt = $rs['id_tip'];
			$nomt = $rs['nom_tip'];
			$t = new Tipo($idt, $nomt);
			$lista[] = $t;
		}
		$this->desconexion();
		return $lista;
	}
	public function lisPro()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Procesadores";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idpro = $rs['id_pro'];
			$nompro = $rs['nom_pro'];
			$pr = new Procesador($idpro, $nompro);
			$lista[] = $pr;
		}
		$this->desconexion();
		return $lista;
	}
	public function lisSo()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from SO ";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idso = $rs['id_so'];
			$nomso = $rs['nom_so'];
			$s = new SO($idso, $nomso);
			$lista[] = $s;
		}
		$this->desconexion();
		return $lista;
	}

	public function BuscarDispositivos($id)
	{
		$this->conexion();
		$sql = "select count(*) from dispositivos where id_dis = '$id';";
		$st = $this->mi->query($sql);
		$valor = mysqli_fetch_array($st);
		$this->desconexion();
		return $valor[0];
	}

	public function AgregarDispositivos(Dispositivo $di)
	{
		$id = $di->getid_dis();
		
		$verificar = $this->BuscarDispositivos($id);
		$mensaje = "";
		if ($verificar == 0) {
			$this->conexion();
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

			$sql = "INSERT INTO `dispositivos`(`nom_dis`, `ser_dis`, `cod_inv`, `alm_dis`, `obs_dis`, `mod_dis`, `id_tip`, `id_mar`, `id_so`, `id_pro`, `id_est`) VALUES ('$nom','$ser','$cod','$alm','$obs','$mod','$idtip','$idma','$idso','$idpro','1')";
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Dispositivo registrado correctamente";
		} else {
			$mensaje = "El dispositivo ya se encuentra registrado o se a eliminado";
		}
		return $mensaje;
	}
	public function busnomar($id)
	{
		$mensaje = "";
		$this->conexion();
		$sql = "SELECT `nom_mar` FROM `marcas` WHERE id_mar = $id;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$mensaje = $rs['nom_mar'];
		}		
		$this->desconexion();
		return $mensaje;
	}
	public function busnomtip($id)
	{
		$mensaje = "";
		$this->conexion();
		$sql = "SELECT `nom_tip` FROM `tipos` WHERE id_tip = $id;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$mensaje = $rs['nom_tip'];
		}		
		$this->desconexion();
		return $mensaje;
	}
	public function busnompro($id)
	{
		$mensaje = "";
		$this->conexion();
		$sql = "SELECT `nom_pro` FROM `procesadores` WHERE id_pro = $id;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$mensaje = $rs['nom_pro'];
		}		
		$this->desconexion();
		return $mensaje;
	}

	public function busnomso($id)
	{
		$mensaje = "";
		$this->conexion();
		$sql = "SELECT `nom_so` FROM `so` WHERE id_so = $id;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$mensaje = $rs['nom_so'];
		}		
		$this->desconexion();
		return $mensaje;
	}
	public function EliminarDispositivo($id)
	{
		$verificar = $this->BuscarDispositivos($id);
		$verificar2 = $this->BuscarAsignaciones($id);
		$mensaje = "";
		if ($verificar == 0) {
			$mensaje = "El dispositivo no se encuentra registrado";
		} else if ($verificar2 != 0){
			$mensaje = "El dispositivo se encuentra asignado";
		}else{
			$sql = "UPDATE `dispositivos` SET `id_est`='2' WHERE id_dis = '$id'";
			$this->conexion();
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Dispositivo eliminado correctamente";
		}
		return $mensaje;
	}
	public function MostrarDispositivo($id)
	{
		$verificar = $this->BuscarDispositivos($id);
		if ($verificar == 0) {
			$di = new Dispositivo("", "", "", "", "", "", "", "", "", "", "","");
		} else {
			$this->conexion();
			$lista = array();
			$sql = "select * from dispositivos where id_dis = '$id'";
			$st = $this->mi->query($sql);
			while ($rs = mysqli_fetch_array($st)) {
				$id = $rs['id_dis'];
				$nd = $rs['nom_dis'];
				$sd = $rs['ser_dis'];
				$ci = $rs['cod_inv'];
				$ad = $rs['alm_dis'];
				$od = $rs['obs_dis'];
				$md = $rs['mod_dis'];
				$it = $rs['id_tip'];
				$im = $rs['id_mar'];
				$is = $rs['id_so'];
				$ip = $rs['id_pro'];
				$di = new Dispositivo($id, $nd, $sd, $ci, $ad, $od, $it, $im, $is, $ip, $md, 1);
			}
			$this->desconexion();
		}
		return $di;
	}
	public function ModificarDispositivo(Dispositivo $dis)
	{
		$id = $dis->getid_dis();
		$verificar = $this->BuscarDispositivos($id);
		$mensaje = "";
		if ($verificar == 0) {
			$mensaje = "El Dispositivo no se encuentra registrado";
		} else {
			$this->conexion();
			$id  = 	 $dis->getid_dis();
			$nom =   $dis->getnom_dis();
			$cod =   $dis->getcod_dis();
			$alm =   $dis->getalm_dis();
			$ser =   $dis->getser_dis();
			$mod =   $dis->getmod_dis();
			$obs =   $dis->getobs_dis();
			$idmar =  $dis->getid_mar();
			$idtip = $dis->getid_tip();
			$idpro = $dis->getid_pro();
			$idso =  $dis->getid_so();

			$sql = "UPDATE `dispositivos` SET `nom_dis`='$nom',`ser_dis`='$ser',`cod_inv`='$cod',`alm_dis`='$alm',`obs_dis`='$obs',`mod_dis`='$mod',`id_tip`='$idtip',`id_mar`='$idmar',`id_so`='$idso',`id_pro`='$idpro' WHERE id_dis = $id;";
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Dispositivo modificado correctamente";
		}
		return $mensaje;
	}

	//--------asignaciones--------------
	//lista ubicaciones
	public function lisUbi()
	{
		$this->conexion();
		$lista = array();
		$sql = "select * from Ubicaciones;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$idubi = $rs['id_ubi'];
			$nomubi = $rs['nom_ubi'];
			$ub = new Ubicacion($idubi, $nomubi);
			$lista[] = $ub;
		}
		$this->desconexion();
		return $lista;
	}
	public function BuscarAsignaciones($id)
	{
		$this->conexion();
		$sql = "select count(*) from asignaciones where id_dis = $id and id_est = 3;";
		$st = $this->mi->query($sql);
		$valor = mysqli_fetch_array($st);
		$this->desconexion();
		return $valor[0];	
	}
	public function Seleccionarasignacion($id)
	{
		$this->conexion();
		$sql = "select id_asi from asignaciones where id_dis = $id and id_est = 3;";
		$st = $this->mi->query($sql);
		$valor = mysqli_fetch_array($st);
		$this->desconexion();
		return $valor[0];	
	}
	public function BuscarDispositivoxNombre($nom)
	{
		$this->conexion();
		$sql = "select * from dispositivos where nom_dis = '$nom'";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$id = $rs['id_dis'];
			$nd = $rs['nom_dis'];
			$sd = $rs['ser_dis'];
			$ci = $rs['cod_inv'];
			$ad = $rs['alm_dis'];
			$od = $rs['obs_dis'];
			$md = $rs['mod_dis'];
			$it = $rs['id_tip'];
			$im = $rs['id_mar'];
			$is = $rs['id_so'];
			$ip = $rs['id_pro'];
			$di = new Dispositivo($id, $nd, $sd, $ci, $ad, $od, $it, $im, $is, $ip, $md, 1);
		}
		$this->desconexion();
		return $di;
	}
	
	public function AsignarDispositivo(Asignacion $a)
	{
		$id_dis = $a->getid_dis();
		$verificar = $this->BuscarAsignaciones($id_dis);
		$mensaje = "";
		if ($verificar == 0) {
			$obs_asi = $a->getobs_asi();
			$fece_asi = $a->getfece_asi();
			$fecd_asi = $a->getfecd_asi();
			$id_ubi = $a->getid_ubi();
			$id_dis = $a->getid_dis();
			$id_usu = $a->getid_usu();
			$id_est = $a->getid_est();
			$this->conexion();
			$sql = "INSERT INTO `asignaciones`(`obs_asi`, `fece_asi`, `fecd_asi`, `id_ubi`, `id_dis`, `id_usu`, `id_est`) 
			VALUES ('$obs_asi','$fece_asi','$fecd_asi','$id_ubi','$id_dis','$id_usu','$id_est'); ";
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Dispositivo asignado correctamente";
		} else {
			$mensaje = "El Dispositivo ya se encuentra asignado";
		}
		return $mensaje;
	}
	public function ListarAsignaciones()
	{
		$this->conexion();
		$lista = array();
		$sql = "SELECT asignaciones.id_asi, dispositivos.nom_dis , usuarios.nom_usu , ubicaciones.nom_ubi , asignaciones.fece_asi , asignaciones.fecd_asi,estados.nom_est from asignaciones JOIN dispositivos on dispositivos.id_dis = asignaciones.id_dis JOIN usuarios on usuarios.id_usu = asignaciones.id_usu JOIN ubicaciones on asignaciones.id_ubi = ubicaciones.id_ubi join estados on estados.id_est = asignaciones.id_est;";
		$st = $this->mi->query($sql);
		while ($rs = mysqli_fetch_array($st)) {
			$id = $rs['id_asi'];
			$nd = $rs['nom_dis'];
			$nu = $rs['nom_usu'];
			$u = $rs['nom_ubi'];
			$fe = $rs['fece_asi'];
			$fd= $rs['fecd_asi'];
			$ne = $rs['nom_est'];
			$di = new Asignacion($id,"",$fe,$fd,$u,$nd,$nu,$ne);
			$lista[] = $di;
		}
		$this->desconexion();
		return $lista;
	}
	public function QuitarAsignacion($id)
	{
		$mensaje = "";
		$this->conexion();
			$sql = "UPDATE `asignaciones` SET id_est='4' WHERE id_asi='$id' ";
			$st = $this->mi->query($sql);
			$this->desconexion();
			$mensaje = "Asignación quitada correctamente";
		return $mensaje;
	}

	public function BuscarEstadoPagina()
	{
		$this->conexion();
		$sql = "SELECT id_est FROM `est_pag`;";
		$st = $this->mi->query($sql);
		$valor = mysqli_fetch_array($st);
		$this->desconexion();
		return $valor[0];
	}

	public function CambiarEstadoPagina(Est_Pag $e){
		$estado = $this->BuscarEstadoPagina();
		$mensaje = "";
		$est = $e->getid_est();
		if ($estado == $est) {
			$mensaje = "El sistema ya se encuentra en ese estado";
		} else {
			$this->conexion();			
			$sql2 = "UPDATE `est_pag` SET `id_est`='$est' WHERE id_est = '$estado'";
			$st = $this->mi->query($sql2);
			$this->desconexion();
			$mensaje = "Estado cambiado correctamente";
		}
		return $mensaje;
	}
}

	