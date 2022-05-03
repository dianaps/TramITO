<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id-dep']) &&
           isset($_POST['username']) &&
           isset($_POST['email']) &&
           isset($_POST['department']) &&
           isset($_POST['info']) &&
           isset($_POST['boss'])){
            
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Obteniendo todos los datos
            $id_dep     = $_POST['id-dep'];
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $department = $_POST['department'];
            $info       = $_POST['info'];
            $boss       = $_POST['boss'];

            # Preparando la actualización y ejecutándola en "users"
            $sql = "UPDATE users 
                    SET username = ?, email = ? 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email, $id_dep]);

            # Preparando la actualización y ejecutándola en "Departments"
            $sql = "UPDATE departments
                    SET department_name = ?, info = ?, department_head = ? 
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$department, $info, $boss, $id_dep]);

            echo "El departamento se ha actualizado correctamente.";
        }
    }else{
        header("Location: ../../index-admin.php");
    }
?>