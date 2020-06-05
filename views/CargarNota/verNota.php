<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/verNota.php');
    
	require_once('../Template/template.php'); 

	require_once('../../src/php/conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="icon" type="image/png" href="../../media/logo.png" />
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



			
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<h4><?= $planes[2] ?></h4>
						<span><small><?= $planes[4] ?></small></span>
					</div>
					
				</div>
				<div class="contenido">
					<span><small>Valor: <?= $planes[3] ?>%</small></span>
					<br>
					<span><small>Punto: <?= $planes[3] * 0.20 ?>pts</small></span>
					<br>
					<br>
					<p> <?= $planes[5] ?> </p>
				
				</div>
			</section>	
			






		
			<?php foreach ($notas as $nota): 
					$est = $myPDO->prepare("
						SELECT p_apellido, p_nombres, cedula FROM estudiante 
						WHERE id_estudia = $nota[1];
						");
					$est->execute();
					$estudiante = $est->fetch();
				?>
			
			<section class="section_agregar">
				<div class="contenido">
					<h3><?= $estudiante[0]." ".$estudiante[1] ?></h3>
					<p><small><strong>C.I: </strong><?= $estudiante[2] ?></small></p>
					<p><small><strong>Nota: </strong><?= $nota[4] ?></small></p>
					<p>
						<small>
							<strong>Observacion: </strong>
							<?php if($nota[5]): ?>
								<?= $nota[5] ?>
							<?php else: ?>
								Sin Observaciones
							<?php endif;  ?>
						</small>
					</p>
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