<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_dep'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo el id del departamento
            $id_dep = $_POST['id_dep'];

            # Preparando la eliminación y ejecutándola
            $sql = "DELETE FROM departments 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_dep]);

            $sql = "DELETE FROM users
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_dep]);

            # Mostrando el mensaje
            echo "El departamento se ha eliminado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }

?>