<?php
session_start();

if (!isset($_SESSION['username'])) {
 ?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Login </title>
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">

	 <div class="login-image"></div>
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post"
	 	      action="app/http/auth.php">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

				<img src="img/logo-100.png"
					class="img-fluid">
				<h3 class="display-4 fs-1
						text-center">
						Login</h3>


	 		</div>
	 		<?php if (isset($_GET['error'])) {?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']); ?>
			</div>
			<?php }?>

	 		<?php if (isset($_GET['success'])) {?>
	 		<div class="alert alert-success" role="alert">
			  <?php echo htmlspecialchars($_GET['success']); ?>
			</div>
			<?php }?>
		  <div class="mb-3">
		    <label class="form-label">
		           Nombre de usuario</label>
		    <input type="text"
		           class="form-control"
		           name="username">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Contraseña</label>
		    <input type="password"
		           class="form-control"
		           name="password">
		  </div>

		  <button type="submit"
		          class="btn btn-primary">
		          Iniciar sesión</button>
		  <a href="signup.php">Sign Up</a>
		</form>
		<br>
		<a href="restore-password.php">¿Olvidó su contraseña?</a>
		<br><br>
		<a href="index-admin.php">¿Eres administrador?</a>
	 </div>
</body>
</html>
<?php
} else {
 header("Location: home.php");
 exit;
}
?>