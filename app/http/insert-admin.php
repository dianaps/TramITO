<?php
    
    # Comprobando que el administrador mantiene la sesión abierta
    session_start();
 
    # Incluyendo el archivo de errores
    include '../constants/messages.php';

    if(isset($_SESSION['admin_id'])){
        
        if(isset($_POST['name']) && 
           isset($_POST['username']) &&
           isset($_POST['password']) && 
           isset($_POST['email'])){
    
            # Conexión a la BD 
            include '../db.conn.php';

            # Obteniendo las variables y eliminando los espacios en blanco
            $name      = trim($_POST['name']);
            $username  = trim($_POST['username']);
            $password  = trim($_POST['password']);
            $email     = trim($_POST['email']);

            # Expresión regular del correo electrónico
            $email_pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/";

            # Formando la URL de regreso
            $data = 'name='.$name.'&username='.$username.'&password='.$password.'&email='.$email;

            # Verificando que las variables no se encuentren vacías
            if(empty($name)){
                # Mensaje de error
                $em = Messages::ERR_NAME_REQUIRED;

                # Redireccionando a 'add-admin' y pasando el mensaje de error
                header("Location: ../../admin/add-admin.php?error=$em&$data");
                exit;
            }else if(empty($username)){
                # Mensaje de error
                $em = Messages::ERR_USERNAME_REQUIRED;
                
                # Redireccionando a 'add-admin' y pasando el mensaje de error
                header("Location: ../../admin/add-admin.php?error=$em&$data");
                exit;
            }else if(empty($password)){
                # Mensaje de error
                $em = Messages::ERR_PASSWORD_REQUIRED;

                # Redireccionando a 'add-admin' y pasando el mensaje de error
                header("Location: ../../admin/add-admin.php?error=$em&$data");
                exit;
            }else if(empty($email)){
                # Mensaje de error
                $em = Messages::ERR_EMAIL_REQUIRED;

                # Redireccionando a 'add-admin' y pasando el mensaje de error
                header("Location: ../../admin/add-admin.php?error=$em&$data");
                exit;
            }else if(!preg_match($email_pattern, $email)){
                # Mensaje de error
                $em = Messages::ERR_FORMAT_EMAIL;

                # Redireccionando a 'add-admin' y pasando el mensaje de error
                header("Location: ../../admin/add-admin.php?error=$em&$data");
                exit;
            }else{

                # Verificando si existe un admin con ese nombre de usuario
                $sql = "SELECT username
                        FROM admins
                        WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username]);

                if ($stmt->rowCount() > 0) {
                    # Mensaje de error
                    $em = Messages::ERR_USERNAME_ADMIN_ALREADY_EXISTS;

                    # Redireccionando a 'add-admin' y pasando el mensaje de error
                    header("Location: ../../admin/add-admin.php?error=$em&$data");
                    exit;
                }

                # Verificando si el email no ha sido registrado anteriormente
                $sql = "SELECT email
                        FROM admins
                        WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$email]);

                if ($stmt->rowCount() > 0) {
                    # Mensaje de error
                    $em = Messages::ERR_EMAIL_ALREADY_EXISTS;
                    
                    # Redireccionando a 'add-admin' y pasando el mensaje de error
                    header("Location: ../../admin/add-admin.php?error=$em&$data");
                    exit;
                }

                # Se realiza el cifrado de la contraseña
                $password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO admins (name, username, password, email) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$name, $username, $password, $email]);

                $sm = Messages::SCS_CREATION_ADMIN;
                header("Location: ../../admin/add-admin.php?success=$sm");
                exit;
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }    
?>