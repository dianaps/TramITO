<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_qa'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo el id de la QA
            $id_qa = $_POST['id_qa'];

            # Preparando la eliminación y ejecutándola
            $sql = "DELETE FROM xoochbot WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_qa]);

            # Mostrando el mensaje
            echo "La QA se ha eliminado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }

?>