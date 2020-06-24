<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/cargarNota.php');
    
	require_once('../Template/template.php'); 
?>

<?php if ($_SESSION['user'] == 'profesor'): ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<!-- PROBANDO RESPOSNIVE DESIGN -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- /PROBANDO RESPOSNIVE DESIGN -->




	<link rel="Shortcut Icon" type="image/x-icon" href="../../media/logo.ico" />
	<title>IUTJMC - Cargar Notas</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/planEvaluacion.css">
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

			<?php TarjetaInformativa('CARGAR NOTA'); ?>





			<?php if (empty($planes)): ?>
			<section>
				<div class="contenido">
					<p>Aun no has cargado el plan de evaluaciones, para realizar la carga de las notas primero deberás cargar el plan de evaluación. </p>
				</div>
			</section>			
			<?php endif ?>

			<?php foreach ($planes as $plan): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($plan[6] != 8 ): ?>
							<h4><?= $plan[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($plan[7]) ?></h4>
						<?php endif ?>
						
						<span><small><?= $plan[4] ?></small></span>
					</div>
					<div class="titulo_der">
						<div class="enlaces">
						<?php 
							$tog = $myPDO2->prepare("
								SELECT * FROM notas WHERE id_plan_evaluacion = $plan[0] LIMIT 1
								");
							$tog->execute();
							$toggle = $tog->fetch();						 
						#if(is_array($toggle) == false): ?>
						<a href="cargar.php?mat=<?= $plan[1] ?>&plan=<?= $plan[0] ?>"><span class="icon-plus"></span></a>
						<?php #else: ?>
						<!-- 
						<a href="editarNota.php?mat=<?= $plan[1] ?>&plan=<?= $plan[0] ?>"><span class="icon-pencil"></span></a>
						<a href="verNota.php?mat=<?= $plan[1] ?>&plan=<?= $plan[0] ?>"><span class="icon-file-text"></span></a> -->
						<?php #endif; ?>
				
						
					</div>
					</div>
					
				</div>
				<div class="contenido">
					<span><small>Valor: <?= $plan[3] ?>%</small></span>
					<br>
					<span><small>Punto: <?= $plan[3] * 0.20 ?>pts</small></span>
					<br>
					<br>
					<p> <?= $plan[5] ?> </p>
				
					
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