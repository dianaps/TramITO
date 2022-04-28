<?php

    if(isset($_POST['question']) && isset($_POST['answer'])){

        # Conexión a la BD 
        include '../db.conn.php';

        # Se obtiene el valor de las variables y se eliminan los espacios en blanco
        $question = trim($_POST['question']);
        $answer = trim($_POST['answer']);

        # Formando la URL de regreso
        $data = 'question='.$question.'&answer='.$answer;

        if(empty($question) || $question == ''){
            $em = 'La pregunta es requerida.';
            header("Location: ../../admin/add-qa.php?error=$em&$data");
            exit;
        }else if(empty($answer) || $answer == ''){
            $em = 'La respuesta es requerida.';
            header("Location: ../../admin/add-qa.php?error=$em&$data");
            exit;
        }else{
            # Agregando la QA a la base de datos
            $sql = 'INSERT INTO xoochbot (pregunta, respuesta) VALUES (?,?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$question, $answer]);

            $sm = 'Pregunta-Respuesta agregada correctamente.';
            header("Location: ../../admin/add-qa.php?success=$sm");
            exit;
        }
    }
?>