<?php 
	require_once('conn.php');
	
	$id = (int)$_POST['id'];
	$materia = (int)$_POST['materia'];
	$numero = (int)$_POST['numero'];
	$contenido = nl2br($_POST['message']);
	$nlink1 = $_POST['nlink1'];
	$nlink2 = $_POST['nlink2'];
	$nlink3 = $_POST['nlink3'];
	$nlink4 = $_POST['nlink4'];

	$link1 = $_POST['link1'];
	$link2 = $_POST['link2'];
	$link3 = $_POST['link3'];
	$link4 = $_POST['link4'];

	if($materia AND $numero AND $contenido AND strlen($contenido) <= 10000 ){
		$contenido = stripslashes($contenido);
		$contenido =  addslashes($contenido);

		$inser = $myPDO2->prepare("

			UPDATE contenido SET 
			id_profesorcursogrupo = $materia,
			numero = $numero,
			descripcion = '$contenido',
			nlink1 = '$nlink1',
			nlink2 = '$nlink2',
			nlink3 = '$nlink3',
			nlink4 = '$nlink4',
			link1 = '$link1',
			link2 = '$link2',
			link3 = '$link3',
			link4 = '$link4'
			WHERE id_contenido = $id;
			");
		$inser->execute();














				// INICIO DE PRUEBA


		$se = $myPDO2->prepare("
			SELECT * FROM contenido
			WHERE id_profesorcursogrupo = $materia
			AND numero = $numero
			AND descripcion = '$contenido'
			");
		$se->execute();
		$sele = $se->fetch();
		$alumno = $sele[0];



##################### ARCHIVO 1 ################
	if ($_FILES['file1']) {

		$tmp = $_FILES['file1']['tmp_name'];
		$size = $_FILES['file1']['size'];
		$tip = explode(".", $_FILES['file1']['name']);
		$tipo = end($tip);
		$nombre = "$alumno-1";
		$limite = 20480 *1024;

		$ruta = "../../upload/contenido/$materia/$alumno/";


		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus');

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
			   		UPDATE contenido SET file1='$nombre.$tipo' 
					WHERE id_contenido = $alumno AND id_profesorcursogrupo = $materia;
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

		$ruta = "../../upload/contenido/$materia/$alumno/";

		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus');

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
			   		UPDATE contenido SET file2='$nombre.$tipo' 
					WHERE id_contenido = $alumno AND id_profesorcursogrupo = $materia;
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

		$ruta = "../../upload/contenido/$materia/$alumno/";


		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus');

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
			   		UPDATE contenido SET file3='$nombre.$tipo' 
					WHERE id_contenido = $alumno AND id_profesorcursogrupo = $materia;
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
		$ruta = "../../upload/contenido/$materia/$alumno/";
		$limite = 20480 *1024;

		
		

		$extensiones = array('pdf','doc','docx','xlsx','xls','txt','pptx','ppt','pub','jpg','jpeg','gif','png','ai','svg','git','psd','raw','mp4','m4v','mov','mpg','mpeg','swf','zip','rar','mp3','wav','opus','PDF','DOC','DOCX','XLSX','XLS','TXT','PPTX','PPT','PUB','JPG','JPEG','GIF','PNG','AI','SVG','GIT','PSD','RAW','MP4','M4V','MOV','MPG','MPEG','SWF','ZIP','RAR','MP3','WAV','OPUS','Pdf','Doc','Docx','Xlsx','Xls','Txt','Pptx','Ppt','Pub','Jpg','Jpeg','Gif','Png','Ai','Svg','Git','Psd','Raw','Mp4','M4V','Mov','Mpg','Mpeg','Swf','Zip','Rar','Mp3','Wav','Opus');

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
			   		UPDATE contenido SET file4='$nombre.$tipo' 
					WHERE id_contenido = $alumno AND id_profesorcursogrupo = $materia;
			   		");
			   	$update4->execute();
				#print "ARCHIVO GUARDADO";
			}else{
				#print "NO SE GUARDO EL ARCHIVO";
			}
		}
		
	}
	



		// FIN DE PRUEBA





	}

	if ($inser) {
		header('location: ../../views/Contenido/contenido.php?mat='.$materia.'&gu=t');
	} else {
		header('location: ../../views/Contenido/contenido.php?mat='.$materia.'&gu=f');
	}
	
	









?>