<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/evaluacion.php');
    
	require_once('../Template/template.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="icon" type="image/png" href="../../media/logo.png" />
	<title>IUTJMC - Evaluaciones</title>


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

			<?php TarjetaInformativa('DETALLES EVALUACION'); ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($actividad[11] != 8): ?>
							<h4><?= $actividad[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($actividad[12]) ?></h4>
						<?php endif ?>
						
					</div>
				
				</div>
				<div class="contenido">
					<p><strong>Fecha limite: </strong><?= $actividad[4] ?></p>
					<p><strong>Valor: </strong><?= $actividad[1] ?>%</p>
					<p><strong>Punto: </strong><?= $actividad[1] * 0.20 ?>pts</p>
					<br>

					<p><strong>Descripcion: </strong><?= $actividad[5] ?></p>
					
					






					<div class="trabajos">

						<?php if ($actividad[13] or $actividad[14] or $actividad[15] or $actividad[16]): ?>
						<br>
						<br>
						<h4>Links</h4>
						<br>
						<?php endif ?>

						<?php if ($actividad[13]): ?>
						<a href="<?= $actividad[17] ?>"><?= $actividad[13] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[14]): ?>
						<a href="<?= $actividad[18] ?>"><?= $actividad[14] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[15]): ?>
						<a href="<?= $actividad[19] ?>"><?= $actividad[15] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[16]): ?>
						<a href="<?= $actividad[20] ?>"><?= $actividad[16] ?></a>
						<br>
						<br>
						<?php endif ?>

					</div>










					<div class="trabajos">

						<?php if ($actividad[6] or $actividad[7] or $actividad[8] or $actividad[9]): ?>
						<br>
						<br>
						<h4>Descarga de Materiales</h4>
						<br>
						<?php endif ?>

						<?php if ($actividad[6]): ?>
						<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[6] ?>" download>Material 1</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[7]): ?>
						<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[7] ?>" download>Material 2</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[8]): ?>
						<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[8] ?>" download>Material 3</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($actividad[9]): ?>
						<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[9] ?>" download>Material 4</a>
						<br>
						<br>
						<?php endif ?>

					</div> 
				</div>
				
			</section>	



			
			<?php if($_SESSION['user'] == 'profesor'): ?>
			<?php foreach ($actividadesE as $actividadE): ?>

			<?php 
				$query = $myPDO->prepare("SELECT cedula, p_nombres, p_apellido FROM estudiante WHERE id_estudia = $actividadE[3] AND regimen_estudio = 2");
				$query->execute();
				$estu= $query->fetch();
			?>

			<section class="trabajos cargados">
					<div class="titulo">
						<div class="titulo_izq">
							<h4><?= $estu[1]." ".$estu[2]  ?></h4>
						</div>
						<div class="titulo_der">
							<div class="enlaces">
							
								<a href="#OpenModal<?= $actividadE[3] ?>"><span class="icon-pencil"></span></a>
							</div>
						</div>
					</div>							
					<div class="contenido">
						
						<span><small><strong>C.I: </strong><?= $estu[0] ?></small></span>
						<br>
						<span><small><strong>Fecha de Entrega: </strong><?= $actividad[4]  ?></small></span>
						<br>
						
							<?php if(!$actividadE[9]): ?>
							
							<span><small><strong>Nota: </strong>SIN CORREGIR</small></span>
							<br>
							<span><small><strong>Observacion: </strong>SIN CORREGIR</small></span>
							

							<?php else: ?>

							<span><small><strong>Nota: </strong><?= $actividadE[10] ?></small></span>
							<br>
							<span><small><strong>Observacion: </strong><?= $actividadE[11] ?></small></span>
														
							
							<?php endif; ?>
						
						
						
						<div class="trabajos">
							<br>
							<?php if ($actividadE[5]): ?>
							<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$actividadE[5] ?>" download>Archivo 1</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[6]): ?>
							<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$actividadE[6] ?>" download>Archivo 2</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[7]): ?>
							<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$actividadE[7] ?>" download>Archivo 3</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[8]): ?>
							<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$actividadE[8] ?>" download>Archivo 4</a>
							<?php endif ?>	
						</div>
						<div id="OpenModal<?= $actividadE[3] ?>" class="Modal">
							<form method="post" action="../../src/php/corregirEvaluacion.php">
								<div class="grupo">
									<label for="nota">Nota</label>
									<input name="nota" type="number" value="<?= $actividadE[10] ?>">
								</div>
								<div class="grupo">
									<label for="">Observacion</label>
									<textarea name="observacion" id="observacion" cols="30" rows="10"><?= $actividadE[11] ?></textarea>
								</div>

								<div class="grupo">
									<input type="text" name="actividadE" value="<?= $actividadE[12] ?>" style="display: none;">
									<input type="text" name="materia" value="<?= $materia ?>" style="display: none;">
									<input type="text" name="evaluacion" value="<?= $evaluacion ?>" style="display: none;">
								</div>

								<div class="grupo">
									<button type="submit">Guardar</button>
									<a href="#close" class="cerrar">Cerrar</a>
								</div>
							</form>
							
						</div>
					</div>
			</section>
			

			<?php endforeach; ?>
			<?php endif ?>





			<!-- PRUEBA -->

			<?php if($_SESSION['user'] == 'alumno'): ?>
			<?php foreach ($actividadesE as $actividadE): ?>

			<?php 
				if($actividadE[3] == $_SESSION['id']):

					$query = $myPDO->prepare("SELECT cedula, p_nombres, p_apellido FROM estudiante WHERE id_estudia = $actividadE[3] AND regimen_estudio = 2");
					$query->execute();
					$estu= $query->fetch();
			?>

			<section class="trabajos cargados">
					<div class="titulo">
						<div class="titulo_izq">
							<h4><?= $estu[1]." ".$estu[2]  ?></h4>
						</div>
						
					</div>							
					<div class="contenido">
						
						<span><small><strong>C.I: </strong><?= $estu[0] ?></small></span>
						<br>
						<span><small><strong>Fecha de Entrega: </strong><?= $actividad[4]  ?></small></span>
						<br>
						<span><small>
							<strong>Estatus: </strong>
							<?php if(!$actividadE[9]): ?>
							SIN CORREGIR
							<?php else: ?>
							CORREGIDO
							<?php endif; ?>
						</small></span>
						<div class="trabajos">
							<br>
							<?php if ($actividadE[5]): ?>
							<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$actividadE[5] ?>" download>Archivo 1</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[6]): ?>
							<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$actividadE[6] ?>" download>Archivo 2</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[7]): ?>
							<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$actividadE[7] ?>" download>Archivo 3</a>
							<br>
							<br>
							<?php endif ?>
							
							<?php if ($actividadE[8]): ?>
							<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$actividadE[8] ?>" download>Archivo 4</a>
							<?php endif ?>	
						</div>
					</div>
			</section>

			<?php endif ?>
			<?php endforeach; ?>
			<?php endif ?>




			<!-- /PRUEBA -->






			<?php if ($_SESSION['user'] === 'alumno'): ?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Cargar Evaluacion</h3>
				</div>
				<div class="contenido">
					<form method="post" enctype="multipart/form-data" action="../../src/php/cargarEvaluacion.php">
						<div class="grupo">
							<?php if ($trabajo[1]): ?>
								<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$trabajo[1] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 1 CARGADO</strong></a>
							<?php else: ?>
								<a>SIN CARGAR</a>
							<?php endif; ?>

							<!--
							<label for="">SIN CARGAR</label>
							-->


							<input id="file1" name="file1" type="file">
						</div>
						<div class="grupo">
							<?php if ($trabajo[2]): ?>
								<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$trabajo[2] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 2 CARGADO</strong></a>
							<?php else: ?>
								<a>SIN CARGAR</a>
							<?php endif; ?>

							<!--
							<label for="">SIN CARGAR</label>
							-->
							<input id="file2" name="file2" type="file">
						</div>
						<div class="grupo">
							<?php if ($trabajo[3]): ?>
								<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$trabajo[3] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 3 CARGADO</strong></a>
							<?php else: ?>
								<a>SIN CARGAR</a>
							<?php endif; ?>

							<!--
							<label for="">SIN CARGAR</label>
							-->
							<input id="file3" name="file3" type="file">
						</div>
						<div class="grupo">
							<?php if ($trabajo[4]): ?>
								<a href="../../upload/<?= $materia.'/'.$evaluacion.'/'.$trabajo[4] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 4 CARGADO</strong></a>
							<?php else: ?>
								<a>SIN CARGAR</a>
							<?php endif; ?>

							<!--
							<label for="">SIN CARGAR</label>
							-->
							<input id="file4" name="file4" type="file">
						</div>
						<div class="form-group row">
							<input type="text" name="materia" value="<?= $materia  ?>" style="display: none;">
							<input type="text" name="alumno" value="<?= $alumno ?>" style="display: none;">
							<input type="text" name="evaluacion" value="<?= $evaluacion ?>" style="display: none;">
						</div>
						
						<button>Guardar</button>
					</form>
				</div>
			</section>
			<?php endif; ?>

		</main>

	</div>
	
		
	

	<footer>
		
	</footer>
	



	<!-- JS -->
	<script src="../../src/js/menu.js"></script>
	<!-- /JS -->

</body>
</html>