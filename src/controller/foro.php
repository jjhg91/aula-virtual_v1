<?php 
	require_once('../../src/php/conn.php');

	$prof = (int)$_GET['mat'];

	$sel = $myPDO2->prepare("
		SELECT * FROM foro
		WHERE id_profesorcursogrupo = $prof
		ORDER BY STR_TO_DATE(fecha,'%d-%m-%Y') ASC
		");
	$sel->execute();
	$posts = $sel->fetchAll();

 ?>