<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_qa']) && 
           isset($_POST['question']) && 
           isset($_POST['answer'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo todos los datos
            $id_qa = $_POST['id_qa'];
            $question = $_POST['question'];
            $answer = $_POST['answer'];

            # Preparando la actualización y ejecutándola
            $sql = "UPDATE xoochbot 
                    SET pregunta = ?, respuesta = ? 
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$question, $answer, $id_qa]);

            echo "La QA se ha actualizado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
    }
?>