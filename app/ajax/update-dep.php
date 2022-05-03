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

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            # Obteniendo todos los datos
            $id_dep     = $_POST['id-dep'];
            $username   = $_POST['username'];
            $email      = $_POST['email'];
            $department = $_POST['department'];
            $info       = $_POST['info'];
            $boss       = $_POST['boss'];

            # Verificando si el nombre de usuario ya ha sido registrado
            $sql = "SELECT username
                    FROM users
                    WHERE username = ? AND user_id != ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $id_dep]);

            if ($stmt->rowCount() > 0)
                echo '{ "error": "'. Messages::ERR_USERNAME_DEPARTMENT_ALREADY_EXISTS .'" }';
            else {
                # Verificando si el email ya ha sido registrado
                $sql = "SELECT email
                        FROM users
                        WHERE email = ? AND user_id != ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email, $id_dep]);

                if ($stmt->rowCount() > 0)
                    echo '{ "error": "'. Messages::ERR_EMAIL_ALREADY_EXISTS .'" }';
                else {
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

                    echo '{ "error": "'. Messages::SCS_UPDATE_DEPARTMENT .'" }';
                }
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>