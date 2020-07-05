<?php 
	require_once('conn.php');
	require_once('../../src/php/sesiones.php');
	sesion();


	$tema = $_POST['tema'];
	$materia = $_POST['materia'];

	$mensaje = $_POST['message'];
	$post = (int)$_POST['post'];
	$usuario = $_SESSION['id'];
	$level = $_SESSION['user'];
	$fecha = date("m-d-Y",time()) ;

	$tem = (int)$_POST['tema'];
	if ($tem == 0) {
		$tema = null;
	}else{
		$tema = $tem;
	}
	

	
	if (  is_string($mensaje) AND strlen($mensaje) <= 10000 ) {

		$mensaje = stripslashes($mensaje);
		$mensaje =  addslashes($mensaje);
		
		if ($level == 'profesor' || $level == 'alumno') {
			$insertar = $myPDO2->prepare("
			INSERT INTO foro_respuesta(id_foro, usuario, nivel, fecha, descripcion)
			VALUES($post, $usuario, '$level', '$fecha', '$mensaje');
			");
		$insertar->execute();
		}
		
		


	}

	header('location: ../../views/Foro/foro.php?mat='.$materia.'&tem='.$tema);
	



 ?>