<?php
	session_start();

	if (!isset($_SESSION['admin_id'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Login Admin </title>
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post"
	 	      action="app/http/auth-admin.php">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png"
	 		     class="w-25">
	 		<h3 class="display-4 fs-1
	 		           text-center">
	 			       Login Administrador</h3>

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
		           Username</label>
		    <input type="text"
		           class="form-control"
		           name="username-admin">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Password</label>
		    <input type="password"
		           class="form-control"
		           name="password-admin">
		  </div>

		  <button type="submit"
		          class="btn btn-primary">
		          Login</button>
		  <a href="index.php">Inicio</a>
		</form>
	 </div>
</body>
</html>
<?php
} else { /* Esta 'Location' debe ser modificada cuando se cuente con un home-admin.php */
 	header("Location: admin/add-qa.php");
 	exit;
}
?>