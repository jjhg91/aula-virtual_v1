<?php 
	require_once('conn.php');
	
	$post = (int)$_POST['post'];
	$titulo = $_POST['title'];
	$mensaje = $_POST['message'];
	$materia = (int)$_POST['materia'];
	$fecha = date("m-d-Y",time()) ;

	$nlink1 = $_POST['nlink1'];
	$nlink2 = $_POST['nlink2'];
	$nlink3 = $_POST['nlink3'];
	$nlink4 = $_POST['nlink4'];

	$link1 = $_POST['link1'];
	$link2 = $_POST['link2'];
	$link3 = $_POST['link3'];
	$link4 = $_POST['link4'];


	
	if ( is_string($titulo) AND is_string($mensaje) AND strlen($titulo) <= 300 AND strlen($mensaje) <= 10000 ) {
		$mensaje = stripslashes($mensaje);
		$mensaje =  addslashes($mensaje);
		
		$titulo = stripslashes($titulo);
		$titulo =  addslashes($titulo);

		$insertar = $myPDO2->prepare("
			UPDATE blog SET 
			id_profesorcursogrupo = $materia,
			fecha = '$fecha',
			descripcion = '$mensaje',
			titulo = '$titulo',
			nlink1 = '$nlink1',
			nlink2 = '$nlink2',
			nlink3 = '$nlink3',
			nlink4 = '$nlink4',
			link1 = '$link1',
			link2 = '$link2',
			link3 = '$link3',
			link4 = '$link4'
			WHERE id_blog = $post
			");
		$insertar->execute();










		// INICIO DE PRUEBA


		$se = $myPDO2->prepare("
			SELECT * FROM blog
			WHERE id_profesorcursogrupo = $materia
			AND fecha = '$fecha'
			AND descripcion = '$mensaje'
			AND titulo = '$titulo'
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

		$ruta = "../../upload/blog/$materia/$alumno/";


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
			   		UPDATE blog SET file1='$nombre.$tipo' 
					WHERE id_blog = $alumno AND id_profesorcursogrupo = $materia;
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

		$ruta = "../../upload/blog/$materia/$alumno/";

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
			   		UPDATE blog SET file2='$nombre.$tipo' 
					WHERE id_blog = $alumno AND id_profesorcursogrupo = $materia;
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

		$ruta = "../../upload/blog/$materia/$alumno/";


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
			   		UPDATE blog SET file3='$nombre.$tipo' 
					WHERE id_blog = $alumno AND id_profesorcursogrupo = $materia;
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
		$ruta = "../../upload/blog/$materia/$alumno/";
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
			   		UPDATE blog SET file4='$nombre.$tipo' 
					WHERE id_blog = $alumno AND id_profesorcursogrupo = $materia;
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

	header('location: ../../views/Blog/blog.php?mat='.$materia);
	





 ?>