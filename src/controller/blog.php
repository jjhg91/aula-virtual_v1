<?php 
	require_once('../../src/php/conn.php');

	$prof = (int)$_GET['mat'];

	$sel = $myPDO2->prepare("
		SELECT * FROM blog
		WHERE id_profesorcursogrupo = $prof
		ORDER BY STR_TO_DATE(fecha,'%d-%m-%Y') ASC
		");
	$sel->execute();
	$posts = $sel->fetchAll();

	$sel2 = $myPDO->prepare("
		SELECT 
		p.id_profesorcursogrupo,
		personal.nombres 
		FROM profesorcursogrupo p 
		inner join personal on p.personal = personal.id_personal 
		WHERE p.id_profesorcursogrupo = $prof
		");
	$sel2->execute();
	$profesor = $sel2->fetch();


 ?>