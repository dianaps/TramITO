<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_admin']) && isset($_POST['nameAdmin']) &&
           isset($_POST['usernameAdmin']) && isset($_POST['emailAdmin'] )){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo todos los datos
            $id_admin = $_POST['id_admin'];
            $nameAdmin = $_POST['nameAdmin'];
            $usernameAdmin = $_POST['usernameAdmin'];
            $emailAdmin = $_POST['emailAdmin'];

            # Preparando la actualización y ejecutándola
            $sql = "UPDATE admins SET name = ?, username = ?, email = ? WHERE admin_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nameAdmin, $usernameAdmin, $emailAdmin, $id_admin]);

            echo "El administrador se ha actualizado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
    }
?>