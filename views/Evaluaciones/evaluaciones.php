<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/evaluaciones.php');
    
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

			<?php TarjetaInformativa('EVALUACIONES'); ?>

			
			<?php if (empty($actividades)): ?>
			<section>
				<div class="contenido">
					<p>Aun no se ha cargado evaluaciónes para ser entregadas a esta materia. </p>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
						<br>
						<p>Por favor cree alguna evaluación que el alumnos</p>
						<br>
						<p>* Primero debe cargar el plan de evaluación para relacionar a este la evaluación que desee ser entregada.</p>
						<p>* Asígnele una fecha limite la cual podrá ser entregada al finalizar ese día a las 11:59pm.</p>
						<p>* Agregue una descripción de lo que desea ser evaluado. </p>


					<?php endif ?>
		
				</div>
			</section>			
			<?php endif ?>


			<?php foreach ($actividades as $actividad): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ( $actividad[6] != 8 ): ?>
							<h4><?= $actividad[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($actividad[7]) ?></h4>
						<?php endif ?>
						
					</div>
					<?php if ($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der">
						<div class="enlaces">
							
							<a href="../../src/php/eliminarEvaluacion.php?mat=<?= $prof ?>&eval=<?= $actividad[0] ?>"><span class="icon-bin"></span></a>
						</div>
					</div>
					<?php endif ?>	
				</div>
				<div class="contenido">
					<p><strong>Fecha limite: </strong><?= $actividad[4] ?></p>
					<p><strong>Valor: </strong><?= $actividad[1] ?>%</p>
					<p><strong>Punto: </strong><?= $actividad[1] * 0.20 ?>pts</p>
					<br>
					<a href="evaluacionDetalles.php?mat=<?= $prof ?>&evalu=<?= $actividad[0]  ?>">Detalles</a>
				</div>	
			</section>	
			<?php endforeach; ?>

			<?php if ($_SESSION['user'] === 'profesor'): ?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Crear Evaluacion</h3>
				</div>
				<div class="contenido">
					<form method="post" enctype="multipart/form-data" action="../../src/php/cargarEvaluaciones.php">
						<div class="grupo">
							<label for="plan">Evaluacion</label>	
							<select name="plan" id="plan_evaluacion">
								<?php foreach ($planes as $plan): ?>


									<?php  
										$ab = $myPDO2->prepare("
												SELECT * FROM actividades
												WHERE id_plan_evaluacion = $plan[0] 
											");
										$ab->execute();
										$abc = $ab->fetch();
										if (empty($abc)):
									?>

									<?php if ($plan[4] != 8): ?>
										<option value="<?= $plan[0] ?>"><?= $plan[1].": ".$plan[2]."% - ".$plan[3] ?></option>
									<?php else: ?>
										<option value="<?= $plan[0] ?>"><?= ucfirst($plan[5]).": ".$plan[2]."% - ".$plan[3] ?></option>
									<?php endif ?>

									<?php endif ?>
								
								<?php endforeach; ?>
							
							</select>
						</div>
						<div class="grupo">
							<label for="fecha">Fecha</label>
							<input type="date" id="fecha_evaluacion" name="fecha" >
						</div>
						
						<div class="grupo">
							<textarea name="descripcion" id="descripcion_evaluacion" cols="20" rows="10" placeholder="Descripcion de la evaluacion"></textarea>
						</div>






	





						
						<div class="grupo">
							<br>
							<br>
							<h3>Links</h3>
							<br>
							<p>Para agregar un link tendrás que colocar un nombre en el campo (Nombre link) y luego colocar el link en el campo de abajo (Link) colocar el link. ejemplo</p>
							<br>
							<p>Nombre Link = Pagina Web del Instituto</p>
							<p>Link = https://iutjmc.com.ve</p>
							<br>
							<p>Aparecerá de esta manera a los alumnos <a href="https://iutjmc.com.ve">Pagina Web del Instituto</a></p>		
						</div>
						<div class="grupo">
							<input name="nlink1"  type="text" placeholder="Nombre del link 1">
							<input name="link1" type="text" placeholder="Link 1">
						</div>
						
						<div class="grupo">
							<input name="nlink2" type="text" placeholder="Nombre del link 2">
							<input name="link2" type="text" placeholder="Link 2">
						</div>

						<div class="grupo">
							<input name="nlink3" type="text" placeholder="Nombre del link 3">
							<input name="link3" type="text" placeholder="Link 3">
						</div>

						<div class="grupo">
							<input name="nlink4" type="text" placeholder="Nombre del link 4">
							<input name="link4" type="text" placeholder="Link 4">
						</div>
						
						<div class="grupo">
							<br>
							<br>
							<h3>Archivos</h3>
						</div>














						<div class="grupo">
							<input name="file1" type="file">
							<input name="file2" type="file">
							<input name="file3" type="file">
							<input name="file4" type="file">
						</div>
						<div class="grupo_oculto">
							<input type="text" name="mat" style="display: none;" value="<?= $prof ?> ">
						</div>


						<!-- <button>Guardar</button> -->

						<!-- PRUEBA  -->

						<a class="OpenModal OpenModalPreview" href="#OpenModalPreview">Guardar</a>

						<div id="OpenModalPreview" class="PreviewModal">
		
							



							<section class="preview">
								<div class="titulo">
									<div class="titulo_izq">
										<h4 id="tipo"></h4>
									</div>
								
								</div>
								<hr>
								<div class="contenido">
									<p><strong>Fecha limite: </strong><span id="fecha"></span></p>
									<p><strong>Valor: </strong><span id="valor"></span></p>
									<p><strong>Puntos: </strong><span id="puntos"></span></p>
									<br>

									<p><strong>Descripcion: </strong><span id="descripcion"></span></p>
									
						
								</div>
								<div class="botones">
									<button type="submit">Guardar</button>

									<a class="item close" href="#close" class="cerrar" >Cancelar</a>
								</div>
							</section>	











						</div>


						<!-- /PRUEBA -->
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
	<script src="../../src/js/evaluaciones.js"></script>
	<!-- /JS -->

</body>
</html>