<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/alumnoStatus.php');

	require_once('../Template/template.php'); 
?>

<?php if ($_SESSION['user'] == 'profesor'): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<link rel="icon" type="image/png" href="../../media/logo.png" />
	<title>IUTJMC - Alumnos</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/evaluaciones.css">
	<!-- /CUSTOM CSS -->
	<script src="../../src/js/jquery/jquery-3.5.0.min.js"></script>
	<script src="../../src/js/jquery/jquery.cookie.js"></script>
	

</head>
<body>

	<?php Loader(); ?>
	<?php Headerr(); ?>

	
	<div class="contenido">
		
		<?php Navbar(); ?>

		<main class="main_completo">

			<?php TarjetaInformativa('ALUMNOS'); ?>

			<?php foreach ($alumnos as $alumno): ?>
			<section class="plan_evaluacion">
				<div class="contenido">
					<h3><?= $alumno[1]." ".$alumno[2] ?></h3>
					<span><small><strong>C.I: </strong><?= $alumno[3] ?></small></span>
					<br>

					<?php 
	                    $sel = $myPDO2->prepare("SELECT fecha FROM alumnos WHERE id_estudiante = $alumno[0]");
	                    $sel->execute();
	                    $fecha = $sel->fetch();
	                  if (isset($fecha[0])):
	                  ?>
					<span><small><strong>Fecha de ultimoi inicio: </strong><?= $fecha[0] ?></small></span>
					<?php else: ?>
					<span><small><strong>Fecha de ultimoi inicio: </strong>No se ah conectado</small></span>
					<?php endif; ?>
				</div>
			</section>	
			<?php endforeach; ?>

		</main>

	</div>
	


	<footer>

	</footer>

	<!-- JS -->
	<script src="../../src/js/menu.js"></script>
	<!-- /JS -->

</body>
</html>
<?php endif ?>