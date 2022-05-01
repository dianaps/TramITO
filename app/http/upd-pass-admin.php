<?php
    session_start();

    # Incluyendo el archivo que contiene los mensajes
    include '../constants/messages.php';

    # Verificando si el usuario mantiene la sesión abierta
    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['act-pass']) && 
           isset($_POST['new-pass']) && 
           isset($_POST['conf-pass'])){
            
            # Conexión a la BD
            include '../db.conn.php';
    
            # Obteniendo valor de las variables
            $current_password =  trim($_POST['act-pass']);
            $new_password     =  trim($_POST['new-pass']);
            $conf_password    =  trim($_POST['conf-pass']);

            # Formando el URL
            $data = 'current_password='. $current_password . '&new_password=' . $new_password .
                    '&conf_password=' . $conf_password;

            if(empty($current_password)){
                # Mensaje de error
                $em = Messages::ERR_CURRENT_PASSWORD_REQUIRED;
        
                # Redireccionando a 'update-pass-admin' y pasando el mensaje de error
                header("Location: ../../admin/update-pass-admin.php?error=$em");
                exit;
            }else if(empty($new_password)){
                # Mensaje de error
                $em = Messages::ERR_NEW_PASSWORD_REQUIRED;
        
                # Redireccionando a 'update-pass-admin' y pasando el mensaje de error
                header("Location: ../../admin/update-pass-admin.php?error=$em&$data");
                exit;
            }else if(empty($conf_password)){
                # Mensaje de error
                $em = Messages::ERR_CONFIRM_PASSWORD_REQUIRED;

                # Redireccionando a 'update-pass-admin' y pasando el mensaje de error
                header("Location: ../../admin/update-pass-admin.php?error=$em&$data");
                exit;
            }else if($new_password != $conf_password){
                # Mensaje de error
                $em = Messages::ERR_DIFFERENT_PASSWORDS;
                
                # Redireccionando a 'update-pass-admin' y pasando el mensaje de error
                header("Location: ../../admin/update-pass-admin.php?error=$em&$data");
                exit;
            }else{
                # Obteniendo el password actual del admin
                $sql = "SELECT password 
                        FROM admins 
                        WHERE username = ? AND admin_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$_SESSION['username'], $_SESSION['admin_id']]);
    
                $admin = $stmt->fetch();

                if(password_verify($current_password, $admin['password'])){

                    if($current_password == $new_password){
                        # Mensaje de error
                        $em = Messages::ERR_DIFFERENT_PASSWORDS_REQUIRED;
        
                        # Redireccionando a 'update-pass-admin y pasando el mensaje de error
                        header("Location: ../../admin/update-pass-admin.php?error=$em&$data");
                        exit;
                    }else{
                        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $sql = "UPDATE admins SET password = ? WHERE username = ? AND admin_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$new_password, $_SESSION['username'], $_SESSION['admin_id']]);
                    }
                }else{
                    # Mensaje de error
                    $em = Messages::ERR_CURRENT_PASSWORD;

                    # Redireccionando a 'update-pass-admin y pasando el mensaje de error
                    header("Location: ../../admin/update-pass-admin.php?error=$em&$data");
                    exit;
                }

                # Mensaje de éxito
                $sm = Messages::SCS_UPDATE_PASSWORD;
                header("Location: ../../admin/update-pass-admin.php?success=$sm");
                exit;
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>