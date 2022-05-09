<?php
header("Content-Type: text&html;charset=utf-8");

session_start();

if (isset($_SESSION['user_id'])) {

 include 'app/helpers/user.php';
 # Realizando la conexión con la BD
 include 'app/db.conn.php';

 $user = getUser($_SESSION['user_id'], $_SESSION['role'], $conn);

 ?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Mi Perfil</title>
</head>

<body>
    <!-- Modal -->
<form method="post"
    action="app/http/upd-img.php"
    enctype="multipart/form-data">
    <div
    class="modal fade"
    id="updateProfilePictureModal"
    aria-hidden="true"
    data-bs-backdrop="static"
    >
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfilePictureModalScrollableTitle">
                    Foto de perfil
                    </h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <!-- Body form file chooser -->

                <div class="modal-body">
                    <input type="file" class="form-control" name="pp">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                <!-- Body form file chooser -->
            </div>
        </div>
    </div>
</form>

	<?php include "sections/header.php";?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Mi Perfil</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
             justify-content-center
             align-items-center">
        <div class="w-responsive p-5 shadow rounded">
            <form method="post"
                action="app/http/upd-pass-admin.php"
                enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

            <!-- ALERTA -->
            <?php if (isset($_GET['error'])) {?>
	 			<div class="alert alert-warning" role="alert">
			<?php echo htmlspecialchars($_GET['error']); ?>
				</div>
			<?php }if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php }?>

                <!-- INFORMACIÓN PERSONAL -->
                <div class="mb-3">
					<h3 class="display-4 fs-1
					text-center">
					Informaci&oacute;n Personal</h3>

                    <div id="updateProfilePicture" class="mb-3 text-center">
                        <!-- <label class="form-label">
                            Foto de perfil</label> -->
                        <img class="profile-picture" src="uploads/<?=$user['p_p']?>" alt="">
                        <button type="button"
                            class="profile-picture btn btn-link"
                            data-bs-toggle="modal"
                            data-bs-target="#updateProfilePictureModal">
                            <span class="fa fa-upload"></span>
                        </button>
                    </div>

					<!-- Si es estudiante... -->
					<?php if ($_SESSION['role'] === 'student' && $user['role'] === 'student') {?>
                    <label class="form-label">
                        <dt>Nombre:</dt>
						<p class="text-muted"><?php echo $user['name'] . " " . $user['last_name'] ?></p>
					</label><br>

                    <label class="form-label">
						<dt>N&uacute;mero de control:</dt><p class="text-muted"><?=$user['username']?></p>
					</label><br>

                    <label class="form-label">
						<dt>Email:</dt><p class="text-muted"><?=$user['email']?></p>
					</label><br>

					<label class="form-label">
						<dt>Carrera:</dt><p class="text-muted"><?=$user['career']?></p>
					</label><br>

					<label class="form-label">
						<dt>Semestre:</dt><p class="text-muted"><?=$user['semester']?></p>
					</label>

					<!-- Si es departamento... -->
					<?php } else if ($_SESSION['role'] === 'department' && $user['role'] === 'department') {?>
						<label class="form-label">
                        <dt>Departamento:</dt>
						<p class="text-muted"><?=$user['department_name']?></p>
					</label><br>

                    <label class="form-label">
						<dt>Nombre de usuario:</dt><p class="text-muted"><?=$user['username']?></p>
					</label><br>

                    <label class="form-label">
						<dt>Email:</dt><p class="text-muted"><?=$user['email']?></p>
					</label><br>

					<label class="form-label">
						<dt>Descripci&oacute;n:</dt><p class="text-muted"><?=$user['info']?></p>
					</label><br>

					<label class="form-label">
						<dt>Jefe de departamento:</dt><p class="text-muted"><?=$user['department_head']?></p>
					</label>

					<?php
}
 ?>
<div class="mb-3">
                        <a href="update-info.php"
                            class="btn btn-primary">Actualizar informaci&oacute;n</a>
                    </div>
                    <div class="mb-3">
                        <a href="update-password.php"
                         class="btn btn-primary">Actualizar contrase&ntilde;a</a>
                    </div>
                </div>
        </div>
    </div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
<?php } else {
 header("Location: home.php");
 exit;
}
?>