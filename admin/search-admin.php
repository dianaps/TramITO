<?php
    session_start();

    if(isset($_SESSION['admin_id'])){
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="">

	<?php include "header-admin.php"?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Gesti&oacute;n del Administrador</h1>
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
						ID Admin</label>
					<input type="text"
						name="id-admin"
						class="form-control"
						id="id_admin">
				</div>

                <div class="mb-3">
                    <label class="form-label">
                        Nombre</label>
                    <input type="text"
                        name="name"
                        id="name-admin"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Usuario</label>
                    <input type="text"
                        name="username"
                        id="username-admin"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo</label>
                    <input type="text"
                        name="email"
                        id="email-admin"
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
        
        $("#btn-search").on('click', function (e) {

            /* Se obtiene el nombre del admin a buscar */
            $admin = $("#searchText").val();

            if($admin == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El nombre de usuario del administrador a buscar es requerido');
                hideErrorMsg();

                /* Se vacía el formulario */
                emptyForm();
            }else
                getAdminInfo($admin); /* Llamada a la función AJAX para traer los datos dinámicamente */
                
            /* Se limpia el cuadro de búsqueda */
            $("#searchText").val('');
        });

        function getAdminInfo($admin){
            $.ajax({
                url: "../app/ajax/get-admin.php",
                type: "POST",
                data: {admin: $admin},
                success: function (data) {

                    var result = jQuery.parseJSON(data);

					if(result.length == 1){
						/* Se muestran los datos en el formulario */ 
                        $('#id_admin').val(result[0].admin_id);
						$("#name-admin").val(result[0].name);
                        $("#username-admin").val(result[0].username);
                        $("#email-admin").val(result[0].email);

					}else{
						/* Al no obtener resultado, se vacía el formulario */
						emptyForm();

						/* Se muestra el mensaje de error */
						$error = result[0] + " " + result[1];

						$("#error").css('display', 'block');
						$("#error").text($error);
                        hideErrorMsg();
					}
                }
            });  
        }

        /* ACTUALIZACIÓN DEL ADMIN */
		$("#update").on('click', function (e) {

            /* Eliminando los espacios en blanco */
            $nameAdmin = $.trim($('#name-admin').val());
            $usernameAdmin= $.trim($('#username-admin').val());
            $emailAdmin = $.trim($('#email-admin').val());

            /* Verificando si el nombre se encuentra vacío */
            if($nameAdmin == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El nombre no puede estar vacío.');
                hideErrorMsg();
            }else if($usernameAdmin == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El nombre de usuario no puede estar vacío.');
                hideErrorMsg();
            }else if($emailAdmin == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El email no puede estar vacía.');
                hideErrorMsg();
            }else 
                updateAdmin($nameAdmin, $usernameAdmin, $emailAdmin);
                
        });

        function updateAdmin($nameAdmin, $usernameAdmin, $emailAdmin){
            /* Obteniendo el valor del id */
            $id_admin = $('#id_admin').val();
            console.log($id_admin);

            /* Otra forma de enviar los datos a través de HTTP */
			$data = 'nameAdmin='+$nameAdmin+'&usernameAdmin='+$usernameAdmin+'&emailAdmin='+$emailAdmin+'&id_admin='+$id_admin;

            $.ajax({
                type: "POST",
                url: "../app/ajax/update-admin.php",
                data: $data,
                success: function (response) {
                    $("#success").css('display', 'block');
                    $("#success").text(response);

                    hideSuccessMsg();
                    emptyForm();
                }
            });
        }

        /* ELIMINACIÓN DE LA QA */
		$("#delete").on('click', function (e) {
			/* Obteniendo el id del Admin a eliminar */
			$id_admin = $('#id_admin').val();

			/* Verificando que se haya buscado una pregunta previamente */
			if($id_admin == ''){
				/* Mostrando el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('Debes buscar previamente un Admin a eliminar.');

				hideErrorMsg();
			}else
				deleteAdmin($id_admin);
		});

        function deleteAdmin($id_admin){
			$.ajax({
				type: "POST",
				url: "../app/ajax/delete-admin.php",
				data: {id_admin: $id_admin},
				success: function (response) {
					$("#success").css('display', 'block');
					$("#success").text(response);

					hideSuccessMsg();
					emptyForm();
				}
			});
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