<!DOCTYPE html>
<html lang="es-MX">
<head>
    <?php include "sections/head-tags.php"?>
    <title>TramITO - Contacto</title>
</head>
<body>
    <?php include "sections/header.php"?>
    <!-- Jumbotron -->
	<div class="p-5"  style="text-align: center;background-color: #66BFBF">
		<h1 class="mb-3" style="background-color: #66BFBF;">Sobre TramITO</h1>
		</div>

		<div class="middle-container">

		<h5 class="p-4 shadow p-4 mb-5 bg-info rounded" style="text-align: justify;">TramITO fue propuesto por 5
			 estudiantes de la carrera de Ing. Sistemas Computacionales, la propuesta surge de una actividad en la materia
			 de taller de investigación sobre encontrar una problemática en nuestro entorno, con el propósito de crear
			 un sistema con el cual se reduciera el tiempo de espera de los trámites administrativos de los alumnos
			 del Instituto Tecnológico de Orizaba. El mes de marzo fue facilitado este espacio para mostrar TramITO
			 ya que representa una ventaja para el personal administrativo de la institución, por lo tanto las solicitudes
			 emitidas por los estudiantes serían reducidas y así se podría tener un mejor control de la información.</h5>

	<div class="v">
	<video class= "ratio ratio-4x3" controls muted autoplay preload="auto">
        <source src="img/presentacion.mp4">
	</video>
	</div>

	<div class="v1 abs-center">
	<form class=" shadow p-4 rounded"  action="mailto:grupotramito@gmail.com" id="form" method='POST' enctype="text/plain">
	<div class="col1">
		<label for="nombre" class="form-label">Nombre de usuario:</label>
		<input type="text" class="form-control" name="Nombre" id="Nombre" maxlength="30" placeholder="ej: Maria Rosales" pattern="[A-Z a-z]{3,30}" required></input>
		</div>
		<br>
		<div class="col2">
		<label for="email">Email:</label>
		<input type="email" class="form-control" name="Email" id="Email" placeholder="ej: mariajuarez98@gmail.com" required></input>
		</div>
		<br>
		<div class="col3">
		<label for="comentario" class="form-label">Sugerencias de mejora:</label>
		<textarea type="textarea" class="form-control" name="Consejo" id="Consejo" rows="6" cols="30"  placeholder="Deja un comentario aquí..." pattern="[A-Z a-z]" required></textarea>
		</div>
	<br>
	<div class="col4">
		<button class="btn btn-primary" type="submit" value="enviar">Enviar</button>
	</div>
</form>
</div>
</div>
	<!-- Jumbotron -->
	<?php include "sections/footer.php"?>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
