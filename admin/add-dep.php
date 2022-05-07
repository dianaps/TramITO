<?php
    session_start();

    if(isset($_SESSION['admin_id'])){
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Departamento</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
</head>

<body>
	<?php include "header-admin.php"; ?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Gesti&oacute;n de Departamento</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
            justify-content-center
            align-items-center">
            
        <div class="w-400 p-5 shadow rounded">
            <form method="post" 
                action="../app/http/insert-dep.php"
                enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                <img src="../img/logo.png" 
                    class="w-25">
                <h3 class="display-4 fs-1 
                        text-center">
                        Agregar Departamento</h3>   
                </div>

                <?php if (isset($_GET['error'])) {?>
                    <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php }
                    if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                
                <?php }
                    if (isset($_GET['department'])) {
                        $department = $_GET['department'];
                    }else $department = '';
    
                    if (isset($_GET['username'])) {
                        $username = $_GET['username'];
                    }else $username = '';

                    if (isset($_GET['password'])) {
                        $password = $_GET['password'];
                    }else $password = '';

                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                    }else $email = '';

                    if (isset($_GET['info'])) {
                        $info = $_GET['info'];
                    }else $info = '';

                    if (isset($_GET['boss'])) {
                        $boss = $_GET['boss'];
                    }else $boss = '';
                ?>

                <div class="mb-3">
                    <label class="form-label">
                        Usuario</label>
                    <input type="text"
                        value="<?=$username?>"
                        class="form-control"
                        name="username"
                        id="username">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Contraseña</label>
                    <input type="password"
                        value="<?=$password?>"
                        class="form-control"
                        name="password"
                        id="password">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo electrónico</label>
                    <input type="text"
                        class="form-control"
                        value="<?=$email?>"
                        name="email"
                        placeholder="ejemplo@dominio.com"
                        id="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Foto de perfil</label>
                    <input type="file"
                        class="form-control"
                        name="pp"
                        id="pp">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Departamento</label>
                    <input type="text"
                        id="department"
                        name="department"
                        value="<?=$department?>" 
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Informaci&oacute;n</label>
                    <textarea name="info"
                        class="form-control"
                        id="info"><?=$info?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Jefe de departamento</label>
                    <input type="text"
                        id="boss"
                        name="boss"
                        value="<?=$boss?>" 
                        class="form-control">
                </div>
            
                <button type="submit" 
                        class="btn btn-success">
                        Aceptar</button>
                <button type="button"
                    class="btn btn-danger"
                    id="cancel">
                    Cancelar</button>
            </form>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $("#cancel").on('click', function () {
			$("#username").val('');
            $("#password").val('');
            $("#email").val('');
            $("#pp").val('');
			$("#department").val('');
            $("#info").val('');
            $("#boss").val('');
        });
    });
</script>
</body>
</html>
<?php
    }else{
        header("Location: ../index.php");
        exit;
    }
?>