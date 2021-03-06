<?php
header("Content-Type: text&html;charset=utf-8");

session_start();

if (isset($_SESSION['username'])) {

 # Realizando la conexión hacia la BD
 include 'app/db.conn.php';

 include 'app/helpers/user.php';

 $user = getUser($_SESSION['user_id'], $_SESSION['role'], $conn);

 ?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Actualizar información</title>
</head>
<body class="">

	<?php include "sections/header.php"?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Actualizar Informaci&oacute;n</h1>
	</div>
	<!-- Encabezado -->

	<div class="d-flex
             justify-content-center
             align-items-center">
        <div class="w-responsive p-5 shadow rounded">

        <form method="post"
                action="app/http/upd-info.php"
                enctype="multipart/form-data">
                <div class="d-flex
                    justify-content-center
                    align-items-center
                    flex-column">

                <img src="img/logo-buho.png"
                     class="w-25">
                </div>

                <!-- Mensaje de error -->
                <?php if (isset($_GET['error'])) {?>
	 		        <div class="alert alert-warning" role="alert">
			    <?php echo htmlspecialchars($_GET['error']); ?>
			        </div>

                <!-- Mensaje de éxito -->
			    <?php }if (isset($_GET['success'])) {?>
	 		        <div class="alert alert-success" role="alert">
			    <?php echo htmlspecialchars($_GET['success']); ?>
			        </div>
			    <?php }?>

            <?php if ($_SESSION['role'] == 'student') {

  # Obteniendo toda la información del estudiante
  //   $ncontrol = $user['username'];
  //   $career     = $user['career'];
  $name      = $user['name'];
  $last_name = $user['last_name'];
  $email     = $user['email'];
  $semester  = $user['semester'];
  ?>


                <div class="mb-3">
                    <label class="form-label">
                        Nombre(s) </label>
                    <input type="text"
                        class="form-control"
                        name="name"
                        id="name"
                        value="<?=$name?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Apellidos </label>
                    <input type="text"
                        class="form-control"
                        name="last_name"
                        id="last_name"
                        value="<?=$last_name?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo electrónico</label>
                    <input type="email"
                        class="form-control"
                        name="email"
                        id="email"
                        value="<?=$email?>">
                </div>
                <div class="mb-3">
                    <select class="form-control" name="semester">
				        <option value="">Selecciona un semestre...</option>
                        <?php
for ($i = 1; $i <= 12; $i++) {
   if ($semester == $i) {
    echo '<option value="' . $i . '" selected>' . $i . '</option>';
   } else {
    echo '<option value="' . $i . '">' . $i . '</option>';
   }

  }
  ?>
			        </select>
                </div>
                <?php }?>

            <?php if ($_SESSION['role'] == 'department') {

  # Obteniendo toda la información del departamento
  $username        = $user['username'];
  $email           = $user['email'];
  $department_name = $user['department_name'];
  $info            = $user['info'];
  $boss            = $user['department_head'];
  ?>
  <div class="mb-3">
                        <label class="form-label">
                            Usuario</label>
                        <input type="text"
                            class="form-control"
                            name="username"
                            id="username"
                            value="<?=$user['username']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Correo electrónico</label>
                        <input type="email"
                            class="form-control"
                            name="email-dep"
                            id="email-dep"
                            value="<?=$user['email']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Departamento</label>
                        <input type="text"
                            id="department"
                            name="department"
                            class="form-control"
                            value="<?=$user['department_name']?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Informaci&oacute;n</label>
                        <textarea name="info"
                            class="form-control"
                            id="info"><?=$user['info']?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Jefe de departamento</label>
                        <input type="text"
                            id="boss"
                            name="boss"
                            class="form-control"
                            value="<?=$user['department_head']?>">
                    </div>
<?php
}
 ?>
                <button type="submit"
                    id="update"
                    class="btn btn-primary">
                    Actualizar</button>
                <a href="profile.php">Cancelar</a>
            </form>
		</div>
    </div>
</body>
</html>
<?php
} else {
 header("Location: index.php");
 exit;
}
?>