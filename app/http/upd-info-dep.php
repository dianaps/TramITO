<?php

    session_start();

    # Verificando si el usuario mantiene abierta la sesión
    if (isset($_SESSION['username'])){
        
        if(isset($_POST['username']) &&
           isset($_POST['email-dep']) &&
           isset($_POST['department']) &&
           isset($_POST['info']) &&
           isset($_POST['boss'])){

            # Conexión a la BD
            include '../db.conn.php';

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            # Obteniendo todos los datos
            $username   = trim($_POST['username']);
            $email      = trim($_POST['email-dep']);
            $department = trim($_POST['department']);
            $info       = trim($_POST['info']);
            $boss       = trim($_POST['boss']);

            # Formando el URL
            $data = 'username=' . $username . '&email=' . $email . '&department=' . $department .
                    '&info=' . $info . '&boss=' . $boss;

            # Verificando si los datos no se encuentran vacíos
            if(empty($username)){
                # Mensaje de error
                $em = Messages::ERR_USERNAME_REQUIRED;

                # Redireccionando a 'update-info' y pasando el mensaje de error
                header("Location: ../../update-info.php?error=$em&$data");
                exit;
            } else if (empty($email)){
                # Mensaje de error
                $em = Messages::ERR_EMAIL_REQUIRED;

                # Redireccionando a 'update-info' y pasando el mensaje de error
                header("Location: ../../update-info.php?error=$em&$data");
                exit;
            } else if(empty($department)){
                # Mensaje de error
                $em = Messages::ERR_NAME_DEPARTMENT_REQUIRED;

                # Redireccionando a 'update-info' y pasando el mensaje de error
                header("Location: ../../update-info.php?error=$em&$data");
                exit;
            } else if(empty($info)){
                # Mensaje de error
                $em = Messages::ERR_INFO_DEPARTMENT_REQUIRED;

                # Redireccionando a 'update-info' y pasando el mensaje de error
                header("Location: ../../update-info.php?error=$em&$data");
                exit;
            } else if(empty($boss)){
                # Mensaje de error
                $em = Messages::ERR_BOSS_DEPARTMENT_REQUIRED;

                # Redireccionando a 'update-info' y pasando el mensaje de error
                header("Location: ../../update-info.php?error=$em&$data");
                exit;
            } else {
                # Verificando si el nombre de usuario ya ha sido elegido
                $sql = "SELECT username
                        FROM users
                        WHERE username = ? AND user_id != ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username, $_SESSION['user_id']]);

                if ($stmt->rowCount() > 0) {
                    # Mensaje de error
                    $em = Messages::ERR_USERNAME_ADMIN_ALREADY_EXISTS;

                    # Redireccionando a 'update-info' y pasando el mensaje de error
                    header("Location: ../../update-info.php?error=$em&$data");
                    exit;
                }

                # Verificando si el email ya ha sido registrado
                $sql = "SELECT email
                        FROM users
                        WHERE email = ? AND user_id != ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email, $_SESSION['user_id']]);

                if ($stmt->rowCount() > 0) {
                    # Mensaje de error
                    $em = Messages::ERR_EMAIL_ALREADY_EXISTS;

                    # Redireccionando a 'update-info' y pasando el mensaje de error
                    header("Location: ../../update-info.php?error=$em&$data");
                    exit;
                }

                # Preparando la actualización y ejecutándola en la tabla 'users'
                $sql = "UPDATE users 
                        SET username = ?, email = ? 
                        WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username, $email, $_SESSION['user_id']]);

                # Preparando la actualización y ejecutándola en la tabla 'departments'
                $sql = "UPDATE departments 
                        SET department_name = ?, info = ?, department_head = ? 
                        WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$department, $info, $boss, $_SESSION['user_id']]);

                # Mensaje de éxito
                $sm = Messages::SCS_INFO_UPDATE;

                # Redirección a 'update-info' y pasando el mensaje de éxito
                header("Location: ../../update-info.php?success=$sm");
                exit;
            }
        }
    } else {
        header("Location: ../../index.php");
        exit;
    }
?>