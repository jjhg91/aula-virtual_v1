<?php 
	require_once('conn.php');

	function sesion(){
		global $myPDO2;
	  session_start();
	  $fecha = date("d-m-y h:i:s",time());
	  $id = $_SESSION['id'];

	  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	  	if ($_SESSION['user'] == 'alumno') {
	  		$sel = $myPDO2->prepare("SELECT * FROM alumnos WHERE id_estudiante = $id");
	  		$sel->execute();
	  		$sele = $sel->fetch();
	  		if ($sele) {
	  			$up = $myPDO2->prepare("UPDATE alumnos SET fecha = '$fecha' WHERE id_estudiante = $id; ");
	  			$up->execute();
	  		 }else{
				$ins = $myPDO2->prepare("INSERT INTO alumnos (id_estudiante, fecha) VALUES($id, '$fecha');");
	  			$ins->execute();

	  		 }
	  		
	  	}
	  	
	  }
	  else{
	    header("location: ../index.html");
	  }


	}


 ?>