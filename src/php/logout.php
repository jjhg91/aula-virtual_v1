<?php 
	session_start();
	
	unset($_SESSION['loggedin']);
	unset($_SESSION['id']);
	unset($_SESSION['cedula']);
	unset($_SESSION['apellido']);
	unset($_SESSION['nombre']);

	session_destroy();

	header('Location: ../../views/index.html');

?>