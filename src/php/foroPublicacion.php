<?php 
	require_once('conn.php');
	
	$mensaje = nl2br($_POST['message']);
	$materia = (int)$_POST['materia'];
	$usuario = (int)$_POST['usuario'];
	$level = $_POST['level'];
	$fecha = date("m-d-Y",time()) ;

	
	if (  is_string($mensaje) AND strlen($mensaje) <= 10000 ) {

		$mensaje = stripslashes($mensaje);
		$mensaje =  addslashes($mensaje);
		
		if ($level == 'profesor' OR $level == 'alumno') {
			$insertar = $myPDO2->prepare("
			INSERT INTO foro(id_profesorcursogrupo, usuario, nivel, fecha, descripcion)
			VALUES($materia, $usuario, '$level', '$fecha', '$mensaje');
			");
		$insertar->execute();
		}
		
		


	}

	header('location: ../../views/Foro/foro.php?mat='.$materia);
	





 ?>