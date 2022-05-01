<?php
    session_start();

    # Verificando si el admin mantiene la sesión abierta
    if(isset($_SESSION['admin_id'])){

        # Verificando si el nombre del admin fue enviado
        if(isset($_POST['department'])){

            # Realizando la conexión con la BD
            include '../db.conn.php';

            # Obteniendo el nombre del admin a buscar
            $department = $_POST['department'];

            # Preparando el SQL y ejecutándolo
            $sql = "SELECT * FROM departments WHERE department_name LIKE '%$department%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $departments = $stmt->fetchAll();                
                $html = '';

                foreach($departments as $department){
                    $html .= '<div><a class="suggest-element" data= "'. $department['department_name'] .'" id="dep'. $department['user_id'] .'">'. $department['department_name'] . '</a></div>';
                }
                echo $html;
            }
        }

    }else{
        header("Location: ../../index-admin.php");
        exit;
    }

?>