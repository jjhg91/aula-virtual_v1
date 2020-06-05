<?php
	session_start();
	require_once("conn.php");

	$user = (int)$_POST['user'];
	$pass = (int)$_POST['pass']; 
	$level = $_POST['level']; 
	
	if($level == 'alumno'){

		$query = $myPDO->prepare("
			SELECT 
			id_estudia, 
			cedula, 
			p_nombres, 
			p_apellido, 
			genero 
			FROM estudiante 
			WHERE cedula = '$user' 
			AND cedula = '$pass' 
			AND regimen_estudio = 2");
		$query->execute();
		$resultado = $query->fetch();

		if($resultado[1] == $user && $resultado[1] == $pass){
			
			$_SESSION['loggedin'] = true;
			$_SESSION['user'] = 'alumno';
			$_SESSION['id'] = $resultado[0];
			$_SESSION['cedula'] = $resultado[1];
			$_SESSION['nombre'] = $resultado[2]." ".$resultado[3];
			$_SESSION['genero'] = $resultado[4];

			header('location: ../../views/Inicio/inicio.php');

		}else{
			header('location: ../../views/index.html');

		}
		

	}elseif ($level == 'profesor') {
		$query = $myPDO->prepare("SELECT id_personal, cedu_pers, nombres FROM personal WHERE cedu_pers = $user AND cedu_pers = $pass ");
		$query->execute();
		$resultado = $query->fetch();
		if($resultado[1] == $user && $resultado[1] == $pass){
			
			$_SESSION['loggedin'] = true;
			$_SESSION['user'] = 'profesor';
			$_SESSION['id'] = $resultado[0];
			$_SESSION['cedula'] = $resultado[1];
			$_SESSION['nombre'] = $resultado[2];
			$_SESSION['genero'] = 1;
			
			
			header('location: ../../views/Inicio/inicio.php');

		}else{
			header('location: ../../views/index.html');

		}
		
	}else{

		header('location: ../../views/index.html');
	}






?>