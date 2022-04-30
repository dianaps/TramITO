<?php
    session_start();

    if(isset($_SESSION['admin_id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Departamento</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="">

	<?php include "header-admin.php"?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Gesti&oacute;n de Departamento</h1>
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

					<img src="../img/logo.png" 
						class="w-25">

					<div class="input-group mb-3">
                        <input type="text"
                            placeholder="Buscar..."
                            id="searchText"
                            class="form-control">
                        <button class="btn btn-primary"
                            id="btn-search">
                            <i class="fa fa-search"></i>
                        </button>
					</div>
				</div>

                <!-- Mensaje de error -->
                <div id="error" class="alert alert-warning" role="alert"></div>

				<!-- Mensaje de éxito -->
                <div id="success" class="alert alert-success" role="alert"></div>

                <!-- Esto se oculta para mostrar obtener id -->
				<div id="div-id" class="mb-3">
					<label class="form-label">
						ID Dep</label>
					<input type="text"
						name="id-dep"
						class="form-control"
						id="id-dep">
				</div>

                <div class="mb-3">
                    <label class="form-label">
                        Usuario</label>
                    <input type="text"
                        class="form-control"
                        name="username"
                        id="username">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo electrónico</label>
                    <input type="email"
                        class="form-control"
                        name="email"
                        id="email">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Departamento</label>
                    <input type="text"
                        id="department"
                        name="department"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Informaci&oacute;n</label>
                    <textarea name="info"
                        class="form-control"
                        id="info"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Tel&eacute;fono</label>
                    <input type="tel"
                        id="phone"
                        name="phone"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Jefe de departamento</label>
                    <input type="text"
                        id="boss"
                        name="boss" 
                        class="form-control">
                </div>

				<button type="submit" 
                    id="update"
                    class="btn btn-success">
                    Actualizar</button>
				<button type="submit"
                    id="delete"
                    class="btn btn-danger">
        	        Eliminar</button>
            	<a href="#">Cancelar</a>
		</div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {

        /* Ocultando el mensaje de error y éxito*/
        $("#error").css('display', 'none');
        $("#success").css('display', 'none');

        /* Ocultando el id del Admin */
		$("#div-id").css('display', 'none');

        /* Función para vaciar el formulario */
        function emptyForm(){
            $("#id_admin").val('');
            $("#name-admin").val('');
            $("#username-admin").val('');
            $("#email-admin").val('');
        }

		/* FUNCIÓN PARA OCULTAR EL MENSAJE DE ERROR */
		function hideErrorMsg() {
			setTimeout(function(){
				$("#error").slideUp(2000); 
			}, 2000);
		}

		/* FUNCIÓN PARA OCULTAR EL MENSAJE DE EXITO */
		function hideSuccessMsg() {
			setTimeout(function(){
				$("#success").slideUp(2000); 
			}, 2000);
		}
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