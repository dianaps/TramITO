<?php

    session_start();

    # Verificando su la sesión del admin permanece abierta
    if(isset($_SESSION['admin_id'])){

        # Verificando si todos los datos fueron enviados
        if(isset($_POST['username']) &&
           isset($_POST['password']) &&
           isset($_POST['email']) &&
           isset($_POST['department']) &&
           isset($_POST['info']) &&
           isset($_POST['phone']) &&
           isset($_POST['boss'])){

            # Estableciendo la conexión con la BD
            include '../db.conn.php';

            # Obteniendo los datos enviados
            $username   = trim($_POST['username']);
            $password   = trim($_POST['password']);
            $email      = trim($_POST['email']);
            $department = trim($_POST['department']);
            $info       = trim($_POST['info']);
            $phone      = trim($_POST['phone']);
            $boss       = trim($_POST['boss']);

            # Elaborando el formato de la URL para devolver datos
            $data = 'username=' . $username . '&password= ' . $password . '&email=' . $email .
                    '&department=' . $department . '&info=' . $info . '&phone=' . $phone . '&boss=' . $boss;

            # Validación de los de datos enviados en el formulario
            if(empty($username)){
                # Mensaje de error
                
            }else if(empty($password)){
                
            }else if(empty($email)){

            }else if(empty($department)){

            }else if(empty($info)){

            }else if(empty($phone)){

            }else if(empty($boss)){

            }else{

            }
        }
        
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>