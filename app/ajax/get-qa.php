<?php 

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['question'])){
            # Se realiza la conexión a la BD
            include '../db.conn.php';

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            $question = $_POST['question'];
            $sql = "SELECT * 
                    FROM xoochbot 
                    WHERE pregunta LIKE '%$question%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() === 1){
                $respuesta = $stmt->fetch();
                echo json_encode($respuesta);
            }else
                echo '{ "error": "'. Messages::ERR_QA_DOESNT_EXIST  .'" }';
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>