<?php
    session_start();

    if(isset($_SESSION['admin_id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Agregar Admin</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<?php include "header-admin.php"; ?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Gesti&oacute;n del Administrador</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
             justify-content-center
             align-items-center">
        <div class="w-400 p-5 shadow rounded">
            <form method="post" 
                action="../app/http/insert-admin.php"
                enctype="multipart/form-data">
                <div class="d-flex
                    justify-content-center
                    align-items-center
                    flex-column">

                <img src="../img/logo.png" 
                    class="w-25">
                <h3 class="display-4 fs-1 
                        text-center">
                        Agregar Administrador</h3>   
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
                    if (isset($_GET['name'])) {
                        $name = $_GET['name'];
                    }else $name = '';
    
                    if (isset($_GET['username'])) {
                        $username = $_GET['username'];
                    }else $username = '';

                    if (isset($_GET['password'])) {
                        $password = $_GET['password'];
                    }else $password = '';

                    if (isset($_GET['email'])) {
                        $email = $_GET['email'];
                    }else $email = '';
                ?>

                <div class="mb-3">
                    <label class="form-label">
                        Nombre</label>
                    <input type="text"
                        name="name"
                        value="<?=$name?>" 
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Usuario</label>
                    <input type="text"
                        name="username"
                        value="<?=$username?>" 
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Contraseña</label>
                    <input type="password"
                        name="password"
                        value="<?=$password?>" 
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo</label>
                    <input type="text"
                        name="email"
                        value="<?=$email?>" 
                        class="form-control"
                        placeholder="ejemplo@dominio.com">
                </div>
                
                <button type="submit" 
                        class="btn btn-success">
                        Aceptar</button>
                <a href="#">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }else{
        header("Location: ../index.php");
        exit;
    }
?>