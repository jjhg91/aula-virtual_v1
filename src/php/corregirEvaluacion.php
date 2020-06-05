<?php 
	require_once('conn.php');
	$materia = (int)$_POST['materia'];
	$evaluacion = $_POST['evaluacion'];

	$nota = (int)$_POST['nota'];
	$observacion = $_POST['observacion'];
	$actividadE = (int)$_POST['actividadE'];

	if(is_numeric($nota) AND is_numeric($actividadE) AND $nota <= 20 AND $nota >0){

		$sel = $myPDO2->prepare("
			SELECT 
			actividades_estudiante.id_estudiante, 
			actividades.id_plan_evaluacion, 
			actividades_estudiante.id_actividades_estudiante
			FROM actividades_estudiante
			inner join actividades on actividades_estudiante.id_actividades =actividades.id_actividades 
			WHERE id_actividades_estudiante = $actividadE;
			");
		$sel->execute();
		$existe = $sel->fetch();

		if($existe){
			$sel2 = $myPDO2->prepare("
				SELECT * FROM notas
				WHERE id_estudiante = $existe[0] AND 
				id_plan_evaluacion = $existe[1] AND
				id_actividades_estudiante = $existe[2];
				");
			$sel2->execute();
			$existeNota = $sel2->fetch();

			if(!$existeNota){
				$in = $myPDO2->prepare("
				INSERT INTO notas(id_estudiante, id_plan_evaluacion, id_actividades_estudiante, nota, observacion)
				VALUES($existe[0], $existe[1], $existe[2], $nota, '$observacion');
				");
				$in->execute();

				$corregido = $myPDO2->prepare("
					UPDATE actividades_estudiante
					SET corregido=true
					WHERE id_actividades_estudiante = $actividadE;
					");
				$corregido->execute();
			}else{
				
				$modi = $myPDO2->prepare("
					UPDATE notas
					SET nota = $nota , observacion = '$observacion'
					WHERE id_estudiante = $existe[0] AND 
					id_plan_evaluacion = $existe[1] AND
					id_actividades_estudiante = $existe[2];
					");
				$modi->execute();

			}
			

		}

	}	


	header('location: ../../views/Evaluaciones/evaluacionDetalles.php?mat='.$materia.'&evalu='.$evaluacion);








?>