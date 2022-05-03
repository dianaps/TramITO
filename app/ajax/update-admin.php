<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['id_admin']) && 
           isset($_POST['nameAdmin']) &&
           isset($_POST['usernameAdmin']) && 
           isset($_POST['emailAdmin'] )){

            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            # Obteniendo todos los datos
            $id_admin       = $_POST['id_admin'];
            $nameAdmin      = $_POST['nameAdmin'];
            $usernameAdmin  = $_POST['usernameAdmin'];
            $emailAdmin     = $_POST['emailAdmin'];

            # Verificando si existe un admin con ese nombre de usuario
            $sql = "SELECT username
                    FROM admins
                    WHERE username = ? AND admin_id != ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$usernameAdmin, $id_admin]);

            if ($stmt->rowCount() > 0) 
                echo '{ "error": "'. Messages::ERR_USERNAME_ADMIN_ALREADY_EXISTS .'" }';
            else{
                # Verificando si el email no ha sido registrado anteriormente
                $sql = "SELECT email
                        FROM admins
                        WHERE email = ? AND admin_id != ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$emailAdmin, $id_admin]);

                if ($stmt->rowCount() > 0) 
                    echo '{ "error": "'. Messages::ERR_EMAIL_ALREADY_EXISTS .'" }';
                else{
                    # Preparando la actualización y ejecutándola
                    $sql = "UPDATE admins 
                            SET name = ?, username = ?, email = ? 
                            WHERE admin_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$nameAdmin, $usernameAdmin, $emailAdmin, $id_admin]);

                    echo '{ "success": "'. Messages::SCS_UPDATE_ADMIN .'" }';
                }
            }
        }
    }else{
        header("Location: ../../index-admin.php");
    }
?>