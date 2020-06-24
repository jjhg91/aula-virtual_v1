<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/cargarNota.php');
    require_once('../../src/controller/alumnoStatus.php');
    
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



	<link rel="Shortcut Icon" type="image/x-icon" href="../../media/logo.ico" />
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






		
			<?php foreach ($alumnos as $alumno): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<h3><?= $alumno[1]." ".$alumno[2] ?></h3>
						<span><small><strong>C.I: </strong><?= $alumno[3] ?></small></span>
					</div>
					<div class="titulo_der">
						<div class="enlaces">
							<a href="#ModalCargarNota<?= $alumno[0] ?>"><span class="icon-pencil"></span></a>
						</div>
						
					</div>
				</div>
				<div class="contenido">
					<?php
						$plann = $_GET['plan'];
						$busc = $myPDO2->prepare("
							SELECT * FROM notas 
							WHERE id_plan_evaluacion = $plann AND 
							id_estudiante = $alumno[0] 
						");
						$busc->execute();
						$buscar = $busc->fetch();

						if (!$buscar):
					?>
					<h4>SIN CORREGIR</h4>
					<?php else: ?>
						<p><strong>NOTA: </strong><?= $buscar[4] ?></p>
						<p><strong>OBSERVACION: </strong><?= $buscar[5] ?></p>



						<!-- MOSTRAR CORRECIONES -->
						<div class="trabajos">

							<?php if ($buscar[6] or $buscar[7] or $buscar[8] or $buscar[9]): ?>
							<br>
							<br>
							<h4>Descargar Correcciones</h4>
							<br>
							<?php endif ?>

							<?php if ($buscar[6]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $plann ?>/<?= $buscar[6] ?>" download>Material 1</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($buscar[7]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $plann ?>/<?= $buscar[7] ?>" download>Material 2</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($buscar[8]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $plann ?>/<?= $buscar[8] ?>" download>Material 3</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($buscar[9]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $plann ?>/<?= $buscar[9] ?>" download>Material 4</a>
							<br>
							<br>
							<?php endif ?>

						</div>
						<!-- /MOSTRAR CORRECIONES -->
					<?php endif ?>	
	




				<div id="ModalCargarNota<?= $alumno[0] ?>" class="editar">
					<form enctype="multipart/form-data" method="post" action="../../src/php/cargarNota.php">
						<div class="grupo">
							<label for="nota">Nota</label>
							<select name="nota" id="nota">
								<?php 
								$n = 0;
								while ( $n <= 20) {
									

									if ($buscar[4] == $n) {
										print '<option selected="selected" value="'.$n.'">'.$n.'</option>';
									}else{
										print '<option value="'.$n.'">'.$n.'</option>';
									}
									$n++;

								} ?>
							</select>
						</div>

						<div class="grupo">
							<label for="observacion">Observacion</label>
							<textarea name="observacion" id="observacion" cols="30" rows="10"><?= $buscar[5] ?></textarea>
						</div>

						<div class="grupo">

							<div class="grupo">
								<br>
								<br>
								<h3>Archivos</h3>
							</div>
							<input type="file" name="file1">
							<br>
							<br>
							<input type="file" name="file2">
							<br>
							<br>
							<input type="file" name="file3">
							<br>
							<br>
							<input type="file" name="file4">
						</div>

						<div class="grupo_oculto">
							<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">
							<input type="text" name="plan" value="<?= $_GET['plan'] ?>" style="display: none;">
							<input type="text" name="alumno" value="<?= $alumno[0] ?>" style="display: none;">
							<input type="text" name="toggle" value="1" style="display: none;">
						</div>

						<div class="botones">
							<button class="item" type="submit" >Guardar</button>
							<a class="item close" href="#close" class="cerrar" >Cancelar</a>
						</div>
					</form>
				</div>
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