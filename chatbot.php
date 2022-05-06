<?php
session_start();

if (isset($_SESSION['username'])) {
  # database connection file
  include 'app/db.conn.php';

  include 'app/helpers/user.php';
  include 'app/helpers/chat.php';
  include 'app/helpers/opened.php';

  include 'app/helpers/timeAgo.php';
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "sections/head-tags.php"?>
	<title>TramITO - Chatbot</title>
</head>
<body class="">

	<?php include "sections/header.php"?>
	<!-- Encabezado -->
	<div id class="p-5 text-center bg-light">
		<h1 class="mb-3">Chatbot</h1>
	</div>
	<!-- Encabezado -->

	<!-- ChatBot -->
	<div class="d-flex
        justify-content-center
        align-items-center">
		<div class="w-responsive shadow p-4 rounded">
			<div class="d-flex align-items-center">
				<img src="uploads/xoochbot.png"
					class="w-15 rounded-circle">

				<h3 class="display-4 fs-sm m-2">XOOCHBOT</h3>
			</div>

			<div class="shadow p-4 rounded
				d-flex flex-column
				mt-2 chat-box"
				id="chatBox">

					<p class="ltext border
						rounded p-2 mb-1">
						<?php echo '¡Hola! Soy XoochBot, bienvenido a TramITO ¿Cómo puedo ayudarte?' .
    'Recuerda utilizar únicamente palabras clave al hacer tus preguntas.'; ?>
						<small class="d-block">
							<?php
# Para establecer un formato de 24h la 'H' debe ser mayúscula
  echo date("Y-m-d H:i:s");
  ?>
						</small>
					</p>
			</div>
			<div class="input-group mb-3">
				<textarea cols="3"
							id="message"
							class="form-control"></textarea>
				<button class="btn btn-primary"
						id="sendBtn"
						style="display: none;">
					<i class="fa fa-paper-plane"></i>
				</button>
			</div>
		</div>
	</div>

<!-- ChatBot -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
	var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){

		// Desaparecer el botón de 'Enviar' si no existe un mensaje
		$("#message").on("keyup", function () {
            if($("#message").val())
                $("#sendBtn").css("display","block");
            else
                $("#sendBtn").css("display","none");
        });

		// Al dar click sobre el botón se envía el mensaje
		$("#sendBtn").on("click", function (e) {
            getResponse();
        });

		function getResponse(){
            // Se eliminan los espacios al inicio y final del mensaje
            $msg = $.trim($("#message").val());
            // Se reemplazan los espacios vacíos por '%' para un mejor análisis
            $msgUsuario = $msg.replaceAll(" ", "%")

			// Obtención de la fecha y hora actual
            $fecha_actual = getTZDate('es-MX', 'America/Mexico_City');

			// Se imprime el mensaje sin alterar
			$msgChat = '<p class="rtext align-self-end border rounded p-2 mb-1">'+ $msg +
					   '<small class="d-block">'+ $fecha_actual + '</small> </p>';

			$("#chatBox").append($msgChat);

            // Solicitud AJAX para obtener las respuestas
            $.ajax({
                url: "app/ajax/xoochbot.php",
                type: "POST",
                // Envío del mensaje
                data: {mensaje: $msgUsuario},
                // Obtención de la respuesta
                success: function (data) {
                    // Mostrar respuesta del bot
					// Obtención de la fecha y hora actual
					$fecha_actual = getTZDate('es-MX', 'America/Mexico_City');

                    $msgBot = '<p class="ltext border rounded p-2 mb-1">'+ data +
					   		  '<small class="d-block">'+ $fecha_actual + '</small> </p>';;

                    $("#chatBox").append($msgBot).fadeIn(1000);
					scrollDown();
                }
            });
            $("#message").val('');
            $("#sendBtn").css("display", "none");
        }

		const getTZDate = (locale, timeZone) => {
  			const date = new Date();
  			$fecha_actual = date.toLocaleString(locale, {timeZone: timeZone});

			  // Se separa la fecha y la hora
			$split_fecha = $fecha_actual.split(' ');
			$fecha = $split_fecha[0];
			$hora = $split_fecha[1];

			// Formateo de la fecha
			$fecha_split = $fecha.split('/');

			$month = $fecha_split[1];
			if($month.length == 1)
				$month =  '0' + $month;

			$day = $fecha_split[0];
			if($day.length == 1)
				$day = '0' + $day;

			return $fecha_split[2] + '-' + $month + '-' + $day + ' ' + $hora;
		}
    });
</script>
 </body>
</html>
<?php } else {
  header("Location: index.php");
  exit;
}
?>