<?php
    session_start();

    # Verificando si el admin mantiene la sesión abierta
    if(isset($_SESSION['admin_id'])){

        if(isset($_POST['key'])){
            # Realizando la conexión con la BD
            include '../db.conn.php';

            # Obteniendo la pregunta a buscar
            $question = $_POST['key'];

            # Preparando el SQL y ejecutándolo
            $sql = "SELECT * FROM xoochbot WHERE pregunta LIKE '%$question%'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $preguntas = $stmt->fetchAll();                
                $html = '';

                foreach($preguntas as $pregunta){
                    $html .= '<div><a class="suggest-element" data= "'. $pregunta['pregunta'] .'" id="ques'. $pregunta['id'] .'">'. $pregunta['pregunta'] . '</a></div>';
                }
                echo $html;
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>