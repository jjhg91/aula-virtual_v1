<?php 
	session_start();
	require_once('conn.php');


	$valor = (int)$_POST['valor'];
	$tipo = (int)$_POST['tipo'];
	$semana = $_POST['semana'];
	$descripcion = $_POST['descripcion'];
	$materia = (int)$_POST['mat'];
	$otros = $_POST['otros'];

	$id = $_SESSION['id'];

	$query = $myPDO->prepare("
		SELECT pensum.descripcion, 
		especialidad.descripcion, 
		profesorcursogrupo.id_profesorcursogrupo, 
		personal.nombres  
		FROM profesorcursogrupo 
		inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
		inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad
		inner join personal on profesorcursogrupo.personal = personal.id_personal 
		where profesorcursogrupo.id_profesorcursogrupo = $materia AND personal = $id AND periodo = 71 and personal.id_personal = $id
		");

	$query->execute();
	$resul = $query->fetch();
	
	if ($resul) {

		$pre = $myPDO2->prepare("
			SELECT 
			SUM(valor.descripcion), 
			COUNT(valor.descripcion) 
			FROM plan_evaluacion
			INNER JOIN valor on plan_evaluacion.valor = valor.id_valor
			WHERE plan_evaluacion.id_profesorcursogrupo = $materia
			");
		$pre->execute();
		$preve = $pre->fetch();

		$va = $myPDO2->prepare("
			SELECT 
			descripcion
			FROM valor
			WHERE id_valor= $valor
			");
		$va->execute();
		$val = $va->fetch();

		$a = (int)$preve[0] + (int)$val[0];

		
		if ( $a <= 100 AND $preve[1] < 10) {
			if(!empty($otros) and $tipo == 8){
				$sql = "INSERT INTO plan_evaluacion (id_profesorcursogrupo, tipo_evaluacion, otros, valor, descripcion, semana) 
						VALUES($materia, $tipo, '$otros', $valor, '$descripcion', $semana);";
				print "HOLA";
			}else{
				$sql = "INSERT INTO plan_evaluacion (id_profesorcursogrupo, tipo_evaluacion, valor, descripcion, semana) 
						VALUES($materia, $tipo, $valor, '$descripcion', $semana);";
				print "CHAO";
			}
			
			
			$ins = $myPDO2->prepare($sql);
			$ins->execute();


		}

		
				
	}



	if ($ins) {
		header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=t');
	} else {
		header('location: ../../views/PlanEvaluacion/planEvaluacion.php?mat='.$materia.'&gu=f');
	}



 ?>