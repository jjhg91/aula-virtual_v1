<?php 
	
	require_once('../../src/controller/asignatura.php');
	
	require_once('../../src/controller/navbar.php');


?>

<?php function Loader(){ ?>
	<!-- LOADER
	PANTALLA PARA MOSTRAR HASTA QUE CARGUE LA PAGINA -->
	<div class="loader">
		<img src="../../media/logo.png" alt="" width="200px">
		<span>Cargando...</span>
	</div>
	<!-- /LOADER -->
<?php } ?>

<?php function Headerr(){ ?>
	<!-- HEADER
	BARRA SUPERIOR DE TITULO ESTA TIENE 
	EL BOTON DEL NAV, EL NOMBRE Y EL BOTON SALIR -->
	<header>
		<div class="padre">
			
			<button class="menuPadre"><span class="icon-menu"></span></button>
				
			
			
			<div>

				<h4 class="grande">Instituto Universitario de Tecnología José María Carreño</h4>
				<h4 class="chico">IUTJMC</h4>
			</div>
			
			<a href="../../src/php/logout.php">SALIR</a>
		</div>
	</header>
	<!-- /HEADER -->
<?php } ?>

<?php function Navbar(){ 
	global $resul; 

	?>
	<!-- NAV
	MUESTRA LOS DATOS DEL USUARIO Y MENU DE
	MATERIAS INSCRITAS DONDE -->
	<nav class="nav_oculto">

		<!-- DATOS PERSONALES DEL USUARIO
		FOTO, NOMBRE, PERIODO CURSANDO -->
		<div class="datos_personales">

			<!-- prueba -->
			<?php if($_SESSION['genero'] == 1): ?>
			<img src="../../media/h.png" alt="..." >
			<?php else: ?>
			<img src="../../media/m.png" alt="..." >
			<?php endif; ?>
			<!-- prueba -->

			<!-- <img src="../../media/user.jpg" alt=""> -->

			<h4><?= ucwords(strtolower($_SESSION['nombre'])); ?></h4>
			
			<?php if ($_SESSION['user'] === 'alumno'): ?>
				<span><small>Alumno</small></span>
			<?php else: ?>
				<span><small>Profesor</small></span>
			<?php endif; ?>	
				
			
			<span><small>2020-2</small></span>	
		</div>
		<!-- /DATOS PERSONALES DEL USUARIO -->
		
		<hr>

		<!-- MENU 
		MUESTRA LOS MENU DE INICIO Y DE CADA MATERIA -->
		<div class="menu">
			<ul>				
				<li class="submenu">
					<a href="../Inicio/inicio.php">Inicio</a>
				</li>


				<?php foreach ($resul as $row): ?>
				<li class="submenu">

					<?php if(!empty($_GET['mat']) and $_GET['mat'] == $row[2] ): ?>
						<a class="aqui active">
					<?php else: ?>
						<a class="aqui">
					<?php endif ?>

					<!-- <a class="aqui"> -->
						<div>
							<span><?= $row[0] ?></span><br>
							<span class="carrera"><small><?= $row[3] ?></small></span>
						</div>
						
					</a>

					<?php if(!empty($_GET['mat']) and $_GET['mat'] == $row[2] ): ?>
						<ul class="children open">
					<?php else: ?>
						<ul class="children">
					<?php endif ?>

					<!-- <ul class="children"> -->
						<li>
							<a href="../Contenido/contenido.php?mat=<?= $row[2] ?>">Contenido</a>
						</li>
						<li>
							<a href="../PlanEvaluacion/planEvaluacion.php?mat=<?= $row[2] ?>">Plan Evaluacion</a>
						</li>
						<li>
							<a href="../Evaluaciones/evaluaciones.php?mat=<?= $row[2] ?>">Evaluaciones</a>
						</li>
						<li>
							<a href="../Blog/blog.php?mat=<?= $row[2] ?>">Blog</a>
						</li>
						<li>
							<a href="../Foro/foro.php?mat=<?= $row[2] ?>">Foro</a>
						</li>
					
						<?php if ($_SESSION['user'] === 'profesor'): ?>
						<li>
							<a href="../Alumnos/alumnos.php?mat=<?= $row[2] ?>">Alumnos</a>
						</li>
						<li>
							<a href="../CargarNota/cargarNota.php?mat=<?= $row[2] ?>">Cargar Nota</a>
						</li>
						<?php endif; ?>
					
					</ul>
				</li>
				<?php endforeach; ?>





			</ul>
		</div>
		<!-- /MENU -->	
			
	</nav>
	<!-- /NAV -->
<?php } ?>

<?php function TarjetaInformativa($titulo){ 
	global $resul2;
	?>
	<!-- SECTION 
	TARJETA INFORMATIVA NOMRE DE LA PAGINA 
	NOMRES DE LA CARRERA, MATERIA, PROFESOR Y PERIODO -->
	<section class="tarjeta_informacion">
		<hgroup class="hgroup_izq"	>
			<h4>Carrera: <?= $resul2[4] ?></h4>
			<h4>Materia: <?= $resul2[0] ?></h4>
			<h4>Profesor: <?= $resul2[3] ?></h4>
			<h4>Periodo: 2020-2</h4>
		</hgroup>
			
		<hgroup class="hgroup_der">
			<h3><?= $titulo ?></h3>
		</hgroup>
		
	</section>
	<!-- /SECTION -->
<?php } ?>