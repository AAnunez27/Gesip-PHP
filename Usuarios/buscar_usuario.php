<?php
	if(isset($_POST['submit'])){
		require '../Class/DAO.php';
	    $d = new DAO();

		$txt_rut = trim($_POST['rut']);
		$txt_pas = md5(trim($_POST['pas']));

		$lista = $d->ListarUsuario();
		$validacion = false; $rut = ""; $pas = "";

		for ($i=0; $i < count($lista); $i++) { 
			$u = $lista[$i];
			$rut = $u->getrut_usu();
			
			$pas = $u->getcon_usu();
			if($rut == $txt_rut and $pas == $txt_pas ){
				$validacion = true;
			}
		}

		if($validacion == true){
			session_name('Mantenedor');
			session_start();
			$_SESSION['rut'] = $txt_rut;
			echo 'ok';
		}else{
			echo 'Error al validar el usuario y contraseña';
		}
	}
?>