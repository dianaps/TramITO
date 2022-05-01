<?php
    session_start();

    # Verificando si el admin mantiene la sesión abierta
    if(isset($_SESSION['admin_id'])){

        # Verificando si el nombre del admin fue enviado
        if(isset($_POST['admin'])){

            # Realizando la conexión con la BD
            include '../db.conn.php';

            # Obteniendo el nombre del admin a buscar
            $admin = $_POST['admin'];

            # Preparando el SQL y ejecutándolo
            $sql = "SELECT * FROM admins WHERE username LIKE '%$admin%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $admins = $stmt->fetchAll();                
                $html = '';

                foreach($admins as $admin){
                    $html .= '<div><a class="suggest-element" data= "'. $admin['username'] .'" id="admin'. $admin['admin_id'] .'">'. $admin['username'] . '</a></div>';
                }
                echo $html;
            }
        }

    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>