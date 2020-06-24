<?php 
	require_once('../../src/php/sesiones.php');
    sesion();

    require_once('../../src/controller/foro.php');
    
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
	<title>IUTJMC - Foro</title>


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

			<?php TarjetaInformativa('FORO'); ?>

			

			<?php if (empty($posts)): ?>
			<section>
				<div class="contenido">
					<p>El chat del foro de la materia esta vacío. </p>
		
				</div>
			</section>			
			<?php endif ?>



			<?php foreach ($posts as $post): 
				if ($post[3] == 'alumno') {
				$nom = $myPDO->prepare("
				SELECT p_nombres, p_apellido from estudiante 
				WHERE id_estudia = $post[2]
				");
				$nom->execute();
				$nombre = $nom->fetch();

				} elseif($post[3] == 'profesor') {
				$nom = $myPDO->prepare("
				SELECT nombres from personal 
				WHERE id_personal = $post[2]
				");
				$nom->execute();
				$nombre = $nom->fetch();
				}
			?>
			<section class="plan_evaluacion">
				<div class="titulo">
					<div class="titulo_izq">
						<?php if ($post[3] == 'alumno'): ?>
						<h3><?= ucwords(strtolower($nombre[0]))." ".ucwords(strtolower($nombre[1])) ?></h3>
						<?php elseif ($post[3] == 'profesor'): ?>
						<h3><?= ucwords(strtolower($nombre[0])) ?></h3>
						<?php endif ?>
						<span><small>Fecha: <?= $post[4] ?></small></span>
					</div>

					<?php if($_SESSION['user'] == 'profesor'): ?>
					<div class="titulo_der">
						<div class="enlaces">
							<a href="../../src/php/eliminarForo.php?mat=<?= $prof ?>&foro=<?= $post[0] ?>"><span class="icon-bin"></span></a>
						</div>
					</div>
					<?php endif ?>

				</div>
				<div class="contenido">
					<p> <?= nl2br($post[5]) ?> </p>
				</div>
			</section>	
			<?php endforeach; ?>

			<section class="section_agregar">
				<div class="titulo">
					<h3>Cargar contenido al foro</h3>
				</div>
				<div class="contenido">
					<form name="agregar_foro" method="post" action="../../src/php/foroPublicacion.php">
						<div class="grupo">
							<textarea name="message" id="message" cols="30" rows="10" placeholder="Contenido foro"></textarea>
						</div>
						<div class="grupo_oculto">
							<input type="text" name="materia" value="<?= $prof ?>" style="display: none;">
                     		<input type="text" name="usuario" value="<?= $_SESSION['id'] ?>" style="display: none;">
                     		<input type="text" name="level" value="<?= $_SESSION['user'] ?>" style="display: none;">
						</div>
						<button type="submit">Guardar</button>
					</form>
				</div>
			</section>
		</main>

	</div>
	


	<footer>

	</footer>

	<!-- JS -->
	<script src="../../src/js/menu.js"></script>
	<!-- /JS -->

</body>
</html>