<?php  
    session_start();

    # Incluyendo el archivo de mensajes
    include '../constants/messages.php';

    # Verificando si el nombre de usuario y contraseña han sido enviados
    if(isset($_POST['username-admin']) &&
       isset($_POST['password-admin'])){

        # Se establece la conexión con la BD
        include '../db.conn.php';
        
        # Se obtiene el nombre de usuario y la contraseña
        $username = $_POST['username-admin'];
        $password = $_POST['password-admin'];
        
        # Validación de los datos
            if(empty($username)){
                # Mensaje de error
                $em = Messages::ERR_USERNAME_REQUIRED;

                # Redireccionando a index-admin y pasando el mensaje de error
                header("Location: ../../index-admin.php?error=$em");
            }else if(empty($password)){
                # Mensaje de error
                $em = Messages::ERR_PASSWORD_REQUIRED;

                # Redireccionando a index-admin y pasando el mensaje de error
                header("Location: ../../index-admin.php?error=$em");
            }else {
                $sql  = "SELECT * FROM admins WHERE username = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$username]);

                # Si el usuario existe entonces se obtiene la información de estos
                if($stmt->rowCount() === 1){
                
                    $admin = $stmt->fetch();

                    # Verificando si ambos nombres de usuario son estrictamente iguales
                    if ($admin['username'] === $username) {
                
                        # Verificando el password encriptado
                        if (password_verify($password, $admin['password'])) {

                            # Al autentificarse correctamente se crean las variables de sesión
                            $_SESSION['admin_id']   = $admin['admin_id'];
                            $_SESSION['name']       = $admin['name'];
                            $_SESSION['username']   = $admin['username'];

                            # Se redirige el flujo a 'add-qa'
                            header("Location: ../../admin/add-qa.php");
                        }else {
                            # Mensaje de error
                            $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

                            # Redireccionando a index-admin y pasando el mensaje de error
                            header("Location: ../../index-admin.php?error=$em");
                        }
                    }else {
                        # Mensaje de error
                        $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

                        # Redireccionando a index-admin y pasando el mensaje de error
                        header("Location: ../../index-admin.php?error=$em");
                    }
                }else {
                    # Mensaje de error
                    $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

                    # Redireccionando a index-admin y pasando el mensaje de error
                    header("Location: ../../index-admin.php?error=$em");
                }
            }
    }else {
        header("Location: ../../index-admin.php");
        exit;
    }
?>