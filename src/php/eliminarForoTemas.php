<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_GET['tema'];
	$materia = (int)$_GET['mat'];


	$id = $_SESSION['id'];


	if (isset($valor) == true) {
			
		$sql = "DELETE FROM foro_tema 
		WHERE id_foro_tema = $valor AND 
		id_materia = $materia";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/Foro/foroTemas.php?mat='.$materia.'&gu=t');
		} else {
			header('location: ../../views/Foro/foroTemas.php?mat='.$materia.'&gu=f');
		}


	}
	



 ?>