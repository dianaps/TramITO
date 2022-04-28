<?php  
session_start();

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
      
        $em = "¡El nombre de usuario es requerido!";
        header("Location: ../../index-admin.php?error=$em");

    }else if(empty($password)){

      $em = "¡La contraseña es requerida!";
      header("Location: ../../index-admin.php?error=$em");

    }else {
        $sql  = "SELECT * FROM admins WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        # Si el usuario existe entonces se obtiene la información de estos
        if($stmt->rowCount() === 1){
        
            $user = $stmt->fetch();

            # Verificando si ambos nombres de usuario son estrictamente iguales
            if ($user['username'] === $username) {
           
                # Verificando el password encriptado
                if (password_verify($password, $user['password'])) {

                    # Al autentificarse correctamente se crean las variables de sesión
                    $_SESSION['admin_id'] = $user['admin_id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['username'] = $user['username'];

                    # Se redirige el flujo a home-admin.php
                    header("Location: ../../admin/add-qa.php");
            }else {
                $em = "El usuario o la contraseña son incorrectos";
                header("Location: ../../index-admin.php?error=$em");
            }
        }else {
            $em = "El usuario o la contraseña son incorrectos";
            header("Location: ../../index-admin.php?error=$em");
        }
      }
   }
}else {
  header("Location: ../../index-admin.php");
  exit;
}