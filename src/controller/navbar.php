<?php 

	 require_once('../../src/php/conn.php');

	############## NAVBAR
    if ($_SESSION['user'] == 'alumno') {
    	$id = (int)$_SESSION['id'];
    	$query2 = $myPDO->prepare("
        	SELECT pensum.descripcion, especialidad.descripcion, profesorcursogrupo.id_profesorcursogrupo,especialidad.especial   FROM inscripcion 
        	inner join profesorcursogrupo on inscripcion.id_profesorcursogrupo = profesorcursogrupo.id_profesorcursogrupo
        	inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
        	inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad  
        	where id_estudia = $id and periodo = 71
        ");
    	$query2->execute();
    	$resul = $query2->fetchAll();

    
    }elseif ($_SESSION['user'] == 'profesor') {
    	$id = (int)$_SESSION['id'];
    	$query2 = $myPDO->prepare("
       		SELECT 
            pensum.descripcion, 
            especialidad.descripcion, 
            profesorcursogrupo.id_profesorcursogrupo,
            especialidad.especial 
            FROM profesorcursogrupo 
        	inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
        	inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad  
        	where personal = $id and periodo = 71
        ");
      $query2->execute();
      $resul = $query2->fetchAll();
      
    }

?>