<?php
session_start();

# Arreglo de las carreras
$careers = array('Ingeniería Eléctrica', 'Ingeniería Electrónica',
				 'Ingeniería en Gestión Empresarial', 'Ingeniería Industrial',
				 'Ingeniería Informática', 'Ingeniería Mecánica',
				 'Ingeniería Química', 'Ingeniería en Sistemas Computacionales');

if (!isset($_SESSION['username'])) {
 ?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Registrarse</title>
</head>

<body class="d-flex
             justify-content-center
             align-items-center">
	 <div class="w-responsive p-5 shadow rounded">
	 	<form method="post"
	 	      action="app/http/signup.php"
	 	      enctype="multipart/form-data">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png"
	 		     class="w-25">
	 		<h3 class="display-4 fs-1
	 		           text-center">
	 			       Registrarse</h3>
	 		</div>

	 		<?php if (isset($_GET['error'])) {?>
	 			<div class="alert alert-warning" role="alert">
			<?php echo htmlspecialchars($_GET['error']); ?>
				</div>
			<?php }
				if (isset($_GET['name'])) {
					$name = $_GET['name'];
				} else { $name = ''; }

				if (isset($_GET['last_name'])) {
					$last_name = $_GET['last_name'];
				} else { $last_name = ''; }

				if (isset($_GET['username'])) {
					$username = $_GET['username'];
				} else { $username = ''; }

				if (isset($_GET['career'])) {
					$career = $_GET['career'];
				} else { $career = ''; }

				if (isset($_GET['semester'])) {
					$semester = $_GET['semester'];
				} else { $semester = ''; }

				if (isset($_GET['email'])) {
					$email = $_GET['email'];
				} else { $email = ''; }
			?>

	 	  <div class="mb-3">
		    <label class="form-label">
		           Nombre(s)</label>
		    <input type="text"
		           name="name"
		           value="<?=$name?>"
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Apellidos</label>
		    <input type="text"
		           name="last_name"
		           value="<?=$last_name?>"
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           N&uacute;mero de control</label>
		    <input type="text"
		           class="form-control"
		           value="<?=$username?>"
		           name="username"
				   maxlength="8";
				   title="El número de control contiene 8 dígitos">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Carrera</label>
			<select class="form-control" name="career">
				<option value="">Selecciona una carrera...</option>
				<?php
					foreach ($careers as $car){
						if($career == $car)
							echo '<option value= "' . $car .'" selected>'. $car . '</option>';
						else
							echo '<option value= "' . $car .'">'. $car . '</option>';
					}
				?>
			</select>

		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Semestre</label>

			<select class="form-control" name="semester">
				<option value="">Selecciona un semestre...</option>
				<?php
					for ($i = 1; $i <= 12; $i++){
						if($semester == $i)
							echo '<option value="'. $i . '" selected>'. $i . '</option>';
						else
							echo '<option value="'. $i . '">'. $i . '</option>';
					}
				?>
			</select>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Correo electrónico</label>
		    <input type="text"
		           class="form-control"
		           value="<?=$email?>"
		           name="email"
				   placeholder="ejemplo@dominio.com">
		  </div>


		  <div class="mb-3">
		    <label class="form-label">
		           Contraseña</label>
		    <input type="password"
		           class="form-control"
		           name="password">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Foto de perfil</label>
		    <input type="file"
		           class="form-control"
		           name="pp">
		  </div>

		  <button type="submit"
		          class="btn btn-primary">
		          Registrarse</button>
		  <a href="index.php">Iniciar sesión</a>
		</form>
	 </div>
</body>
</html>
<?php
} else {
 header("Location: home.php");
 exit;
}
?>