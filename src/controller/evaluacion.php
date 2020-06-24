<?php 
	require_once('../../src/php/conn.php');

	$materia = (int)$_GET['mat'];
	$evaluacion = (int)$_GET['evalu'];
	$alumno = (int)$_SESSION['id'];


	$sel = $myPDO2->prepare("
		SELECT 
		actividades.id_actividades, 
		valor.descripcion, 
		tipo_evaluacion.descripcion, 
		actividades.publicacion, 
		actividades.fecha, 
		actividades.descripcion,
		actividades.file1,
		actividades.file2,
		actividades.file3,
		actividades.file4,
		actividades.id_profesorcursogrupo,
		tipo_evaluacion.id_tipo_evaluacion,
		plan_evaluacion.otros,
        actividades.nlink1,
        actividades.nlink2,
        actividades.nlink3,
        actividades.nlink4,
        actividades.link1,
        actividades.link2,
        actividades.link3,
        actividades.link4,
        plan_evaluacion.descripcion,
        plan_evaluacion.id_plan_evaluacion
		FROM actividades 
		inner join plan_evaluacion on actividades.id_plan_evaluacion = plan_evaluacion.id_plan_evaluacion 
		inner join tipo_evaluacion  on plan_evaluacion.tipo_evaluacion = tipo_evaluacion.id_tipo_evaluacion 
		inner join valor on plan_evaluacion.valor = valor.id_valor 
		WHERE actividades.id_profesorcursogrupo = $materia AND  actividades.id_actividades = $evaluacion;
		");
	$sel->execute();
	$actividad = $sel->fetch();



    $sel = $myPDO2->prepare(" 
		SELECT fecha, file1, file2, file3, file4 FROM actividades_estudiante
		WHERE id_estudiante = $alumno AND id_profesorcursogrupo = $materia AND id_actividades = $evaluacion;
	");
    $sel->execute();
    $trabajo = $sel->fetch();


    $actE = $myPDO2->prepare("
    	SELECT 
		actividades.id_actividades,
		actividades.id_profesorcursogrupo,
		actividades.id_plan_evaluacion,
		actividades_estudiante.id_estudiante,
		actividades_estudiante.fecha,
		actividades_estudiante.file1,
		actividades_estudiante.file2,
		actividades_estudiante.file3,
		actividades_estudiante.file4,
		actividades_estudiante.corregido,
		notas.nota,
		notas.observacion,
		actividades_estudiante.id_actividades_estudiante,
        actividades.nlink1,
        actividades.nlink2,
        actividades.nlink3,
        actividades.nlink4,
        actividades.link1,
        actividades.link2,
        actividades.link3,
        actividades.link4,
        actividades_estudiante.nlink1,
        actividades_estudiante.nlink2,
        actividades_estudiante.nlink3,
        actividades_estudiante.nlink4,
        actividades_estudiante.link1,
        actividades_estudiante.link2,
        actividades_estudiante.link3,
        actividades_estudiante.link4,
        actividades_estudiante.descripcion
		FROM actividades 
		inner join plan_evaluacion on actividades.id_plan_evaluacion = plan_evaluacion.id_plan_evaluacion 
		inner join tipo_evaluacion  on plan_evaluacion.tipo_evaluacion = tipo_evaluacion.id_tipo_evaluacion 
		inner join valor on plan_evaluacion.valor = valor.id_valor
		inner join actividades_estudiante on actividades_estudiante.id_actividades = actividades.id_actividades
		left join notas on notas.id_actividades_estudiante = actividades_estudiante.id_actividades_estudiante
		WHERE actividades.id_profesorcursogrupo = $materia AND  actividades.id_actividades = $evaluacion;
    	");
    $actE->execute();
    $actividadesE = $actE->fetchAll();



 ?>