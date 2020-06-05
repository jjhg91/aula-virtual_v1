<?php 
	require_once('conn.php');
	$materia = (int)$_POST['materia'];


	if(is_numeric(!$materia)){
		print "MATERIA ERROR <br/>";
	}

	

	$sel = $myPDO->prepare("
		SELECT 
		i.id_estudia, 
		e.cedula, 
		e.p_nombres, 
		e.p_apellido  
		FROM inscripcion i
		inner join estudiante e on i.id_estudia = e.id_estudia 
		WHERE i.id_profesorcursogrupo = $materia
		");
	$sel->execute();
	$alumnos = $sel->fetchAll();


	$p = (int) $_POST['plan'];

	$preve = $myPDO2->prepare("
		SELECT * FROM notas WHERE id_plan_evaluacion = $p LIMIT 1
	");
	$preve->execute();
	$prevenir = $preve->fetch();

	if(is_array($prevenir) == false){

		header('location: ../../views/CargarNota/cargarNota.php?mat='.$materia.'&gu=f');
		
		exit;
	}

	


	
	foreach ($alumnos as $alumno) {

		if(is_numeric($_POST['nota'.$alumno[0]])){
			$estudiante = $alumno[0];
			$plan = (int) $_POST['plan'];
			$nota = (int)$_POST['nota'.$alumno[0]];
			$observacion = $_POST['observacion'.$alumno[0]];

			if($nota > 20 OR $nota < 0){
				$nota = 0;
			}

			$inse = $myPDO2->prepare("
				UPDATE notas SET  nota = $nota, observacion = '$observacion'
				WHERE id_plan_evaluacion = $plan AND id_estudiante = $estudiante
				");

			$inse->execute();
			
		}
		
	}


	if ($inse) {
		header('location: ../../views/CargarNota/cargarNota.php?mat='.$materia.'&gu=t');
		exit;
	} else {

		header('location: ../../views/CargarNota/cargarNota.php?mat='.$materia.'&gu=f');
		exit;
	}



?>