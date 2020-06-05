<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_GET['blog'];
	$materia = (int)$_GET['mat'];


	$id = $_SESSION['id'];


	if (isset($valor) == true) {
			
		$sql = "DELETE FROM blog WHERE id_blog = $valor";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/Blog/blog.php?mat='.$materia.'&gu=t');
		} else {
			header('location: ../../views/Blog/blog.php?mat='.$materia.'&gu=f');
		}


	}
	



 ?>