<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_GET['foro'];
	$materia = (int)$_GET['mat'];
	$tema = (int)$_GET['tem'];


	$id = $_SESSION['id'];


	if (isset($valor) == true) {
			
		$sql = "DELETE FROM foro 
		WHERE id_foro = $valor AND 
		id_profesorcursogrupo = $materia";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/Foro/foro.php?mat='.$materia.'&tem='.$tema.'&gu=t');
		} else {
			header('location: ../../views/Foro/foro.php?mat='.$materia.'&tem='.$tema.'&gu=f');
		}


	}
	



 ?>