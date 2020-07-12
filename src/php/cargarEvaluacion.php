<?php 
	require_once('../php/conn.php');



	$fecha = date("d-m-Y",time()) ;
	$fecha1 = strtotime($fecha);
	

	$alumno = (int)$_POST['alumno'];
	$materia = $_POST['materia'];
	$evaluacion = $_POST['evaluacion'];

	$nlink1 = $_POST['nlink1'];
	$nlink2 = $_POST['nlink2'];
	$nlink3 = $_POST['nlink3'];
	$nlink4 = $_POST['nlink4'];
	$link1 = $_POST['link1'];
	$link2 = $_POST['link2'];
	$link3 = $_POST['link3'];
	$link4 = $_POST['link4'];
	$descripcion = $_POST['descripcion'];

	$flim = $myPDO2->prepare("
		SELECT fecha FROM actividades
		WHERE 
		id_profesorcursogrupo = $materia AND 
		id_actividades = $evaluacion;  
		");
	$flim->execute();
	$flimit = $flim->fetch();
	$flimite = strtotime($flimit[0]);


	if ( $fecha1 > $flimite ) {


		header('location: ../../views/Evaluaciones/evaluacionDetalles.php?mat='.$materia.'&evalu='.$evaluacion.'&gu=f');
	}


    $query = $myPDO->prepare("
        SELECT 
        pensum.descripcion, 
        especialidad.descripcion, 
        profesorcursogrupo.id_profesorcursogrupo   
        FROM inscripcion 
        inner join profesorcursogrupo on inscripcion.id_profesorcursogrupo = profesorcursogrupo.id_profesorcursogrupo
        inner join pensum on profesorcursogrupo.curso = pensum.id_pensum
        inner join especialidad on pensum.id_especialidad = especialidad.id_especialidad  
        WHERE 
        id_estudia = $alumno AND
        periodo = 71 AND 
        profesorcursogrupo.id_profesorcursogrupo = $materia
        ");
    $query->execute();
    $resul2 = $query->fetch();

   

    if (!$resul2) {
        header('location: ../../views/Inicio/inicio.php');
    }

    $sel = $myPDO2->prepare("
    	SELECT * FROM actividades_estudiante
    	WHERE 
    	id_estudiante = $alumno AND 
    	id_profesorcursogrupo = $materia AND 
    	id_actividades = $evaluacion ;
    	");
    $sel->execute();
    $select = $sel->fetch();

   	
	
    
    if (!$select) {
    	$insert = $myPDO2->prepare("
	    	INSERT INTO actividades_estudiante(id_profesorcursogrupo, id_actividades, id_estudiante, fecha, file1, file2, file3, file4,nlink1,nlink2,nlink3,nlink4,link1,link2,link3,link4,descripcion)
			VALUES($materia, $evaluacion, $alumno, '$fecha', '', '', '', '','$nlink1','$nlink2','$nlink3','$nlink4','$link1','$link2','$link3','$link4','$descripcion');
    	");
    	$insert->execute();
    }else{
    	$upda = $myPDO2->prepare("
			UPDATE actividades_estudiante
			SET 
			fecha = '$fecha', 
			nlink1 = '$nlink1',
			nlink2 = '$nlink2',
			nlink3 = '$nlink3',
			nlink4 = '$nlink4',
			link1 = '$link1',
			link2 = '$link2',
			link3 = '$link3',
			link4 = '$link4',
			descripcion = '$descripcion'
			WHERE 
			id_actividades_estudiante = $select[0] AND
			id_profesorcursogrupo = $materia AND 
			id_actividades = $evaluacion AND
			id_estudiante = $alumno	;
    		");

    	$upda->execute();
    	
    }
    



   	




##################### ARCHIVO 1 ################
	if ($_FILES['file1']) {
		
		$tmp = $_FILES['file1']['tmp_name'];
		$size = $_FILES['file1']['size'];
		$tip = explode(".", $_FILES['file1']['name']);
		$tipo = end($tip);
		$nombre = "$alumno-1";
		$limite = 20480 *1024;

		$ruta = "../../upload/evaluacion/$materia/$evaluacion/";


		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus','docm','dotx','dotm','dot','xps','rtf','xml','odt','xlsm','xltx','xltm','xlsb','xlam','xls','xlt','csv','prm','dif','xlam','xla','xps','ods','pptx','pptm','potx','potm','ppam','ppsx','ppsm','sldx','sldm','thmx','ppt','xps','pot','thmx','','pps','ppa','wmv','tif','bmp','wmf','emf','rtf','odp','pub','ps','xps');

		if(in_array($tipo, $extensiones) && $size <= $limite){
			if(!file_exists($ruta)){
				mkdir($ruta,0777,true);
			}
			foreach ($extensiones as $ext) {
					if (is_file("$ruta$nombre.$ext")) {
						unlink("$ruta$nombre.$ext");
						
					}
				}
			if (move_uploaded_file($tmp, $ruta.$nombre.".".$tipo)) {
				$update1 = $myPDO2->prepare("
			   		UPDATE actividades_estudiante SET fecha='$fecha', file1='$nombre.$tipo' 
					WHERE id_estudiante = $alumno AND id_profesorcursogrupo = $materia AND id_actividades = $evaluacion;
			   		");
			   	$update1->execute();
				
				#print "ARCHIVO GUARDADO";
			}else{
				#print "NO SE GUARDO EL ARCHIVO";
			}
		}
		
	}
	



##################### ARCHIVO 2 ################
	if ($_FILES['file2']) {
		$tmp = $_FILES['file2']['tmp_name'];
		$size = $_FILES['file2']['size'];
		$tip = explode(".", $_FILES['file2']['name']);
		$tipo = end($tip);
		$nombre = "$alumno-2";
		$limite = 20480 *1024;

		$ruta = "../../upload/evaluacion/$materia/$evaluacion/";

		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus','docm','dotx','dotm','dot','xps','rtf','xml','odt','xlsm','xltx','xltm','xlsb','xlam','xls','xlt','csv','prm','dif','xlam','xla','xps','ods','pptx','pptm','potx','potm','ppam','ppsx','ppsm','sldx','sldm','thmx','ppt','xps','pot','thmx','','pps','ppa','wmv','tif','bmp','wmf','emf','rtf','odp','pub','ps','xps');

		if(in_array($tipo, $extensiones) && $size <= $limite){
			foreach ($extensiones as $ext) {
					if (is_file("$ruta$nombre.$ext")) {
						unlink("$ruta$nombre.$ext");
						
					}
			}
			if(!file_exists($ruta)){
				mkdir($ruta,0777,true);
			}
			if (move_uploaded_file($tmp, $ruta.$nombre.".".$tipo)) {
				$update2 = $myPDO2->prepare("
			   		UPDATE actividades_estudiante SET fecha='$fecha', file2='$nombre.$tipo' 
					WHERE id_estudiante = $alumno AND id_profesorcursogrupo = $materia AND id_actividades = $evaluacion;
			   		");
			   	$update2->execute();
				#print "ARCHIVO GUARDADO";
			}else{
				#print "NO SE GUARDO EL ARCHIVO";
			}
		}
		
	}




##################### ARCHIVO 3 ################
	if ($_FILES['file3']) {
		$tmp = $_FILES['file3']['tmp_name'];
		$size = $_FILES['file3']['size'];
		$tip = explode(".", $_FILES['file3']['name']);
		$tipo = end($tip);
		$nombre = "$alumno-3";
		$limite = 20480 *1024;

		$ruta = "../../upload/evaluacion/$materia/$evaluacion/";


		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus','docm','dotx','dotm','dot','xps','rtf','xml','odt','xlsm','xltx','xltm','xlsb','xlam','xls','xlt','csv','prm','dif','xlam','xla','xps','ods','pptx','pptm','potx','potm','ppam','ppsx','ppsm','sldx','sldm','thmx','ppt','xps','pot','thmx','','pps','ppa','wmv','tif','bmp','wmf','emf','rtf','odp','pub','ps','xps');

		if(in_array($tipo, $extensiones) && $size <= $limite){
			foreach ($extensiones as $ext) {
					if (is_file("$ruta$nombre.$ext")) {
						unlink("$ruta$nombre.$ext");
						
					}
			}
			if(!file_exists($ruta)){
				mkdir($ruta,0777,true);
			}
			if (move_uploaded_file($tmp, $ruta.$nombre.".".$tipo)) {
				$update3 = $myPDO2->prepare("
			   		UPDATE actividades_estudiante SET fecha='$fecha', file3='$nombre.$tipo' 
					WHERE id_estudiante = $alumno AND id_profesorcursogrupo = $materia AND id_actividades = $evaluacion;
			   		");
			   	$update3->execute();
				#print "ARCHIVO GUARDADO";
			}else{
				#print "NO SE GUARDO EL ARCHIVO";
			}
		}
		
	}

##################### ARCHIVO 4 ################
	if ($_FILES['file4']) {
		$tmp = $_FILES['file4']['tmp_name'];
		$size = $_FILES['file4']['size'];
		$tip = explode(".", $_FILES['file4']['name']);
		$tipo = end($tip);
		$nombre = "$alumno-4";
		$ruta = "../../upload/evaluacion/$materia/$evaluacion/";
		$limite = 20480 *1024;

		
		

		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus','docm','dotx','dotm','dot','xps','rtf','xml','odt','xlsm','xltx','xltm','xlsb','xlam','xls','xlt','csv','prm','dif','xlam','xla','xps','ods','pptx','pptm','potx','potm','ppam','ppsx','ppsm','sldx','sldm','thmx','ppt','xps','pot','thmx','','pps','ppa','wmv','tif','bmp','wmf','emf','rtf','odp','pub','ps','xps');

		if(in_array($tipo, $extensiones) && $size <= $limite){
			foreach ($extensiones as $ext) {
					if (is_file("$ruta$nombre.$ext")) {
						unlink("$ruta$nombre.$ext");
						
					}
			}
			if(!file_exists($ruta)){
				mkdir($ruta,0777,true);
			}
			if (move_uploaded_file($tmp, $ruta.$nombre.".".$tipo)) {
				$update4 = $myPDO2->prepare("
			   		UPDATE actividades_estudiante SET fecha='$fecha', file4='$nombre.$tipo' 
					WHERE id_estudiante = $alumno AND id_profesorcursogrupo = $materia AND id_actividades = $evaluacion;
			   		");
			   	$update4->execute();
				#print "ARCHIVO GUARDADO";
			}else{
				#print "NO SE GUARDO EL ARCHIVO";
			}
		}
		
	}






	if ($insert OR  $update1 OR $update2 OR $update3 OR $update4 ) {
		header('location: ../../views/Evaluaciones/evaluacionDetalles.php?mat='.$materia.'&evalu='.$evaluacion.'&gu=t');
	} else {
		header('location: ../../views/Evaluaciones/evaluacionDetalles.php?mat='.$materia.'&evalu='.$evaluacion.'&gu=f');
	}






 ?>