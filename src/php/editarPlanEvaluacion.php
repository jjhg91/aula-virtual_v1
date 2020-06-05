<?php 
	require_once('conn.php');


	$materia = (int)$_POST['mat'];
	$plan = (int) $_POST['plan'];
	$tipo = (int)$_POST['tipo'];
	$valor = (int)$_POST['valor'];
	$semana = (int)$_POST['semana'];
	$descripcion = $_POST['descripcion'];

	if (!empty($_POST['otros'])) {
		$otros = $_POST['otros'];
	}else{
		$otros = "";
	}



	$inse = $myPDO2->prepare("
		UPDATE plan_evaluacion SET 
		id_profesorcursogrupo = $materia,
		tipo_evaluacion = $tipo,
		otros = '$otros',
		valor = $valor,
		descripcion = '$descripcion',
		semana = $semana
		WHERE id_plan_evaluacion = $plan
		");

	$inse->execute();
	
	if ($inse) {
		header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=t');
		exit;
	} else {

		header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=f');
		exit;
	}



?>