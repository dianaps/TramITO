<?php

    # Incluyendo el archivo que contiene los mensajes de error
    include '../constants/messages.php';

    # Verificando si se han establecido las variables
    if(isset($_POST['username']) && 
       isset($_POST['email'])){ 
        
        # Conexión a la BD
        include '../db.conn.php';

        # Se obtiene el valor de las variables
        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);

        # Se forma la Data
        $data = 'username='.$username.'&email='.$email;

        if(empty($username)){
            # Mensaje de error
            $em = Messages::ERR_USERNAME_REQUIRED;

            # Redireccionando a 'restore-password' y pasando el mensaje de error
            header("Location: ../../restore-password.php?error=$em&$data");
   	        exit;
        }else if(empty($email)){
            # Mensaje de error
            $em = Messages::ERR_EMAIL_REQUIRED;
            
            # Redireccionando a 'restore-password' y pasando el mensaje de error
            header("Location: ../../restore-password.php?error=$em&$data");
   	        exit;
        }else{
            $sql = "SELECT * 
                    FROM users 
                    WHERE username = ? AND email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username, $email]);

            # Verificando que existe una cuenta asociada a los datos
            if($stmt->rowCount() > 0){

                $patron = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $length = 8;

                $new_password = substr(str_shuffle($patron), 0, $length);

                $sm = "El password temporal es: '". $new_password . "'. Recomendamos actualizar la contraseña"
                      . " inmediatamente.";

                $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                $sql2 = "UPDATE users 
                         SET password = ? 
                         WHERE username = ? AND email = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$new_password, $username, $email]);

      	        header("Location: ../../index.php?success=$sm");
   	            exit;
            }else{
                # Mensaje de error
                $em = Messages::ERR_INCORRECT_USERNAME_OR_EMAIL;

                # Redireccionando a 'restore-password' y pasando el mensaje de error
      	        header("Location: ../../restore-password.php?error=$em&$data");
   	            exit;
            }
        }
    }else{
        header("Location: ../../restore-password.php");
   	    exit;
    }
?>