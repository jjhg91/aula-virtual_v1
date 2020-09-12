<?php  
	require_once('conn.php');
	
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$materia = $_POST['materia'];

	

	if ( is_string($titulo) AND is_string($descripcion) ){

		$insertar = $myPDO2->prepare("
			INSERT INTO foro_tema(
			id_materia,
			titulo,
			descripcion
			)
			VALUES(
			$materia,
			'$titulo',
			'$descripcion'
			)
			");


		if ($insertar->execute()) {
			header('location: ../../views/Foro/foroTemas.php?mat='.$materia.'&status=t');
		}else{
			header('location: ../../views/Foro/foroTemas.php?mat='.$materia.'&status=f');
		}





	}





?>