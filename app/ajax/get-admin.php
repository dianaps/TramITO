<?php

    session_start();

    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['admin'])){
            # Realizando la conexión hacia la BD
            include '../db.conn.php';

            # Incluyendo el archivo que contiene los mensajes
            include '../constants/messages.php';

            /* Obteniendo el nombre del admin a buscar */
            $admin = $_POST['admin'];

            /* Preparando la consulta y ejecutándola */
            $sql = "SELECT * FROM admins WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$admin]);

            /* Si se obtiene únicamente un resultado, entonces se retorna la información */
            if($stmt->rowCount() === 1 ){
                $admin = $stmt->fetch();
                echo json_encode($admin);
            }else/* En caso contrario, se devuelve un mensaje de error */
                echo '{ "error": "'. Messages::ERR_ADMIN_DOESNT_EXIST .'" }';
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>