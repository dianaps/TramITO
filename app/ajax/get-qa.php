<?php 

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['question'])){
            # Se realiza la conexión a la BD
            include '../db.conn.php';

            $question = $_POST['question'];
            $sql = "SELECT * FROM xoochbot WHERE pregunta LIKE '%$question%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() === 1 ){
                $respuesta = $stmt->fetch();
                $array[] = $respuesta;
                echo json_encode($array);
            }else{
                $array[] = "No se encontró la pregunta solicitada.";
                $array[] = "Intenta de nuevo.";
                echo json_encode($array);
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>