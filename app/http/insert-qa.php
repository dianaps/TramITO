<?php
    session_start();

    # Incluyendo el archivo que contiene los mensajes de error
    include '../constants/messages.php';

    # Verificando si la sesión del admin permanece abierta
    if(isset($_SESSION['admin_id'])){
        
        if(isset($_POST['question']) && 
           isset($_POST['answer'])){

            # Conexión a la BD 
            include '../db.conn.php';

            # Obteniendo el valor de las variables y se eliminan los espacios en blanco
            $question = trim($_POST['question']);
            $answer   = trim($_POST['answer']);

            # Formando la URL de regreso
            $data = 'question='. $question .'&answer=' . $answer;

            if(empty($question)){
                # Mensaje de error
                $em = Messages::ERR_QUESTION_REQUIRED;

                # Redireccionando a 'add-qa' y pasando el mensaje de error
                header("Location: ../../admin/add-qa.php?error=$em&$data");
                exit;
            }else if(empty($answer)){
                # Mensaje de error
                $em = Messages::ERR_ANSWER_REQUIRED;

                # Redireccionando a 'add-qa' y pasando el mensaje de error
                header("Location: ../../admin/add-qa.php?error=$em&$data");
                exit;
            }else{
                # Agregando la QA a la base de datos
                $sql = 'INSERT INTO xoochbot (pregunta, respuesta) VALUES (?,?)';
                $stmt = $conn->prepare($sql);
                $stmt->execute([$question, $answer]);

                # Mensaje de éxito
                $sm = Messages::SCS_ADD_QA;

                # Redireccionando a 'add-qa' y pasando el mensaje de éxito
                header("Location: ../../admin/add-qa.php?success=$sm");
                exit;
            }
        }
    }else{
        header("Location: ../../index-admin.php");
        exit;
    }
?>