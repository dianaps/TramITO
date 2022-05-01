<?php

    session_start(); 

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['dep'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            /* Obteniendo el nombre del departamento a buscar */
            $dep = $_POST['dep'];

            /* Preparando la consulta y ejecutándola */
            $sql = "SELECT * FROM users
                    INNER JOIN departments ON users.user_id=departments.user_id
                    WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$dep]);

            /* Si se obtiene únicamente un resultado, entonces se retorna la información */
            if($stmt->rowCount() === 1 ){
                $dep = $stmt->fetch();
                $array[] = $dep;
                echo json_encode($array);
            }else{ /* En caso contrario, se devuelve un mensaje de error */
                $array[] = "El departamento no existe.";
                $array[] = "Intenta de nuevo.";
                echo json_encode($array);
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>