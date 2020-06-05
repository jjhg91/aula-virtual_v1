<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_GET['plan'];
	$materia = (int)$_GET['mat'];


	$id = $_SESSION['id'];


	if (isset($valor) == true) {
			
		$sql = "DELETE FROM plan_evaluacion WHERE id_plan_evaluacion = $valor";
		$query = $myPDO2->prepare($sql); 
		
		
		
		if ($query->execute()) {
			header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=t');
		} else {
			header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=f');
		}


	}
	



 ?>