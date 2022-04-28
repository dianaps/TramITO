<?php
    # Verifica si se han establecido las variables
    if(isset($_POST['user-name']) && isset($_POST['email'])){ 
        
        # Conexión a la BD
        include '../db.conn.php';

        # Se obtiene el valor de las variables
        $username = $_POST['user-name'];
        $email = $_POST['email'];

        # Se forma la Data
        $data = 'username='.$username.'&email='.$email;

        if(empty($username)){
            $em = 'El nombre de usuario es requerido';
            header("Location: ../../restore-password.php?error=$em&$data");
   	        exit;
        }else if(empty($email)){
            $em = 'El email es requerido';
            header("Location: ../../restore-password.php?error=$em&$data");
   	        exit;
        }else{
            $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
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
                
                $sql2 = "UPDATE users SET password = ? WHERE username = ? AND email = ?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$new_password, $username, $email]);

      	        header("Location: ../../index.php?success=$sm");
   	            exit;
            }else{
                $em = "El nombre de usuario o el email son incorrectos";
      	        header("Location: ../../restore-password.php?error=$em&$data");
   	            exit;
            }
        }
    }else{
        header("Location: ../../restore-password.php");
   	    exit;
    }
?>