<?php
	session_start();

	if(isset($_SESSION['admin_id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Buscar QA</title>
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
	#suggestions .suggest-element {
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

	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">B&uacute;squeda Q&A</h1>
	</div>

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
						<textarea placeholder="Buscar... "
							id="searchtext"
							class="form-control"></textarea>
						<!-- Botón de búsqueda -->
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
						ID QA</label>
					<input type="text"
						name="id_qa"
						class="form-control"
						id="id_qa">
				</div>

				<div class="mb-3">
					<label class="form-label">
						Pregunta</label>
					<textarea name="question"
						class="form-control"
						id="question"></textarea>
				</div>

				<div class="mb-3">
					<label class="form-label">
						Respuesta</label>
					<textarea name="answer"
						class="form-control"
						id="answer"></textarea>
				</div>
				
				<button type="button" 
                	id= "update"    
					class="btn btn-success">
                    Actualizar</button>
				<button type="buton" 
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

		/* Ocultando los mensajes de error y éxito*/
		$("#error").css('display', 'none');
		$("#success").css('display', 'none');

		/* Ocultando el id de la QA*/ 
		$("#div-id").css('display', 'none');

		/* FUNCIÓN PARA BORRAR EL FORMULARIO */
		function emptyForm(){
			$("#id_qa").val('');
			$("#question").val('');
			$("#answer").val('');
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
		
		/* BÚSQUEDA DE LA QA */
		$("#searchtext").on('keyup', function () {
			var key = $(this).val();
			var dataQuestion = 'question=' + key;

			if(dataQuestion != 'question='){
				$.ajax({
					type: "POST",
					url: "../app/ajax/predictive-qa.php",
					data: dataQuestion,
					success: function (data) {
						// Se muestran todas las sugerencias
						$("#suggestions").fadeIn(250).html(data);

						/* Si se da click en cualquier sugerencia entonces
						   se acompleta el valor de esta en el cuadro de búsqueda
						*/
						$(".suggest-element").on('click', function () {
							var id = $(this).attr('id');
							$("#searchtext").val($('#'+id).attr('data'));
							$("#suggestions").fadeOut(250);
							return false;
						});
					}
				});
			}else
				$("#suggestions").fadeOut(100);
		});

		$("#btn-search").on('click', function (e) {
			/* Eliminando los espacios en blanco */
			$question = $.trim($('#searchtext').val());
			
			/* Se verifica si el text area se encuentra vacío */
			if($question == ''){
				/* Se muestra el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('La pregunta a buscar es requerida.');

				hideErrorMsg();

				/* Se vacía el formulario */
				emptyForm();
			}else
				getQuestion($question);

			/* Se limpia el cuadro de búsqueda */
			$("#searchtext").val('');
		});

		function getQuestion($question){
			$question = $question.replaceAll(" ", "%")

			$.ajax({
				url: "../app/ajax/get-qa.php",
				type: "POST",
				data: {question: $question},
				success: function (data) {
					/* A diferencia de las demás funciones AJAX, en esta se requiere obtener más
					   de un dato, por tanto, es necesario obtener un arreglo de datos JSON para
					   poder llenar correctamente el formulario.  
					*/

					/* Función que toma un string JSON y lo convierte en un arreglo JS de objetos */
					var result = jQuery.parseJSON(data);

					if(!result.hasOwnProperty('error')){
						/* Como se ha obtenido un arreglo, se accede a los valores a través de índices */
						$('#id_qa').val(result.id);
						$('#question').val(result.pregunta);
						$('#answer').val(result.respuesta);
					}
					else{
						/* Al no obtener la QA se deben borra el formulario */
						emptyForm();

						/* Se muestra el mensaje de error */
						$("#error").css('display', 'block');
						$("#error").text(result.error);
						hideErrorMsg();
					}
				}
			});
		}

		/* ACTUALIZACIÓN DE LA QA */
		$("#update").on('click', function (e) {

			/* Eliminando los espacios en blanco */
			$question = $.trim($('#question').val());
			$answer = $.trim($('#answer').val());
			
			/* Verificando si la pregunta o la respuesta se encuentra vacías */
			if($question == ''){
				/* Se muestra el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('La pregunta no puede estar vacía.');
				hideErrorMsg();
			}else if($answer == ''){
				/* Se muestra el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('La respuesta no puede estar vacía.');
				hideErrorMsg();
			}else
				updateQA($question, $answer);
		});

		function updateQA($question, $answer){
			/* Obteniendo el id de la QA */
			$id_qa= $("#id_qa").val();

			/* Otra forma de enviar los datos a través de HTTP */
			$data = 'question='+$question+'&answer='+$answer+'&id_qa='+$id_qa;

			$.ajax({
				type: "POST",
				url: "../app/ajax/update-qa.php",
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
			/* Obteniendo el id de la QA a eliminar */
			$id_qa = $('#id_qa').val();

			/* Verificando que se haya buscado una pregunta previamente */
			if($id_qa == ''){
				/* Mostrando el mensaje de error */
				$("#error").css('display', 'block');
				$("#error").text('Debes buscar previamente una QA a eliminar.');

				hideErrorMsg();
			}else
				deleteQA($id_qa);
		});

		function deleteQA($id_qa){
			$.ajax({
				type: "POST",
				url: "../app/ajax/delete-qa.php",
				data: {id_qa: $id_qa},
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
	}
?>