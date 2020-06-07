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


	<!-- PROBANDO RESPOSNIVE DESIGN -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- /PROBANDO RESPOSNIVE DESIGN -->





	<link rel="icon" type="image/png" href="../../media/logo.png" />
	<title>IUTJMC - Cargar Notas</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/editarNota.css">
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

						<?php if ($planes[6] != 8 ): ?>
							<h4><?= $planes[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($planes[7]) ?></h4>
						<?php endif ?>
						
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
			















			<form name="editarNota" method="post" action="../../src/php/editarNota.php">
				<?php foreach ($notas as $nota): 
						$est = $myPDO->prepare("
							SELECT p_apellido, p_nombres, cedula, id_estudia FROM estudiante
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
						<div class="grupo">
							<label for="nota">Nota</label>
							<input name="nota<?= $estudiante[3] ?>" id="nota" type="number" value="<?= $nota[4] ?>">
						</div>
						<div class="grupo">
							<label for="observacion">Observacion</label>
							<textarea name="observacion<?= $estudiante[3] ?>" id="observacion" cols="30" rows="10" value="<?= $nota[5] ?>"></textarea>
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