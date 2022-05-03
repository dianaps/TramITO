<?php
    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['dep'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            /* Obteniendo el nombre del departamento a buscar */
            $dep = $_POST['dep'];

            /* Preparando la consulta y ejecutándola */
            $sql = "SELECT * FROM departments
                    INNER JOIN users ON departments.user_id = users.user_id
                    WHERE department_name LIKE '%$dep%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            /* Si se obtiene únicamente un resultado, entonces se retorna la información */
            if($stmt->rowCount() === 1){
                $dep = $stmt->fetch();
                echo json_encode($dep);
            }else
                echo '{ "error": "'. Messages::ERR_DEPARTMENT_DOESNT_EXIST .'" }';
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>