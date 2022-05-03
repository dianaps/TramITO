<?php
session_start();

if (!isset($_SESSION['username'])) {
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Login </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet"
	      href="css/style.css">
	<link rel="icon" href="img/logo-buho.png">
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