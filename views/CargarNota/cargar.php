<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/cargarNota.php');
    
	require_once('../Template/template.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">


	<!-- PROBANDO RESPOSNIVE DESIGN -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- /PROBANDO RESPOSNIVE DESIGN -->



	<link rel="icon" type="image/png" href="../../media/logo.png" />
	<title>AULA - Cargar Notas</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/cargarNota.css">
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



			<?php foreach ($planes as $plan): ?>
			<?php if ($plan[0] == $_GET['plan'] ): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($plan[6] != 8 ): ?>
							<h4><?= $plan[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($plan[7]) ?></h4>
						<?php endif ?>

						<!-- <h4><?= $plan[2] ?></h4> -->
						<span><small><?= $plan[4] ?></small></span>
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
			<?php endif ?>
			<?php endforeach; ?>






		
			<form name="agregar_blog" method="post" action="../../src/php/cargarNota.php">


			<?php 
				$estud = $myPDO->prepare("
					SELECT 
					i.id_estudia, 
					e.cedula, 
					e.p_nombres, 
					e.p_apellido  
					FROM inscripcion i
					inner join estudiante e on i.id_estudia = e.id_estudia 
					WHERE i.id_profesorcursogrupo = $prof
					ORDER BY e.p_apellido ASC , e.p_nombres ASC
				");
				$estud->execute();
				$estudiante = $estud->fetchAll();
			foreach ($estudiante as $est): ?>
			<section class="section_agregar">
				<div class="contenido">
					<h3><?= $est[3]." ".$est[2] ?></h3>
					<p><strong>C.I: </strong><?= $est[1] ?></p>
						<div class="grupo">
							<label for="title">Nota</label>
							<input name="nota<?= $est[0] ?>" id="nota" type="number" placeholder="Titulo">
						</div>
						<div class="grupo">
							<textarea name="observacion<?= $est[0] ?>" id="observacion" cols="30" rows="10" placeholder="Observacion"></textarea>
						</div>
				</div>
			</section>
			<?php endforeach; ?>


			<section>
				<div class="contenido">
					<div class="grupo_oculto">
						<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">
						<input type="text" name="plan" value="<?= $_GET['plan'] ?>" style="display: none;">
				</div>
				<button type="submit">Guardar</button>
				</div>
			</section>
			
		</form>
	



		</main>

	</div>
	
		
	

	<footer>
		
	</footer>
	



	<!-- JS -->
	<script src="../../src/js/menu.js"></script>
	<!-- /JS -->

</body>
</html>