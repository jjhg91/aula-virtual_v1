<?php 
	require_once('../../src/php/conn.php');
	$prof = (int)$_GET['mat'];


	$sel = $myPDO->prepare("
		SELECT 
		estudiante.id_estudia, 
		estudiante.p_apellido, 
		estudiante.p_nombres, 
		estudiante.cedula, 
		pensum.descripcion, 
		especialidad.especial 
		FROM inscripcion 
		inner join profesorcursogrupo on inscripcion.id_profesorcursogrupo = profesorcursogrupo.id_profesorcursogrupo
		inner join pensum on profesorcursogrupo.curso = pensum.id_pensum 
		inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad 
		inner join estudiante on inscripcion.id_estudia = estudiante.id_estudia
		where profesorcursogrupo.id_profesorcursogrupo = $prof and profesorcursogrupo.periodo = 71
		ORDER BY estudiante.p_apellido ASC, estudiante.p_nombres ASC ; 
		");
	$sel->execute();
	$alumnos = $sel->fetchAll();

	




 ?>