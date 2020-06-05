<?php
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/blog.php');
	
	require_once('../Template/template.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link rel="icon" type="image/png" href="../../media/logo.png" />
	<title>IUTJMC - Blog</title>


	<!-- CUSTOM CSS -->
	<link rel="stylesheet" href="../../src/icon/icomoon/style.css">
	<link rel="stylesheet" href="../../src/css/blog.css">
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

			<?php TarjetaInformativa('BLOG'); ?>


			<?php if (empty($posts)): ?>
			<section>
				<div class="contenido">
					<p>Aun no se a cargado ninguna informacacion ni material de apoyo en el blog. </p>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
						<br>
						<p>Por favor alguna información o material de apoyo para la materia</p>
						<br>
						<p>* Deberá asignarle un título. </p>



					<?php endif ?>
		
				</div>
			</section>			
			<?php endif ?>


			<?php foreach ($posts as $post): ?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<h4><?= ucfirst($post[4]) ?></h4>
						<span><small><small>Fecha: <?= $post[2] ?></small></small></span>
					</div>

					<?php if ($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der">
						<div class="enlaces">
							<a title="Editar" href="#ModalEditar<?= $post[0] ?>"><span class="icon-pencil"></span></a>
							<a title="Eliminar" href="../../src/php/eliminarBlog.php?mat=<?= $prof ?>&blog=<?= $post[0] ?>"><span class="icon-bin"></span></a>
						</div>
					</div>
					<?php endif ?>
					
				</div>
				<div class="contenido">
					<p> <?= $post[3] ?> </p>






					<div class="trabajos">

						<?php if ($post[9] or $post[10] or $post[11] or $post[12]): ?>
						<br>
						<br>
						<h4>Links</h4>
						<br>
						<?php endif ?>

						<?php if ($post[9]): ?>
						<a href="<?= $post[13] ?>"><?= $post[9] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[10]): ?>
						<a href="<?= $post[14] ?>"><?= $post[10] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[11]): ?>
						<a href="<?= $post[15] ?>"><?= $post[11] ?></a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[12]): ?>
						<a href="<?= $post[16] ?>"><?= $post[12] ?></a>
						<br>
						<br>
						<?php endif ?>

					</div>










					
					<div class="trabajos">

						<?php if ($post[5] or $post[6] or $post[7] or $post[8]): ?>
						<br>
						<br>
						<h4>Descarga de Materiales</h4>
						<br>
						<?php endif ?>

						<?php if ($post[5]): ?>
						<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[5] ?>" download>Material 1</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[6]): ?>
						<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[6] ?>" download>Material 2</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[7]): ?>
						<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[7] ?>" download>Material 3</a>
						<br>
						<br>
						<?php endif ?>

						<?php if ($post[8]): ?>
						<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[8] ?>" download>Material 4</a>
						<br>
						<br>
						<?php endif ?>

					</div>



				<?php if ($_SESSION['user'] === 'profesor'): ?>
				<!-- MODAL EDITAR BLOG -->
					<div id="ModalEditar<?= $post[0] ?>" class="editar">
						

						<form  method="post" enctype="multipart/form-data" action="../../src/php/editarBlog.php">
							<div class="grupo">
								<label for="title">Titulo</label>
								<input name="title" id="title" type="text" placeholder="Titulo" value="<?= ucfirst($post[4]) ?>">
							</div>
							<div class="grupo">
								<textarea name="message" id="message" cols="30" rows="10" placeholder="Contenido"><?= $post[3] ?></textarea>
							</div>
		
							<div class="grupo_oculto">
								<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">
								<input type="text" name="post" value="<?= $post[0] ?>" style="display: none;">
							</div>








							<div class="grupo">
								<br>
								<br>
								<h3>Links</h3>	
							</div>
							<div class="grupo">
								<h4>Link 1</h4>
								<label for="nlink1">Nombre</label>
								<input name="nlink1"  type="text" placeholder="Nombre del link 1" value="<?= $post[9] ?>">
								<label for="link1">Link</label>
								<input name="link1" type="text" placeholder="Link 1" value="<?= $post[13] ?>">
							</div>
							
							<div class="grupo">
								<h4>Link 2</h4>
								
								<label for="nlink2">Nombre</label>
								<input name="nlink2" type="text" placeholder="Nombre del link 2" value="<?= $post[10] ?>">
								<label for="link2">Link</label>
								<input name="link2" type="text" placeholder="Link 2" value="<?= $post[14] ?>">
							</div>

							<div class="grupo">
								<h4>Link 3</h4>
								
								<label for="nlink3">Nombre</label>
								<input name="nlink3" type="text" placeholder="Nombre del link 3" value="<?= $post[11] ?>">
								<label for="link3">Link</label>
								<input name="link3" type="text" placeholder="Link 3" value="<?= $post[15] ?>">
							</div>

							<div class="grupo">
								<h4>Link 4</h4>
								
								<label for="nlink4">Nombre</label>
								<input name="nlink4" type="text" placeholder="Nombre del link 4" value="<?= $post[12] ?>">
								<label for="link4">Link</label>
								<input name="link4" type="text" placeholder="Link 4" value="<?= $post[16] ?>">
							</div>
							
							<div class="grupo">
								<br>
								<br>
								<h3>Archivos</h3>
							</div>










							<div class="grupo">
								<?php if ($post[5]): ?>
								<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[5] ?>" download>Material 1</a>
								<br>
								<?php else: ?>
								<p>Material 1 - SIN CARGAR</p>
								
								<?php endif ?>
								<input name="file1" type="file">
							</div>

							<div class="grupo">
								<?php if ($post[6]): ?>
								<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[6] ?>" download>Material 2</a>
								<br>
								<?php else: ?>
								<p>Material 2 - SIN CARGAR</p>
								
								<?php endif ?>
								<input name="file2" type="file">
							</div>

							<div class="grupo">
								<?php if ($post[7]): ?>
								<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[7] ?>" download>Material 3</a>
								<br>
								<?php else: ?>
								<p>Material 3 - SIN CARGAR</p>
								
								<?php endif ?>
								<input name="file3" type="file">
							</div>

							<div class="grupo">
								<?php if ($post[8]): ?>
								<a href="../../upload/blog/<?= $post[1]?>/<?= $post[0] ?>/<?= $post[8] ?>" download>Material 4</a>
								<br>
								<?php else: ?>
								<p>Material 4 - SIN CARGAR</p>
								
								<?php endif ?>
								<input name="file4" type="file">
							</div>
							
							




							
							<div class="botones">
								<button class="item" type="submit" >Guardar</button>
								<a class="item close" href="#close" class="cerrar" >Cancelar</a>
							</div>
							



						</form>				
												
							
					</div>
				<!-- /MODAL EDITAR BLOG -->
				<?php endif ?>






				</div>
			</section>	
			<?php endforeach; ?>
	

			<?php if ($_SESSION['user'] === 'profesor'): ?>
			<section class="section_agregar">
				<div class="titulo">
					<h3>Cargar contenido al blog</h3>
				</div>
				<div class="contenido">
					<form name="agregar_blog" method="post" enctype="multipart/form-data" action="../../src/php/blogPublicacion.php">
						<div class="grupo">
							<label for="title">Titulo</label>
							<input name="title" id="title" type="text" placeholder="Titulo">
						</div>
						<div class="grupo">
							<textarea name="message" id="message" cols="30" rows="10" placeholder="Contenido"></textarea>
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
							<br>
							<input name="link1" type="text" placeholder="Link 1">
						</div>
						
						<div class="grupo">
							<input name="nlink2" type="text" placeholder="Nombre del link 2">
							<br>
							<input name="link2" type="text" placeholder="Link 2">
						</div>

						<div class="grupo">
							<input name="nlink3" type="text" placeholder="Nombre del link 3">
							<br>
							<input name="link3" type="text" placeholder="Link 3">
						</div>

						<div class="grupo">
							<input name="nlink4" type="text" placeholder="Nombre del link 4">
							<br>
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
						
						




						<!-- PRUEBA -->
						<a class="OpenModal OpenModalPreview" href="#OpenPreviewModal">Guardar</a>

						<div id="OpenPreviewModal" class="PreviewModal">
		
			


						<section class="preview">
							<div class="titulo">
								<div class="titulo_izq">
									<h4 id="titulo_pre"></h4>
								</div>
							</div>
							<hr>
							<div class="contenido">
								<p id="descripcion_pre"></p>
								
								
							</div>
							<div class="botones">
								<button class="item" type="submit" >Guardar</button>
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
	<script src="../../src/js/blog.js"></script>
	<!-- /JS -->

</body>
</html>