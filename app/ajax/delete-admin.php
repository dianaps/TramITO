<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_admin'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo el id de la QA
            $id_admin = $_POST['id_admin'];

            # Preparando la eliminación y ejecutándola
            $sql = "DELETE FROM admins WHERE admin_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_admin]);

            # Mostrando el mensaje
            echo "El administrador se ha eliminado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }

?>