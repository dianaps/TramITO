<?php
    session_start();

    # Incluyendo el archivo que contiene los mensajes de error
    include '../constants/messages.php';

    if (isset($_SESSION['username'])) {

        # Realizando la conexión con la BD
        include '../db.conn.php';

        # Obteniendo el mensaje de usuario
        $mensajeUsuario = $_POST['mensaje'];

        # Realizando el SQL y ejecutándolo
        $sql = "SELECT * 
                FROM xoochbot 
                WHERE pregunta LIKE '%$mensajeUsuario%'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $respuestas = $stmt->fetchAll();

            foreach ($respuestas as $respuesta) {
                echo $respuesta['respuesta'];
            }

        }else 
            echo Messages::ERR_UNKNOWN_ANSWER;

    }else{
        header("Location: ../../index.php");
        exit;
    }
?>
