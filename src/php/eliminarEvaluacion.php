<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_GET['eval'];
	$materia = (int)$_GET['mat'];


	$id = $_SESSION['id'];


	if (isset($valor) == true) {

		$sql = "DELETE FROM actividades WHERE id_actividades = $valor";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/Evaluaciones/evaluaciones.php?mat='.$materia.'&gu=t');
		} else {
			header('location: ../../views/Evaluaciones/evaluaciones.php?mat='.$materia.'&gu=f');
		}


	}
	



 ?>