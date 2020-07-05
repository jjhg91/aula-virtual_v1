<?php 
	require_once('../../src/php/conn.php');
	$prof = (int)$_GET['mat'];

	$query = $myPDO2->prepare("
		SELECT * FROM foro_tema 
		WHERE id_materia = $prof
		");
	$query->execute();

	$temas = $query->fetchAll();


?>