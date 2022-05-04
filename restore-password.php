<?php
session_start();

if (!isset($_SESSION['username'])) {
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Restaurar Contraseña</title>
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post"
	 	      action="app/http/recover.php">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png"
	 		     class="w-25">
	 		<h3 class="display-4 fs-1
	 		           text-center">
	 			       Recuperar Contraseña</h3>
	 		</div>

	 		<?php if (isset($_GET['error'])) {?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']); ?>
			</div>
			<?php }

 if (isset($_GET['username'])) {
  $username = $_GET['username'];
 } else {
  $username = '';
 }

 if (isset($_GET['email'])) {
  $email = $_GET['email'];
 } else {
  $email = '';
 }

 ?>

            <div class="mb-3">
		        <label class="form-label">Necesitamos comprobar tu identidad. Ingresa tu nombre de usuario
                    y correo electrónico para obtener una contraseña temporal. Recomendamos actualizar tu
                    contraseña.
                </label>
		    </div>

	 	  <div class="mb-3">
		    <label class="form-label">
		           User name</label>
		    <input type="text"
		           name="username"
		           value="<?=$username?>"
		           class="form-control">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Email</label>
		    <input type="text"
		           class="form-control"
		           value="<?=$email?>"
		           name="email">
		  </div>

		  <button type="submit"
		          class="btn btn-primary">
		          Enviar</button>
		  <a href="index.php">Login</a>
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