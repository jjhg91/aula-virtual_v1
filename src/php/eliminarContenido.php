<?php 
	session_start();
	require_once('conn.php');


	$cont = (int)$_GET['cont'];
	$materia = (int)$_GET['mat'];


	$id = $_SESSION['id'];


	if (isset($cont) == true) {
			
		$sql = "DELETE FROM contenido WHERE id_contenido = $cont AND id_profesorcursogrupo = $materia";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/Contenido/contenido.php?mat='.$materia.'&gu=t');
		} else {
			header('location: ../../views/Contenido/contenido.php?mat='.$materia.'&gu=f');
		}


	}
	



 ?>