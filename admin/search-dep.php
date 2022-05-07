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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
	#suggestions{
		box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    	height: auto;
	}
	#suggestions .suggest-element{
		background-color: white;
		border-top: 1px solid #d6d4d4;
		cursor: pointer;
		padding: 8px;
		width: 100%;
		float: left;
	}
</style>
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
                    <div id="suggestions"></div>
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
                        name="username-dep"
                        id="username-dep">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Correo electrónico</label>
                    <input type="email"
                        class="form-control"
                        name="email-dep"
                        id="email-dep">
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
                <button type="button"
                    id="reset"
                    class="btn btn-primary">
                    Cancelar</button>
		</div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {

        $("#reset").click(function(){
            emptyForm();
        });

        /* Ocultando el mensaje de error y éxito*/
        $("#error").css('display', 'none');
        $("#success").css('display', 'none');

        /* Ocultando el id del Dep */
		$("#div-id").css('display', 'none');

        /* Función para vaciar el formulario */
        function emptyForm(){
            $("#id-dep").val('');
            $("#username-dep").val('');
            $("#email-dep").val('');
            $("#department").val('');
            $('#info').val('');
            $('#boss').val('');
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

        /* TEXTO PREDICTIVO */
        $("#searchText").on('keyup', function () {
            var key = $(this).val();
            var dataDepartment = 'department=' + key;
            
            if(dataDepartment != 'department='){
                $.ajax({
                    type: "POST",
                    url: "../app/ajax/predictive-dep.php",
                    data: dataDepartment,
                    success: function (data) {
                        // Se muestran todas las sugerencias
                        $("#suggestions").fadeIn(250).html(data);

                        /* Si se da click en cualquier sugerencia entonces
						   se acompleta el valor de esta en el cuadro de búsqueda
						*/
                        $(".suggest-element").on('click', function () {
							var id = $(this).attr('id');
							$("#searchText").val($('#'+id).attr('data'));
							$("#suggestions").fadeOut(250);
							return false;
						});
                    }
                });
            }else
                $("#suggestions").fadeOut(100);
        });

        /* BUSQUEDA DEL DEPARTAMENTO */
        $("#btn-search").on('click', function(e){
            /* Se obtiene el nombre del admin a buscar */
            $dep = $.trim($('#searchText').val());

            if($dep == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El nombre del departamento a buscar es requerido');
                hideErrorMsg();

                /* Se vacía el formulario */
                emptyForm();
            } else 
                getDepInfo($dep); /* Llamada a la función AJAX para traer los datos dinámicamente */

            /* Se limpia el cuadro de búsqueda */
            $("#searchText").val('');
        });

        function getDepInfo($dep){
            $.ajax({
                url: "../app/ajax/get-dep.php",
                type: "POST",
                data: {dep: $dep},
                success: function (data){
                    
                    var result = jQuery.parseJSON(data);

                    if(!result.hasOwnProperty('error')){
                        /* Se muestran los datos en el formulario */
                        $('#id-dep').val(result.user_id);
                        $('#username-dep').val(result.username);
                        $('#email-dep').val(result.email);
                        $('#department').val(result.department_name);
                        $('#info').val(result.info);
                        $('#boss').val(result.department_head);
                    }else{
						/* Al no obtener resultado, se vacía el formulario */
						emptyForm();

						/* Se muestra el mensaje de error */
						$("#error").css('display', 'block');
						$("#error").text(result.error);
                        hideErrorMsg();
					}
                }
            });
        }

        /* ACTUALIZACIÓN DEL DEPARTAMENTO */
		$("#update").on('click', function (e) {

            /* Eliminando los espacios en blanco */
            $username = $.trim($('#username-dep').val());
            $email = $.trim($('#email-dep').val());
            $department = $.trim($('#department').val());
            $info = $.trim($('#info').val());
            $boss = $.trim($('#boss').val());

            /* Verificando espacios vacíos */
            if($username == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El nombre de usuario no puede estar vacío.');
                hideErrorMsg();
            }else if($email == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El correo electrónico no puede estar vacío.');
                hideErrorMsg();
            }else if($department == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El departamento no puede estar vacío.');
                hideErrorMsg();
            }else if($info == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('La información del departamento no puede estar vacía.');
                hideErrorMsg();
            }else if($boss == ''){
                /* Se muestra el mensaje de error */
                $("#error").css('display', 'block');
                $("#error").text('El jefe del departamento no puede estar vacío.');
                hideErrorMsg();
            }else
                updateDep($username, $email, $department, $info, $boss);
        });

        function updateDep($username, $email, $department, $info, $boss){
			/* Obteniendo el id del departamento */
			$id_dep= $("#id-dep").val();

			/* Otra forma de enviar los datos a través de HTTP */
			$data = 'username='+$username+'&email='+$email+'&department='+$department+'&info='+$info+'&boss='+$boss+'&id-dep='+$id_dep;

			$.ajax({
				type: "POST",
				url: "../app/ajax/update-dep.php",
				data: $data,
				success: function (response) {

                    var result = jQuery.parseJSON(response);
                    console.log(result);

                    if(!result.hasOwnProperty('error')){
                        $("#success").css('display', 'block');
					    $("#success").text(result.success);
				
                        hideSuccessMsg();
                        emptyForm();
                    }else{
						$("#error").css('display', 'block');
						$("#error").text(result.error);
                        hideErrorMsg();
					}					
				}
			});
		}

        /* ELIMINACIÓN DEL DEPARTAMENTO */
		$("#delete").on('click', function (e) {
			/* Obteniendo el id del departamento para eliminar */
			$id_dep= $("#id-dep").val();

			/* Verificando que se haya buscado una pregunta previamente */
			if($id_dep == ''){
				/* Mostrando el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('Debes buscar previamente un departamento a eliminar.');

				hideErrorMsg();
			}else
				deleteAdmin($id_dep);
		});

        function deleteAdmin($id_dep){
			$.ajax({
				type: "POST",
				url: "../app/ajax/delete-dep.php",
				data: {id_dep: $id_dep},
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