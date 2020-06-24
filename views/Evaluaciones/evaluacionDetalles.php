<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/evaluacion.php');
    require_once('../../src/controller/evaluaciones.php');
    
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

		<!-- MOSTRAR DETALLES DE LA EVALUACION -->
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($actividad[11] != 8): ?>
							<h4><?= $actividad[2] ?></h4>
						<?php else: ?>
							<h4><?= ucfirst($actividad[12]) ?></h4>
						<?php endif ?>
					</div>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der">
						<div class="enlaces">
							<a title="Editar" href="#ModalEditar<?= $actividad[0] ?>"><span class="icon-pencil"></span></a>
						</div>
					</div>
					<?php endif ?>	
				
				</div>
				<div class="contenido">
					<p><strong>Fecha limite: </strong><?= $actividad[4] ?></p>
					<p><strong>Valor: </strong><?= $actividad[1] ?>%</p>
					<p><strong>Punto: </strong><?= $actividad[1] * 0.20 ?>pts</p>
					<br>

					<p><strong>Descripcion: </strong><?= nl2br($actividad[5]) ?></p>
					
					






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





					<!-- MODAL EDITAR BLOG -->
					<?php if ($_SESSION['user'] === 'profesor'): ?>
				
					<div id="ModalEditar<?= $actividad[0] ?>" class="editar">
						<form method="post" enctype="multipart/form-data" action="../../src/php/editarEvaluaciones.php">
							<div class="grupo">
								<label for="plan">Evaluacion</label>	
								<select name="plan" id="plan_evaluacion">
									<option value="<?= $actividad[22] ?>" selected><?= $actividad[2].": ".$actividad[1]."% - ".$actividad[21] ?></option>

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
								<?php
									$f = $actividad[4];
									$dias = explode("-", $f);
								?>
								<input type="date" id="fecha_evaluacion" name="fecha" value="<?= $dias[2].'-'.$dias[1].'-'.$dias[0] ?>">
							</div>
							
							<div class="grupo">
								<textarea name="descripcion" id="descripcion_evaluacion" cols="20" rows="10" placeholder="Descripcion de la evaluacion"><?= $actividad[5] ?></textarea>
							</div>






		





						<!-- SECCION DE AGREGAR LINKS -->

							<div class="grupo">
								<br>
								<br>
								<h3>Links</h3>
								<br>
								<p><small>
									Para agregar un link tendrás que colocar un nombre en el campo (Nombre link) y luego colocar el link en el campo de abajo (Link) colocar el link. 
									<br>
									<br>
									Ejemplo:
									
									<br>
									Nombre Link = Pagina Web del Instituto
									<br>
									Url del Link = https://iutjmc.com.ve
									<br>
									<br>
									Aparecerá de esta manera a los alumnos <a href="https://iutjmc.com.ve">Pagina Web del Instituto</a>
								</small></p>	
							</div>

							<div class="grupo">
								<span>Link 1</span>
								<div class="grupo">
									<label for="">Nombre del Link</label>
									<input id="nlink1" name="nlink1"  type="text" placeholder="Nombre del link 1" value="<?= $actividad[13] ?>">
								</div>
								<div class="grupo">
									<label for="">Url del Link</label>
									<input id="link1" name="link1" type="text" placeholder="Url del Link 1" value="<?= $actividad[17] ?>">
								</div>
							</div>
							
							<div class="grupo">
								<span>Link 2</span>
								<div class="grupo">
									<label for="">Nombre del Link</label>
									<input id="nlink2" name="nlink2" type="text" placeholder="Nombre del link 2" value="<?= $actividad[14] ?>">
								</div>
								<div class="grupo">
									<label for="">Url del Link</label>
									<input id="link2" name="link2" type="text" placeholder="Url del Link 2" value="<?= $actividad[18] ?>">
								</div>
							</div>

							<div class="grupo">
								<span>Link 3</span>
								<div class="grupo">
									<label for="">Nombre del Link</label>
									<input id="nlink3" name="nlink3" type="text" placeholder="Nombre del link 3" value="<?= $actividad[15] ?>">
								</div>
								<div class="grupo">
									<label for="">Url del Link</label>
									<input id="link3" name="link3" type="text" placeholder="Url del Link 3" value="<?= $actividad[19] ?>">
								</div>
								
							</div>

							<div class="grupo">
								<span>Link 4</span>
								<div class="grupo">
									<label for="">Nombre del Link</label>
									<input id="nlink4" name="nlink4" type="text" placeholder="Nombre del link 4" value="<?= $actividad[16] ?>">
								</div>
								<div class="grupo">
									<label for="">Url del Link</label>
									<input id="link4" name="link4" type="text" placeholder="Url del Link 4" value="<?= $actividad[20] ?>">
								</div>
							</div>

						<!-- /SECCION DE AGREGAR LINKS -->



						<!-- EDITAR ARCHIVOS -->
							<div class="grupo">
								<br>
								<br>
								<h3>Archivos</h3>
							</div>
							
							<div class="grupo">
								<?php if ($actividad[6]): ?>
								<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[6] ?>" download>Material 1</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file1" type="file">
							</div>
							<div class="grupo">
								<?php if ($actividad[7]): ?>
								<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[7] ?>" download>Material 2</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file2" type="file">
							</div>
							<div class="grupo">
								<?php if ($actividad[8]): ?>
								<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[8] ?>" download>Material 3</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file3" type="file">
							</div>
							<div class="grupo">
								<?php if ($actividad[9]): ?>
								<a href="../../upload/actividad/<?= $actividad[10]?>/<?= $actividad[0] ?>/<?= $actividad[9] ?>" download>Material 4</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file4" type="file">
							</div>
						<!-- /EDITAR ARCHIVOS -->



							<div class="grupo_oculto">
								<input type="text" name="mat" style="display: none;" value="<?= $prof ?> ">
								<input type="text" name="actividad" style="display: none;" value="<?= $actividad[0] ?> ">
							</div>


							<div class="botones">
								<button class="item" type="submit" >Guardar</button>
								<a class="item close" href="#close" class="cerrar" >Cancelar</a>
							</div>



						</form>

						
							
					</div>
				
					<?php endif ?>
				<!-- /MODAL EDITAR BLOG -->

				</div>
			</section>	
		<!-- MOSTRAR DETALLES DE LA EVALUACION -->



			
			<?php if($_SESSION['user'] == 'profesor'): ?>

			<div id="Entregadas">
			<?php if (empty($actividadesE)): ?>
				
			<section class="trabajos cargados">				
					<div class="contenido">
						<h3>Ningun alumnos a entregado la evaluación. </h3>
						</div>
					</div>
			</section>
			
			<?php else: ?>
			<section class="trabajos cargados">				
					<div class="contenido">
						<h3>Evaluaciones Entregadas </h3>
						</div>
					</div>
			</section>
			<?php endif ?>
			
			<?php foreach ($actividadesE as $actividadE): ?>
			<?php 
				$query = $myPDO->prepare("SELECT cedula, p_nombres, p_apellido FROM estudiante WHERE id_estudia = $actividadE[3] AND regimen_estudio = 2");
				$query->execute();
				$estu= $query->fetch();

				$not = $myPDO2->prepare("
					SELECT * FROM notas 
					WHERE id_estudiante = $actividadE[3] AND
					id_plan_evaluacion = $actividadE[2]
					");
				$not->execute();
				$notas= $not->fetch();
			?>

			

			<section class="trabajos cargados">
					<div class="titulo">
						<div class="titulo_izq">
							<h4><?= $estu[1]." ".$estu[2]  ?></h4>
						</div>
						<div class="titulo_der">
							<div class="enlaces">
							
								<a title="Corregir Evaluación" href="#OpenModal<?= $actividadE[3] ?>"><span class="icon-pencil"></span></a>
							</div>
						</div>
					</div>							
					<div class="contenido">
						
						<span><small><strong>C.I: </strong><?= $estu[0] ?></small></span>
						<br>
						<span><small><strong>Fecha de Entrega: </strong><?= $actividad[4]  ?></small></span>
						<br>
						<br>			
						<?php if(!$notas): ?>
						<span><strong>Estatus: </strong>SIN CORREGIR</span>
						<?php else: ?>
						<span><strong>Estatus: </strong>CORREGIDO</span>
						<br>
						<span><strong>Nota: </strong><?= $notas[4] ?></span>
						<br>
						<span><strong>Observacion: </strong><?= $notas[5] ?></span>


						<!-- MOSTRAR CORRECIONES -->
						

							<?php if ($notas[6] or $notas[7] or $notas[8] or $notas[9]): ?>
							<br>
							<br>
							<h4>Descargar Correcciones</h4>
							<br>
							<?php endif ?>

							<?php if ($notas[6]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas[6] ?>" download>Material 1</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas[7]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas[7] ?>" download>Material 2</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas[8]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas[8] ?>" download>Material 3</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas[9]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas[9] ?>" download>Material 4</a>
							<br>
							<br>
							<?php endif ?>

						
						<!-- /MOSTRAR CORRECIONES -->

						<?php endif; ?>
						


					<!-- DESCRIPCION ENTRAGADA POR EL ESTUDIANTE -->
					<div class="Trabajos">
						<br>
						<br>
						<h3>DATOS ENVIADOS POR EL ESTUDIANTE</h3>
						
						<?php if ($actividadE[29]): ?>
						<h4>Descripcion</h4>
						<br>
						<p><?= nl2br($actividadE[29]); ?></p>
						<?php endif ?>
						
					</div>
					<!-- /DESCRIPCION ENTRAGADA POR EL ESTUDIANTE -->


					
					<!-- LINKS ENTREGADOS POR EL ESTUDIANTE -->
						<div class="trabajos">

							<?php if ($actividadE[21] or $actividadE[22] or $actividadE[23] or $actividadE[24]): ?>
							<br>
							<br>
							<h4>Links</h4>
							<br>
							<?php endif ?>

							<?php if ($actividadE[21]): ?>
							<a href="<?= $actividadE[25] ?>"><?= $actividadE[21] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[22]): ?>
							<a href="<?= $actividadE[26] ?>"><?= $actividadE[22] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[23]): ?>
							<a href="<?= $actividadE[27] ?>"><?= $actividadE[23] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[24]): ?>
							<a href="<?= $actividadE[28] ?>"><?= $actividadE[24] ?></a>
							<br>
							<br>
							<?php endif ?>

						</div>
					<!-- /LINKS ENTREGADOS POR EL ESTUDIANTE -->


					<!-- ARCHIVOS ENTREGADOS POR EL ESTUDIANTE -->
						<div class="trabajos">

							<?php if ($actividadE[5] or $actividadE[6] or $actividadE[7] or $actividadE[8]): ?>
							<br>
							<br>
							<h4>Archivos</h4>
							<br>	
							<?php endif ?>

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
					<!-- /ARCHIVOS ENTREGADOS POR EL ESTUDIANTE -->


					<!-- CORREGIR EVALUACION PROFESOR -->
						<div id="OpenModal<?= $actividadE[3] ?>" class="Modal">
							<form enctype="multipart/form-data" method="post" action="../../src/php/cargarNota.php">
								<div class="grupo">
									<label for="nota">Nota</label>
									<select name="nota" id="nota">
										<?php 
										$n = 0;
										while ( $n <= 20) {
											

											if ($notas[4] == $n) {
												print '<option selected="selected" value="'.$n.'">'.$n.'</option>';
											}else{
												print '<option value="'.$n.'">'.$n.'</option>';
											}
											$n++;

										} ?>
									</select>
								</div>
								<div class="grupo">
									<label for="">Observacion</label>
									<textarea name="observacion" id="observacion" cols="30" rows="10"><?= $notas[5] ?></textarea>
								</div>

								<div class="grupo_oculto">
									<input type="text" name="materia" value="<?= $materia ?>" style="display: none;">
									<input type="text" name="plan" value="<?= $actividad[22] ?>" style="display: none;">
									<input type="text" name="alumno" value="<?= $actividadE[3] ?>" style="display: none;">
									<input type="text" name="toggle" value="2" style="display: none;">
									<input type="text" name="evalu" value="<?= $actividadE[0] ?>" style="display: none;">
								</div>

								<div class="grupo">

									<div class="grupo">

										<h3>Archivos</h3>
									</div>
									<input type="file" name="file1">
									<br>
									<input type="file" name="file2">
									<br>
									<input type="file" name="file3">
									<br>
									<input type="file" name="file4">
								</div>

								<div class="botones">
									<button  type="submit">Guardar</button>
									<a  href="#close" class="cerrar">Cerrar</a>
								</div>



							</form>
						</div>
					<!-- /CORREGIR EVALUACION PROFESOR -->
					</div>
			</section>
			

			<?php endforeach; ?>
			</div>

			<?php endif ?>





			<!-- PRUEBA -->

			<?php if($_SESSION['user'] == 'alumno'): ?>
			<?php foreach ($actividadesE as $actividadE): ?>

			<?php 
				if($actividadE[3] == $_SESSION['id']):

					$query = $myPDO->prepare("SELECT cedula, p_nombres, p_apellido FROM estudiante WHERE id_estudia = $actividadE[3] AND regimen_estudio = 2");
					$query->execute();
					$estu= $query->fetch();

					$not2 = $myPDO2->prepare("
						SELECT * FROM notas 
						WHERE id_estudiante = $actividadE[3] AND
						id_plan_evaluacion = $actividadE[2]
						");
					$not2->execute();
					$notas2= $not2->fetch();
			?>

			<section class="trabajos cargados">
					<div class="titulo">
						<div class="titulo_izq">
							<h4><?= $estu[1]." ".$estu[2]  ?></h4>
						</div>

						<?php 
							$fecha = date("d-m-Y",time()) ;
							$fecha1 = strtotime($fecha);
							$flim = $myPDO2->prepare("
									SELECT fecha FROM actividades
									WHERE 
									id_profesorcursogrupo = $materia AND 
									id_actividades = $evaluacion;  
									");
								$flim->execute();
								$flimit = $flim->fetch();
								$flimite = strtotime($flimit[0]."+ 1 days");


								if ( $fecha1 < $flimite ):
						?>
						<div class="titulo_der">
							<div class="enlaces">
								<a title="Editar" href="#ModalEditarEstudiante"><span class="icon-pencil"></span></a>
								
							</div>
						</div>
						
						<?php endif ?>
						
					</div>							
					<div class="contenido">
						
						<span><small><strong>C.I: </strong><?= $estu[0] ?></small></span>
						<br>
						<span><small><strong>Fecha de Entrega: </strong><?= $actividad[4]  ?></small></span>
						<br>
						<br>
						<br>			
						
						<?php if(!$notas2): ?>
						<span><strong>Estatus: </strong>SIN CORREGIR</span>
						<?php else: ?>
						<span><strong>Estatus: </strong>CORREGIDO</span>
						<br>
						<span><strong>Nota: </strong><?= $notas2[4] ?></span>
						<br>
						<span><strong>Observacion: </strong><?= $notas2[5] ?></span>
						

						<!-- MOSTRAR CORRECIONES -->
						

							<?php if ($notas2[6] or $notas2[7] or $notas2[8] or $notas2[9]): ?>
							<br>
							<br>
							<h4>Descargar Correcciones</h4>
							<br>
							<?php endif ?>

							<?php if ($notas2[6]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas2[6] ?>" download>Correccion 1</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas2[7]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas2[7] ?>" download>Correccion 2</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas2[8]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas2[8] ?>" download>Correccion 3</a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($notas2[9]): ?>
							<a href="../../upload/correcciones/<?= $prof ?>/<?= $actividadE[2] ?>/<?= $notas2[9] ?>" download>Correccion 4</a>
							<br>
							<br>
							<?php endif ?>

						
						<!-- /MOSTRAR CORRECIONES -->


							
						<?php endif ?>



					<!-- DESCRIPCION ENTRAGADA POR EL ESTUDIANTE -->
					<?php if ($actividadE[29]): ?>
					<div class="Trabajos">
						<br>
						<br>
						<h4>Descripcion</h4>
						<br>
						<p><?= nl2br($actividadE[29]); ?></p>
					</div>
					<?php endif ?>
					<!-- /DESCRIPCION ENTRAGADA POR EL ESTUDIANTE -->


					
					<!-- LINKS ENTREGADOS POR EL ESTUDIANTE -->
						<div class="trabajos">

							<?php if ($actividadE[21] or $actividadE[22] or $actividadE[23] or $actividadE[24]): ?>
							<br>
							<br>
							<h4>Links</h4>
							<br>
							<?php endif ?>

							<?php if ($actividadE[21]): ?>
							<a href="<?= $actividadE[25] ?>"><?= $actividadE[21] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[22]): ?>
							<a href="<?= $actividadE[26] ?>"><?= $actividadE[22] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[23]): ?>
							<a href="<?= $actividadE[27] ?>"><?= $actividadE[23] ?></a>
							<br>
							<br>
							<?php endif ?>

							<?php if ($actividadE[24]): ?>
							<a href="<?= $actividadE[28] ?>"><?= $actividadE[24] ?></a>
							<br>
							<br>
							<?php endif ?>

						</div>
					<!-- /LINKS ENTREGADOS POR EL ESTUDIANTE -->


					<!-- ARCHIVOS ENTREGADOS POR EL ESTUDIANTE -->
						<?php if ($actividadE[5] or $actividadE[6] or $actividadE[7] or $actividadE[8]): ?>
						<div class="trabajos">
							<br>
							<br>
							<h4>Archivos</h4>
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
						<?php endif ?>
					<!-- /ARCHIVOS ENTREGADOS POR EL ESTUDIANTE -->

					<!-- MODAL EDITAR EVALUACION ENVIADA POR ALUMNO -->
						<div id="ModalEditarEstudiante" class="editar">
							<form method="post" enctype="multipart/form-data" action="../../src/php/cargarEvaluacion.php">
								
								<div class="grupo">
										<br>
										<br>
										<h3>Descripcion</h3>
									</div>
								<div class="grupo">
										<textarea name="descripcion" id="message" cols="30" rows="10" placeholder="Descripcion"><?= $actividadE[29]; ?></textarea>
								</div>

								<!-- SECCION DE AGREGAR LINKS -->

									<div class="grupo">
										<br>
										<br>
										<h3>Links</h3>
										<br>
										<p><small>
											Para agregar un link tendrás que colocar un nombre en el campo (Nombre link) y luego colocar el link en el campo de abajo (Link) colocar el link. 
											<br>
											<br>
											Ejemplo:
											
											<br>
											Nombre Link = Pagina Web del Instituto
											<br>
											Url del Link = https://iutjmc.com.ve
											<br>
											<br>
											Aparecerá de esta manera al profesor <a href="https://iutjmc.com.ve">Pagina Web del Instituto</a>
										</small></p>	
									</div>

									<div class="grupo">
										<span>Link 1</span>
										<div class="grupo">
											<label for="">Nombre del Link</label>
											<input id="nlink1" name="nlink1"  type="text" placeholder="Nombre del link 1" value=" <?= $actividadE[21] ?>">
										</div>
										<div class="grupo">
											<label for="">Url del Link</label>
											<input id="link1" name="link1" type="text" placeholder="Url del Link 1" value=" <?= $actividadE[25] ?>">
										</div>
									</div>
									
									<div class="grupo">
										<span>Link 2</span>
										<div class="grupo">
											<label for="">Nombre del Link</label>
											<input id="nlink2" name="nlink2" type="text" placeholder="Nombre del link 2" value=" <?= $actividadE[22] ?>">
										</div>
										<div class="grupo">
											<label for="">Url del Link</label>
											<input id="link2" name="link2" type="text" placeholder="Url del Link 2" value=" <?= $actividadE[26] ?>">
										</div>
									</div>

									<div class="grupo">
										<span>Link 3</span>
										<div class="grupo">
											<label for="">Nombre del Link</label>
											<input id="nlink3" name="nlink3" type="text" placeholder="Nombre del link 3" value=" <?= $actividadE[23] ?>">
										</div>
										<div class="grupo">
											<label for="">Url del Link</label>
											<input id="link3" name="link3" type="text" placeholder="Url del Link 3" value=" <?= $actividadE[27] ?>">
										</div>
										
									</div>

									<div class="grupo">
										<span>Link 4</span>
										<div class="grupo">
											<label for="">Nombre del Link</label>
											<input id="nlink4" name="nlink4" type="text" placeholder="Nombre del link 4" value=" <?= $actividadE[24] ?>">
										</div>
										<div class="grupo">
											<label for="">Url del Link</label>
											<input id="link4" name="link4" type="text" placeholder="Url del Link 4" value=" <?= $actividadE[28] ?>">
										</div>
									</div>

								<!-- /SECCION DE AGREGAR LINKS -->

								<!-- CARGAR ARCHIVO -->
									<div class="grupo">
										<br>
										<br>
										<h3>Archivos</h3>
									</div>
									<div class="grupo">
										<div class="grupo">
											<?php if ($trabajo[1]): ?>
												<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[1] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 1 CARGADO</strong></a>
											<?php else: ?>
												<a>SIN CARGAR</a>
											<?php endif; ?>


											<input id="file1" name="file1" type="file">
										</div>
										<div class="grupo">
											<?php if ($trabajo[2]): ?>
												<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[2] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 2 CARGADO</strong></a>
											<?php else: ?>
												<a>SIN CARGAR</a>
											<?php endif; ?>

							
											<input id="file2" name="file2" type="file">
										</div>
										<div class="grupo">
											<?php if ($trabajo[3]): ?>
												<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[3] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 3 CARGADO</strong></a>
											<?php else: ?>
												<a>SIN CARGAR</a>
											<?php endif; ?>

											<input id="file3" name="file3" type="file">
										</div>
										<div class="grupo">
											<?php if ($trabajo[4]): ?>
												<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[4] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 4 CARGADO</strong></a>
											<?php else: ?>
												<a>SIN CARGAR</a>
											<?php endif; ?>

									
											<input id="file4" name="file4" type="file">
										</div>
									</div>
								<!-- /CARGAR ARCHIVO -->
									
									<div class="form-group row">
										<input type="text" name="materia" value="<?= $materia  ?>" style="display: none;">
										<input type="text" name="alumno" value="<?= $alumno ?>" style="display: none;">
										<input type="text" name="evaluacion" value="<?= $evaluacion ?>" style="display: none;">
									</div>
									
									<div class="botones">
										<button class="item" type="submit" >Guardar</button>
										<a class="item close" href="#close" class="cerrar" >Cancelar</a>
									</div>
								</form>
						</div>
					<!-- /MODAL EDITAR EVALUACION ENVIADA POR ALUMNO -->

					</div>
			</section>

			<?php endif ?>
			<?php endforeach; ?>
			<?php endif ?>




			<!-- /PRUEBA -->






			<?php if ($_SESSION['user'] === 'alumno'): ?>
			<?php  
				$fecha = date("d-m-Y",time()) ;
				$fecha1 = strtotime($fecha);
				$flim = $myPDO2->prepare("
						SELECT fecha FROM actividades
						WHERE 
						id_profesorcursogrupo = $materia AND 
						id_actividades = $evaluacion;  
						");
					$flim->execute();
					$flimit = $flim->fetch();
					$flimite = strtotime($flimit[0]."+ 1 days");


					if ( $fecha1 < $flimite ):
						 $sel = $myPDO2->prepare("
					    	SELECT * FROM actividades_estudiante
					    	WHERE 
					    	id_estudiante = $alumno AND 
					    	id_profesorcursogrupo = $materia AND 
					    	id_actividades = $evaluacion ;
					    	");
					    $sel->execute();
					    $select = $sel->fetch();
					    if (!$select):
			?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Cargar Evaluacion</h3>
				</div>
				<div class="contenido">
					<form method="post" enctype="multipart/form-data" action="../../src/php/cargarEvaluacion.php">
					
					<div class="grupo">
							<br>
							<br>
							<h3>Descripcion</h3>
						</div>
					<div class="grupo">
							<textarea name="descripcion" id="message" cols="30" rows="10" placeholder="Descripcion"></textarea>
					</div>

					<!-- SECCION DE AGREGAR LINKS -->

						<div class="grupo">
							<br>
							<br>
							<h3>Links</h3>
							<br>
							<p><small>
								Para agregar un link tendrás que colocar un nombre en el campo (Nombre link) y luego colocar el link en el campo de abajo (Link) colocar el link. 
								<br>
								<br>
								Ejemplo:
								
								<br>
								Nombre Link = Pagina Web del Instituto
								<br>
								Url del Link = https://iutjmc.com.ve
								<br>
								<br>
								Aparecerá de esta manera al profesor <a href="https://iutjmc.com.ve">Pagina Web del Instituto</a>
							</small></p>	
						</div>

						<div class="grupo">
							<span>Link 1</span>
							<div class="grupo">
								<label for="">Nombre del Link</label>
								<input id="nlink1" name="nlink1"  type="text" placeholder="Nombre del link 1">
							</div>
							<div class="grupo">
								<label for="">Url del Link</label>
								<input id="link1" name="link1" type="text" placeholder="Url del Link 1">
							</div>
						</div>
						
						<div class="grupo">
							<span>Link 2</span>
							<div class="grupo">
								<label for="">Nombre del Link</label>
								<input id="nlink2" name="nlink2" type="text" placeholder="Nombre del link 2">
							</div>
							<div class="grupo">
								<label for="">Url del Link</label>
								<input id="link2" name="link2" type="text" placeholder="Url del Link 2">
							</div>
						</div>

						<div class="grupo">
							<span>Link 3</span>
							<div class="grupo">
								<label for="">Nombre del Link</label>
								<input id="nlink3" name="nlink3" type="text" placeholder="Nombre del link 3">
							</div>
							<div class="grupo">
								<label for="">Url del Link</label>
								<input id="link3" name="link3" type="text" placeholder="Url del Link 3">
							</div>
							
						</div>

						<div class="grupo">
							<span>Link 4</span>
							<div class="grupo">
								<label for="">Nombre del Link</label>
								<input id="nlink4" name="nlink4" type="text" placeholder="Nombre del link 4">
							</div>
							<div class="grupo">
								<label for="">Url del Link</label>
								<input id="link4" name="link4" type="text" placeholder="Url del Link 4">
							</div>
						</div>

					<!-- /SECCION DE AGREGAR LINKS -->

					<!-- CARGAR ARCHIVO -->
						<div class="grupo">
							<br>
							<br>
							<h3>Archivos</h3>
						</div>
						<div class="grupo">
							<div class="grupo">
								<?php if ($trabajo[1]): ?>
									<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[1] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 1 CARGADO</strong></a>
								<?php else: ?>
									<a>SIN CARGAR</a>
								<?php endif; ?>


								<input id="file1" name="file1" type="file">
							</div>
							<div class="grupo">
								<?php if ($trabajo[2]): ?>
									<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[2] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 2 CARGADO</strong></a>
								<?php else: ?>
									<a>SIN CARGAR</a>
								<?php endif; ?>

				
								<input id="file2" name="file2" type="file">
							</div>
							<div class="grupo">
								<?php if ($trabajo[3]): ?>
									<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[3] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 3 CARGADO</strong></a>
								<?php else: ?>
									<a>SIN CARGAR</a>
								<?php endif; ?>

								<input id="file3" name="file3" type="file">
							</div>
							<div class="grupo">
								<?php if ($trabajo[4]): ?>
									<a href="../../upload/evaluacion/<?= $materia.'/'.$evaluacion.'/'.$trabajo[4] ?>" class="col-md-12 col-xs-12 col-sm-12" download><strong>ARCHIVO 4 CARGADO</strong></a>
								<?php else: ?>
									<a>SIN CARGAR</a>
								<?php endif; ?>

						
								<input id="file4" name="file4" type="file">
							</div>
						</div>
					<!-- /CARGAR ARCHIVO -->
						
						<div class="form-group row">
							<input type="text" name="materia" value="<?= $materia  ?>" style="display: none;">
							<input type="text" name="alumno" value="<?= $alumno ?>" style="display: none;">
							<input type="text" name="evaluacion" value="<?= $evaluacion ?>" style="display: none;">
						</div>
						
						<button>Guardar</button>
					</form>
				</div>
			</section>				
			<?php endif ?>
			<?php else: ?>
				<section>
					<div class="contenido">
						<h1>La fecha límite de entrega de la evaluación ha finalizado</h1>
					</div>
				</section>
			<?php endif ?>

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