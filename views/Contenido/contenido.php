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

	<link rel="icon" type="image/png" href="../../media/logo.png" />
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
				 	<p> <?= ucfirst($contenido[3]) ?> </p>


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

				<?php if ($_SESSION['user'] === 'profesor'): ?>
				<!-- MODAL EDITAR CONTENIDO -->
					<div id="ModalEditar<?= $contenido[0] ?>" class="editar">
						<form name="agregar_contenido" method="post"  enctype="multipart/form-data" action="../../src/php/editarContenido.php">
							<div class="grupo">
								<label for="numero">Numero de Objetivo</label>
								<input id="numero" name="numero" type="number" placeholder="Numero de Objetivo" value="<?= $contenido[2] ?>">	
							</div>
							
							<div class="grupo">
								<textarea name="message" id="message" cols="20" rows="10" placeholder="Contenido"><?= ucfirst($contenido[3]) ?></textarea>
							</div>

							<div class="grupo_oculto">
	                      		<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">
	                      		<input type="text" name="id" value="<?= $contenido[0] ?>" style="display: none;">

	                    	</div>
							

							<div class="grupo">
								<br>
								<br>
								<h3>LINKS</h3>	
							</div>
							<div class="grupo">
								<h4>Link 1</h4>
								<label for="nlink1">Nombre</label>
								<input name="nlink1"  type="text" placeholder="Nombre del link 1" value="<?= $contenido[8] ?>">
								<label for="link1">Link</label>
								<input name="link1" type="text" placeholder="Link 1" value="<?= $contenido[12] ?>">
							</div>
							
							<div class="grupo">
								<h4>Link 2</h4>
								
								<label for="nlink2">Nombre</label>
								<input name="nlink2" type="text" placeholder="Nombre del link 2" value="<?= $contenido[9] ?>">
								<label for="link2">Link</label>
								<input name="link2" type="text" placeholder="Link 2" value="<?= $contenido[13] ?>">
							</div>

							<div class="grupo">
								<h4>Link 3</h4>
								
								<label for="nlink3">Nombre</label>
								<input name="nlink3" type="text" placeholder="Nombre del link 3" value="<?= $contenido[10] ?>">
								<label for="link3">Link</label>
								<input name="link3" type="text" placeholder="Link 3" value="<?= $contenido[14] ?>">
							</div>

							<div class="grupo">
								<h4>Link 4</h4>
								
								<label for="nlink4">Nombre</label>
								<input name="nlink4" type="text" placeholder="Nombre del link 4" value="<?= $contenido[11] ?>">
								<label for="link4">Link</label>
								<input name="link4" type="text" placeholder="Link 4" value="<?= $contenido[15] ?>">
							</div>
							
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

							
							
						
							<div class="botones">
								<button class="item" type="submit" >Guardar</button>
								<a class="item close" href="#close" class="cerrar" >Cancelar</a>
							</div>
										
									
							
						</form>		
						
							
					</div>
				<!-- /MODAL EDITAR CONTENIDO-->
				<?php endif ?>


				</div>

			</section>
			<?php endforeach ?>


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
							<textarea name="message" id="message" cols="20" rows="10" placeholder="Contenido"></textarea>
						</div>

						<div class="grupo_oculto">
                      		<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">

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
							<p>Aparecerá de esta manera a los alumnos <a href="https://iutjmc">Pagina Web del Instituto</a></p>	
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

						
						
						<a class="OpenModal OpenModalPreview" href="#OpenModal">Guardar</a>

						<div id="OpenModal" class="Modal">
		
								<section class="contenido preview">
									<div class="titulo">
										<div class="titulo_izq">
											<h4 id="PreviewNumero"></h4>
											
										</div>

									</div>
									<div class="contenido">
									 	<p id="PreviewContenido"></p>
									</div>
									
									<div class="botones">
										<button class="item" type="submit" >Guardar</button>
										<a class="item close" href="#close" class="cerrar" >Cancelar</a>
									</div>
									
								</section>

						</div>
						
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
	<script src="../../src/js/contenido.js"></script>
	<!-- /JS -->

</body>
</html>