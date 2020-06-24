<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/planEvaluacion.php');
    
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
	<title>IUTJMC - Plan de Evaluacion</title>

	


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

			<?php TarjetaInformativa('PLAN DE EVALUACIÓN'); ?>
			
			<?php if (empty($planes)): ?>
			<section>
				<div class="contenido">
					<p>Aun no se ha cargado el plan de evaluación a esta materia. </p>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
						<br>
						<p>Por favor cargue el plan de evaluación que se impartirá en esta asignatura, recuerde que sin el plan de evaluación no podrá crear una evaluación para ser entregada por este medio, como tampoco podrá cargar las notas</p>
						<br>
						<p>* El plan de evaluacion consta de 6 evaluaciones maximo</p>
						<p>* El valor mínimo es de 5% y el máximo 30% por cada evaluación</p>

					<?php endif ?>
		
				</div>
			</section>			
			<?php endif ?>

			<?php foreach ($planes as $plan): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($plan[6] != 8): ?>
							<h4><?= $plan[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($plan[7]) ?></h4>
						<?php endif ?>
						
						
					</div>
					
					<?php if($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der">
						<div class="enlaces">
							<a title="Editar" href="#ModalEditar<?= $plan[0] ?>" ><span class="icon-pencil"></span></a>
							<a title="Eliminar" href="../../src/php/eliminarPlan.php?mat=<?= $prof ?>&plan=<?= $plan[0] ?>" ><span class="icon-bin"></span></a>
						</div>
					</div>
					<?php endif; ?>
				
				</div>
				<div class="contenido">
					<span><small><?= $plan[4] ?></small></span>
					<br>
					<span><small><strong>Valor: </strong><?= $plan[3] ?>%</small></span>
					<br>
					<span><small><strong>Puntos: </strong><?= $plan[3] * 0.20 ?>pts</small></span>
					
					<?php if ($_SESSION['user'] == 'alumno'): ?>
					<?php
						$alu = $_SESSION['id'];
						$not = $myPDO2->prepare("
							SELECT * FROM notas 
							WHERE id_estudiante = $alu AND id_plan_evaluacion = $plan[0]
							");
						$not->execute();
						$nota = $not->fetch();
					?>
					<br>
					<br>
					<?php if (isset($nota[0])): ?>
						<span><small><strong>Nota: </strong><?= $nota[4] ?></small></span>
						<br>
						<span><small><strong>Observacion: </strong><?= $nota[5] ?></small></span>
					<?php else: ?>
						<span><small><strong>Nota: </strong>SIN CORREGIR</small></span>
					<?php endif ?>
					<?php endif ?>
					
					<br>
					<br>
					<p><strong>Descripcion: </strong><?= nl2br($plan[5]) ?></p>
					

				<?php if ($_SESSION['user'] === 'profesor'): ?>
				<!-- MODAL EDITAR PLAN DE EVALUACION -->
					<div id="ModalEditar<?= $plan[0] ?>" class="editar">

						<form  method="post" action="../../src/php/editarPlanEvaluacion.php">
							
							<div class="grupo">
								<label for="tipo">Tipo de evaluacion</label>	
								<select name="tipo" class="tipo">
									
									<?php foreach ($tipos as $tipo): ?>
									
										<?php if ($tipo[1] == $plan[2]): ?>
											<option value="<?= $tipo[0]; ?>" selected="true" >
	                                 	<?= $tipo[1]; ?>
	                                 		</option>
										
										<?php else: ?>
	                                 	<option value="<?= $tipo[0]; ?> ">
	                                 		<?= $tipo[1]; ?>
	                                 	</option>
	                                
	                                 	<?php endif ?>
	                                
	                                <?php endforeach; ?>
								
								</select>
							</div>
							
							
							
							<div class="grupo">
							
								<label for="otros">Otros tipo de evaluacion </label>
								<input name="otros" type="text" value="<?= $plan[7] ?> ">
							</div>
							
							
							
							<div class="grupo">
								<label for="valor">Valor de evaluacion</label>
								<select name="valor">

									<?php foreach ($valores as $valor): ?>

										<?php if ($valor[1] == $plan[3]): ?>
										<option value="<?= $valor[0]; ?>" selected="true">
		                                	<?= $valor[1]; ?> %
		                                </option>
										<?php else: ?>
										<option value="<?= $valor[0]; ?> ">
		                                	<?= $valor[1]; ?> %
		                                </option>
										<?php endif ?>

	                             
	                                <?php endforeach; ?>
								
								</select>
							</div>
							
							<div class="grupo">
								<label for="semana">Semana de la evaluacion</label>
								<select name="semana">
									
									<?php foreach ($semanas as $semana): ?>
										
										<?php if ($semana[1] == $plan[4]): ?>
										<option value="<?= $semana[0]; ?>" selected="true">
		                                	<?= $semana[1]; ?>
		                                </option>
										<?php else: ?>
										<option value="<?= $semana[0]; ?> ">
		                                	<?= $semana[1]; ?>
		                                </option>
										<?php endif ?>
	                                
	                                <?php endforeach; ?>

								</select>	
							</div>

							<div class="grupo">
								<textarea name="descripcion" cols="20" rows="10" placeholder="Descripcion de la evaluacion"><?= $plan[5] ?></textarea>
							</div>

							<div class="grupo_oculto">
								<input type="text" name="mat" value="<?= $_GET['mat'] ?>"style="display: none;">
								<input type="text" name="plan" value="<?= $plan[0] ?>"style="display: none;">
							</div>

							<div class="botones">
								<button type="submit">Guardar</button>

								<a class="item close" href="#close" class="cerrar" >Cancelar</a>
							</div>

						</form>
							
						</div>
				<!-- /MODAL EDITAR PLAN DE EVALUACION -->
				<?php endif ?>



				</div>
			</section>
			<?php endforeach; ?>


			<?php if ($_SESSION['user'] === 'profesor'): ?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Cargar Plan de Evaluación</h3>
				</div>
				<div class="contenido">
					<form  method="post" id="agregar_plan_evaluacion" 	action="../../src/php/cargarplan.php">
						<div class="grupo">
							<label for="tipo">Tipo de evaluacion</label>	
							<select name="tipo" id="tipo_evaluacion" class="tipo">
								
								<?php foreach ($tipos as $tipo): ?>
                                 <option value="<?= $tipo[0]; ?> ">
                                 	<?= $tipo[1]; ?>
                                 	</option>
                                <?php endforeach; ?>
							
							</select>
						</div>
						<div class="grupo oculto" id="otros">
							<label for="otros">Otros tipo de evaluacion </label>
							<input name="otros" type="text">
						</div>
						<div class="grupo">
							<label for="valor">Valor de evaluacion</label>
							<select name="valor" id="valor_evaluacion">
								<?php foreach ($valores as $valor): ?>
                                <option value="<?= $valor[0]; ?> ">
                                	<?= $valor[1]; ?> %
                                </option>
                                <?php endforeach; ?>
							
							</select>
						</div>
						
						<div class="grupo">
							<label for="semana">Semana de la evaluacion</label>
							<select name="semana" id="semana_evaluacion">
								
								<?php foreach ($semanas as $semana): ?>
                                <option value="<?= $semana[0]; ?> ">
                                	<?= $semana[1]; ?>
                                </option>
                                <?php endforeach; ?>

							</select>	
						</div>
						<div class="grupo">
							<textarea name="descripcion" id="descripcion_evaluacion" cols="20" rows="10" placeholder="Descripcion de la evaluacion"></textarea>
						</div>
						<div class="grupo_oculto">
							<input type="text" name="mat" value="<?= $_GET['mat'] ?>"style="display: none;">
						</div>
						
                         
						

<!-- PRUEBA -->

						<a class="OpenModal OpenModalPreview" href="#OpenModal">Guardar</a>

						<div id="OpenModal" class="Modal">
		
							



							<section class="preview">
								<div class="titulo">
									<div class="titulo_izq">
										<h4 id="tipo">PRUEBA2</h4>

									</div>
									
								</div>
								<hr>
								<div class="contenido">
				
									<span><small><strong>Semana: </strong><span id="semana"></span></small></span>
									<br>
									<span><small><strong>Valor: </strong><span id="valor"></span></small></span>
									<br>
									<span><small><strong>Puntos: </strong><span id="puntos"></span></small></span>
									
									<br>
									<br>
					
									<p><strong>Descripcion: </strong><span id="descripcion"></span></p>
								</div>

								<div class="botones">
									<button type="submit">Guardar</button>

									<a class="item close" href="#close" class="cerrar" >Cancelar</a>
								</div>

							</section>











						</div>



<!-- PRUEBA -->







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
	<script src="../../src/js/planEvaluacion.js"></script>
	<!-- /JS -->

</body>
</html>