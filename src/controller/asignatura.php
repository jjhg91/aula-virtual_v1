<?php 
    
    require_once('../../src/php/conn.php');





    if ($_SESSION['user'] == 'alumno') {

       if (isset($_GET['mat'])) {
            $prof = (int)$_GET['mat'];
        }else{
            $prof = 999999999999;
        }
        $id = (int)$_SESSION['id'];

        $query = $myPDO->prepare("
            SELECT pensum.descripcion, especialidad.descripcion, profesorcursogrupo.id_profesorcursogrupo, personal.nombres, especialidad.especial   FROM inscripcion 
            inner join profesorcursogrupo on inscripcion.id_profesorcursogrupo = profesorcursogrupo.id_profesorcursogrupo
            inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
            inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad 
            inner join personal on profesorcursogrupo.personal = personal.id_personal  
            where id_estudia = $id and periodo = 71 and profesorcursogrupo.id_profesorcursogrupo = $prof
            ");
        $query->execute();
        $resul2 = $query->fetch();

        if (!$resul2) {

			#header('location: ../Inicio/inicio.php');

        }


    
    }elseif ($_SESSION['user'] == 'profesor') {
       
        
        if (isset($_GET['mat'])) {
            $prof = (int)$_GET['mat'];
        }else{
            $prof = 999999999999;
        }
        $id = (int)$_SESSION['id'];

        $query = $myPDO->prepare("
            SELECT 
            pensum.descripcion, 
            especialidad.descripcion, 
            profesorcursogrupo.id_profesorcursogrupo, 
            personal.nombres, 
            especialidad.especial  
            FROM profesorcursogrupo 
            inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
            inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad
            inner join personal on profesorcursogrupo.personal = personal.id_personal 
            where profesorcursogrupo.id_profesorcursogrupo = $prof AND personal = $id AND periodo = 71
            ");
        $query->execute();
        $resul2 = $query->fetch();

        if (!$resul2) {

            #header('location: ../Inicio/inicio.php');
        }

        }

 ?>