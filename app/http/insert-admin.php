<?php
    if(isset($_POST['name']) && isset($_POST['username']) &&
       isset($_POST['password']) &&isset($_POST['email'])){
    
        # Conexión a la BD 
        include '../db.conn.php';

        # Se obtiene el valor de las variables y se eliminan los espacios en blanco
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        # Formando la URL de regreso
        $data = 'name='.$name.'&username='.$username.'&password='.$password.'&email='.$email;

        # Verificando que las variables no se encuentren vacías
        if(empty($name) || $name == ''){
            $em = 'El nombre es requerido.';
            header("Location: ../../admin/add-admin.php?error=$em&$data");
            exit;
        }else if(empty($username) || $username == ''){
            $em = 'El nombre de usuario es requerido.';
            header("Location: ../../admin/add-admin.php?error=$em&$data");
            exit;
        }else if(empty($password) || $password == ''){
            $em = 'La contraseña es requerida.';
            header("Location: ../../admin/add-admin.php?error=$em&$data");
            exit;
        }else if(empty($email) || $email == ''){
            $em = 'El email es requerido.';
            header("Location: ../../admin/add-admin.php?error=$em&$data");
            exit;
        }else{
            # Se realiza el cifrado de la contraseña
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO admins (name, username, password, email) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $username, $password, $email]);

            $sm = 'El administrador se ha registrado corectamente.';
            header("Location: ../../admin/add-admin.php?success=$sm");
            exit;
        }
    }
?>