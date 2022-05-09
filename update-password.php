<?php
header("Content-Type: text&html;charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Actualizar contraseña</title>
</head>

<body>
	<?php include "sections/header.php";?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Mi Perfil</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
        justify-content-center
        align-items-center
        vh-100">
        <div class="w-responsive p-5 shadow rounded">
            <form method="post"
                action="app/http/upd-pass.php"
                enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                <img src="img/logo-buho.png"
                    class="w-25">
                <h3 class="display-4 fs-1
                        text-center">
                        Actualizar Contraseña</h3>
                </div>

                <?php if (isset($_GET['error'])) {?>
                    <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php }if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>

                <?php }if (isset($_GET['current_password'])) {
 $current_password = $_GET['current_password'];
} else {
 $current_password = '';
}

if (isset($_GET['new_password'])) {
 $new_password = $_GET['new_password'];
} else {
 $new_password = '';
}

if (isset($_GET['conf_password'])) {
 $conf_password = $_GET['conf_password'];
} else {
 $conf_password = '';
}
?>

                <div class="mb-3">
                    <label class="form-label">
                        Contraseña actual</label>
                    <input type="password"
                        name="act-pass"
                        value="<?=$current_password?>"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Nueva contraseña</label>
                    <input type="password"
                        class="form-control"
                        value="<?=$new_password?>"
                        name="new-pass">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Confirma tu contraseña</label>
                    <input type="password"
                        class="form-control"
                        value="<?=$conf_password?>"
                        name="conf-pass">
                </div>

                <button type="submit"
                        class="btn btn-primary">
                        Confirmar</button>
                <a href="profile.php">Cancelar</a>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>