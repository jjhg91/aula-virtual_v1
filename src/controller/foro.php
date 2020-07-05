<?php 
	require_once('../../src/php/conn.php');

	$prof = (int)$_GET['mat'];
	$tema = (int)$_GET['tem'];

	if ( is_numeric($tema) && $tema == 0 ) {
		$sel = $myPDO2->prepare("
			SELECT * FROM foro
			WHERE id_profesorcursogrupo = $prof AND 
			id_foro_tema is null
			ORDER BY STR_TO_DATE(fecha,'%m-%d-%Y') ASC
			");
		$sel->execute();
		$posts = $sel->fetchAll();
	}elseif ( is_numeric($tema) && $tema != 0 ) {
		$sel = $myPDO2->prepare("
			SELECT * FROM foro
			WHERE id_profesorcursogrupo = $prof AND 
			id_foro_tema = $tema
			ORDER BY STR_TO_DATE(fecha,'%m-%d-%Y') ASC
			");
		$sel->execute();
		$posts = $sel->fetchAll();
	}
	
 ?>