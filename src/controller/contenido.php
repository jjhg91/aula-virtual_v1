<?php 
	require_once('../../src/php/conn.php');

	$prof = (int)$_GET['mat'];

	$sel = $myPDO2->prepare("
		SELECT * FROM contenido
		WHERE id_profesorcursogrupo = $prof
		");
	$sel->execute();
	$contenidos = $sel->fetchAll();

 ?>