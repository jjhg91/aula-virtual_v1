<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/contenido.php');


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
	<title>IUTJMC - Contenido</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/contenido.css">
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

			<?php TarjetaInformativa('CONTENIDO'); ?>
			
		<!-- MOSTAR SI CONTENIDO NO EXISTE -->

			<?php if (empty($contenidos)): ?>
			<section>
				<div class="contenido">
					<p>Aun no se ha cargado ningún contenido a esta materia. </p>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
						<br>
						<p>Por favor cargue el contenido (temas y objetivos) que se impartirá en esta asignatura </p>
					<?php endif ?>
		
				</div>
			</section>			
			<?php endif ?>

		<!-- /MOSTART SI CONTENIDO NO EXISTE -->
			


		<!-- /MOSTART SI CONTENIDO -->
			<?php foreach ($contenidos as $contenido): ?>
			<section class="contenido">
				<div class="titulo">
					<div class="titulo_izq">
						<h4>Objetivo <?= $contenido[2] ?></h4>
						
					</div>
					
					<?php if($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der ">
						<div class="enlaces">
							<a title="Editar" href="#ModalEditar<?= $contenido[0] ?>"><span class="icon-pencil"></span></a>
							<a title="Eliminar" href="../../src/php/eliminarContenido.php?cont=<?= $contenido[0] ?>&mat=<?= $prof ?>"><span class="icon-bin"></span></a>
						</div>
					</div>
					<?php endif; ?>	
				
				</div>
				<div class="contenido">
				 	<p> <?= nl2br(ucfirst($contenido[3])) ?> </p>

				<!-- MOSTAR LINKS -->
				 	<div class="trabajos">
						<?php if ($contenido[8] or $contenido[9] or $contenido[10] or $contenido[11]): ?>
						<br>
						<br>
						<h4>Links</h4>
						<br>
						<?php endif ?>

						<?php if ($contenido[8]): ?>
						<a href="<?= $contenido[12] ?>"><?= $contenido[8] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[9]): ?>
						<a href="<?= $contenido[13] ?>"><?= $contenido[9] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[10]): ?>
						<a href="<?= $contenido[14] ?>"><?= $contenido[10] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[11]): ?>
						<a href="<?= $contenido[15] ?>"><?= $contenido[11] ?></a>
						<br>
						<br>
						<?php endif ?>
					</div>
				<!-- /MOSTAR LINKS -->

				<!-- MOSTART ARCHIVOS  -->
				 	<div class="trabajos">
						<?php if ($contenido[4] or $contenido[5] or $contenido[6] or $contenido[7]): ?>
						<br>
						<br>
						<h4>Descarga de Materiales</h4>
						<br>
						<?php endif ?>

						<?php if ($contenido[4]): ?>
						<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[4] ?>" download>Material 1</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[5]): ?>
						<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[5] ?>" download>Material 2</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[6]): ?>
						<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[6] ?>" download>Material 3</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($contenido[7]): ?>
						<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[7] ?>" download>Material 4</a>
						<br>
						<br>
						<?php endif ?>
					</div>
				<!-- /MOSTART ARCHIVOS  -->




			<!-- MODAL EDITAR CONTENIDO -->

				<?php if ($_SESSION['user'] === 'profesor'): ?>
					<div id="ModalEditar<?= $contenido[0] ?>" class="editar">
						<form name="agregar_contenido" method="post"  enctype="multipart/form-data" action="../../src/php/editarContenido.php">
							<div class="grupo">
								<label for="numero">Numero de Objetivo</label>
								<input  name="numero" type="number" placeholder="Numero de Objetivo" value="<?= $contenido[2] ?>">	
							</div>
							
							<div class="grupo">
								<textarea name="message"  cols="20" rows="10" placeholder="Contenido"><?= ucfirst($contenido[3]) ?></textarea>
							</div>

							<div class="grupo_oculto">
	                      		<input name="materia" type="text"  value="<?= $prof ?>" style="display: none;">
	                      		<input name="id" type="text"  value="<?= $contenido[0] ?>" style="display: none;">

	                    	</div>
							
						<!-- EDITAR LINKS -->
							<div class="grupo">
								<br>
								<br>
								<h3>Links</h3>
								<br>	
							</div>

							<div class="grupo">
								<span>Link 1</span>
								<div class="grupo">
									<label for="nlink1">Nombre del Link</label>
									<input name="nlink1"  type="text" placeholder="Nombre del link 1" value="<?= $contenido[8] ?>">
								</div>
								<div class="grupo">
									<label for="link1">Url del Link</label>
									<input name="link1" type="text" placeholder="Url Link 1" value="<?= $contenido[12] ?>">
								</div>		
							</div>
							
							<div class="grupo">
								<span>Link 2</span>
								<div class="grupo">
									<label for="nlink2">Nombre del Link</label>
									<input name="nlink2" type="text" placeholder="Nombre del link 2" value="<?= $contenido[9] ?>">
								</div>
								<div class="grupo">
									<label for="link2">Url del Link</label>
									<input name="link2" type="text" placeholder="Url del Link 2" value="<?= $contenido[13] ?>">
								</div>
							</div>

							<div class="grupo">
								<span>Link 3</span>
								<div class="grupo">
									<label for="nlink3">Nombre del Link</label>
									<input name="nlink3" type="text" placeholder="Nombre del link 3" value="<?= $contenido[10] ?>">
								</div>
								<div class="grupo">
									<label for="link3">Url del Link</label>
									<input name="link3" type="text" placeholder="Url del Link 3" value="<?= $contenido[14] ?>">
								</div>
								
								
							</div>

							<div class="grupo">
								<span>Link 4</span>
								<div class="grupo">
									<label for="nlink4">Nombre del Link</label>
								<input name="nlink4" type="text" placeholder="Nombre del link 4" value="<?= $contenido[11] ?>">
								</div>
								<div class="grupo">
									<label for="link4">Url del Link</label>
								<input name="link4" type="text" placeholder="Url del Link 4" value="<?= $contenido[15] ?>">
								</div>
								
								
								
							</div>
						<!-- /EDITAR LINKS -->
						
						<!-- EDITAR ARCHIVOS -->
							<div class="grupo">
								<br>
								<br>
								<h3>Archivos</h3>
							</div>
							
							<div class="grupo">
								<?php if ($contenido[4]): ?>
								<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[4] ?>" download>Material 1</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file1" type="file">
							</div>
							<div class="grupo">
								<?php if ($contenido[5]): ?>
								<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[5] ?>" download>Material 2</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file2" type="file">
							</div>
							<div class="grupo">
								<?php if ($contenido[6]): ?>
								<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[6] ?>" download>Material 3</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file3" type="file">
							</div>
							<div class="grupo">
								<?php if ($contenido[7]): ?>
								<a href="../../upload/contenido/<?= $contenido[1]?>/<?= $contenido[0] ?>/<?= $contenido[7] ?>" download>Material 4</a>
								<br>
								<br>
								<?php endif ?>
								<input name="file4" type="file">
							</div>
						<!-- /EDITAR ARCHIVOS -->

							
							
						
							<div class="botones">
								<button class="item" type="submit" >Guardar</button>
								<a class="item close" href="#close" class="cerrar" >Cancelar</a>
							</div>
										
									
							
						</form>		
						
							
					</div>
				
				<?php endif ?>
			<!-- /MODAL EDITAR CONTENIDO-->



				</div>

			</section>
			<?php endforeach ?>

		<!-- /MOSTART CONTENIDO -->



		<!-- AGREGAR NUEVO CONTENIDO -->

			<?php if ($_SESSION['user'] === 'profesor'): ?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Crear Nuevo Contenido</h3>
				</div>
				<div class="contenido">
					<form name="agregar_contenido" method="post"  enctype="multipart/form-data" action="../../src/php/cargarContenido.php">
						<div class="grupo">
							<label for="numero">Numero de Objetivo</label>
							<input id="numero" name="numero" type="number" placeholder="Numero de Objetivo">	
						</div>
						
						<div class="grupo">
							<label for="">Contenido</label>
							<textarea name="message" id="message" cols="20" rows="10" placeholder="Contenido"></textarea>
						</div>

						<div class="grupo_oculto">
                      		<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">

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
						


					<!-- SECCION DE AGREGAR ARCHIVOS -->

						<div class="grupo">
							<br>
							<br>
							<h3>Archivos</h3>
						</div>
						<div class="grupo">
							<div class="grupo">
								<label for="">Archivo 1</label>
								<input id="file1" name="file1" type="file">
							</div>
							<div class="grupo">
								<label for="">Archivo 2</label>
								<input id="file2" name="file2" type="file">
							</div>
							<div class="grupo">
								<label for="">Archivo 3</label>
								<input id="file3" name="file3" type="file">
							</div>
							<div class="grupo">
								<label for="">Archivo 4</label>
								<input id="file4" name="file4" type="file">
							</div>
						</div>

					<!-- /SECCION DE AGREGAR ARCHIVOS -->

						
						
						<a id="PreviewBoton" class="OpenModal OpenModalPreview" href="#OpenModal">Guardar</a>
					

					<!-- SECCION DE PREVIEW MODAL -->

						<div id="OpenModal" class="Modal PreviewModal">
		
								<section class="contenido preview">
									<div class="titulo">
										<div class="titulo_izq">
											<h4 id="PreviewNumero"></h4>
											
										</div>

									</div>
									<div class="contenido">
									 	<p id="PreviewContenido"></p>
									</div>
									
									<div class="grupo">
										<br>
										<br>
										<h4>Links</h4>
										
									</div>
									
									<div id="links">
										
									</div>
									

									<div class="grupo">
										<br>
										<br>
										<h4>Archivos</h4>
										
									</div>
									<div id="PreviewArchivos">
										
									</div>
									
									<div class="botones">
										<button id="btnSubmit" class="item" type="submit" disabled="disabled">Guardar</button>
										<a class="item close" href="#close" class="cerrar" >Cancelar</a>
									</div>
									
								</section>

						</div>

					<!-- /SECCION DE PREVIEW MODAL -->
						
					</form>
				</div>
			</section>
			<?php endif; ?>
		<!-- AGREGAR NUEVO CONTENIDO -->
		
		</main>

	</div>
	
		
	

	<footer>
		
	</footer>
	



	<!-- JS -->
	<script src="../../src/js/menu.js"></script>
	<script src="../../src/js/contenido.js"></script>
	<!-- /JS -->

</body>
</html>