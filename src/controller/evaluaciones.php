<?php 
	require_once('../../src/php/conn.php');
	$prof = (int)$_GET['mat'];

	$fecha = date("Y-m-d",time()) ;
	$mi = strtotime($fecha."+1 days");
	$ma = strtotime($fecha."+360 days");
	$min = date("Y-m-d",$mi);
	$max = date("Y-m-d",$ma);


	$sel = $myPDO2->prepare("
		SELECT 
		actividades.id_actividades, 
		valor.descripcion, 
		tipo_evaluacion.descripcion, 
		actividades.publicacion, 
		actividades.fecha, 
		actividades.descripcion,
		tipo_evaluacion.id_tipo_evaluacion,
		plan_evaluacion.otros
		FROM actividades 
		inner join plan_evaluacion on actividades.id_plan_evaluacion = plan_evaluacion.id_plan_evaluacion 
		inner join tipo_evaluacion  on plan_evaluacion.tipo_evaluacion = tipo_evaluacion.id_tipo_evaluacion 
		inner join valor on plan_evaluacion.valor = valor.id_valor 
		WHERE actividades.id_profesorcursogrupo = $prof 
		ORDER BY actividades.fecha ASC;
		");
	$sel->execute();
	$actividades = $sel->fetchAll();

	$sel2 = $myPDO2->prepare("
		SELECT 
		plan_evaluacion.id_plan_evaluacion, 
		tipo_evaluacion.descripcion, 
		valor.descripcion, 
		plan_evaluacion.descripcion,
		tipo_evaluacion.id_tipo_evaluacion,
		plan_evaluacion.otros 
		FROM plan_evaluacion
		inner join tipo_evaluacion ON plan_evaluacion.tipo_evaluacion = tipo_evaluacion.id_tipo_evaluacion
		inner join valor ON plan_evaluacion.valor = valor.id_valor 
		where id_profesorcursogrupo = $prof ;
		");
	$sel2->execute();
	$planes= $sel2->fetchAll();

                               



 ?>