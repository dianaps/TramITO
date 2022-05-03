<?php
    session_start();

    if (isset($_SESSION['username'])) {
        
        # Realizando la conexión con la BD
        include 'app/db.conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Perfil</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo-buho.png">
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
        align-items-center">
        <div class="w-400 p-5 shadow rounded">
                <div class="d-flex
                    justify-content-center
                    align-items-center
                    flex-column">

                    <img src="img/logo-buho.png" class="w-25">

                    <!-- INFORMACIÓN PERSONAL -->
                    <div class="mb-3">
                        <h3 class="display-4 fs-1
                            text-center">
                            Informaci&oacute;n Personal</h3>
                    <?php
                        if($_SESSION['role'] == 'department'){

                            /* Preparando la consulta y ejecutándola */
                            $sql = "SELECT * FROM departments
                                    INNER JOIN users ON departments.user_id = users.user_id
                                    WHERE departments.user_id = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$_SESSION['user_id']]);

                            $department = $stmt->fetch();
                    ?>

                    <label class="form-label">
                        <dt>Username</dt><p class="text-muted"><?=$department['username']?></p></label><br>

                    <label class="form-label">
                        <dt>Email</dt><p class="text-muted"><?=$department['email']?></p></label><br>

                    <label class="form-label">
                        <dt>Departamento</dt><p class="text-muted"><?=$department['department_name']?></p></label><br>

                    <label class="form-label">
                        <dt>Informaci&oacute;n</dt><p class="text-muted"><?=$department['info']?></p></label><br>

                    <label class="form-label">
                        <dt>Jefe de Departamento</dt><p class="text-muted"><?=$department['department_head']?></p></label>
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

                <?php if (isset($_GET['error'])) {?>
                    <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } ?>
        </div>
    </div>
</body>
</html>
<?php } else {
        header("Location: home.php");
        exit;
    }
?>