<?php
    session_start();

    if (isset($_SESSION['admin_id'])) {
        
        # Realizando la conexión con la BD
        include '../app/db.conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
</head>

<body>
	<?php include "header-admin.php";?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Mi Perfil</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
             justify-content-center
             align-items-center">
        <div class="w-400 p-5 shadow rounded">
            <form method="post"
                action="../app/http/upd-pass-admin.php"
                enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                <!-- INFORMACIÓN PERSONAL -->
                <div class="mb-3">
                    <h3 class="display-4 fs-1
                        text-center">
                        Informaci&oacute;n Personal</h3>
                    <?php
                        /* Preparando la consulta y ejecutándola */
                        $sql = "SELECT name, username, email
                                FROM admins
                                WHERE admin_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$_SESSION['admin_id']]);

                        $admin = $stmt->fetch();
                    ?>
                    <label class="form-label">
                        <dt>Nombre:</dt><p class="text-muted"><?php echo $admin['name']?></p></label><br>

                    <label class="form-label">
                        <dt>Username:</dt><p class="text-muted"><?php echo $admin['username']?></p></label><br>

                    <label class="form-label">
                        <dt>Email:</dt><p class="text-muted"><?php echo $admin['email']?></p></label>
                </div>

                <h3 class="display-4 fs-1
                        text-center">
                        Actualizar Contrase&ntilde;a</h3>
                </div>

                <?php if (isset($_GET['error'])) {?>
                    <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } if (isset($_GET['current_password'])) {
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
                    Contrase&ntilde;a actual</label>
                <input type="password"
                    name="act-pass"
                    value="<?=$current_password?>"
                    class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Nueva contrase&ntilde;a</label>
                <input type="password"
                    class="form-control"
                    value="<?=$new_password?>"
                    name="new-pass">
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Confirma tu contrase&ntilde;a</label>
                <input type="password"
                    class="form-control"
                    value="<?=$conf_password?>"
                    name="conf-pass">
            </div>

            <button type="submit"
                    class="btn btn-primary">
                    Confirmar</button>
            <a href="#">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php } else {
        header("Location: home-admin.php");
        exit;
    }
?>