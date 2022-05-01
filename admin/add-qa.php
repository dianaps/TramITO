<?php
    session_start();

    if(isset($_SESSION['admin_id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Agregar QA</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../img/logo.png">
</head>

<body>
	<?php include "header-admin.php"; ?>
	<!-- Encabezado -->
	<div class="p-5 text-center bg-light">
		<h1 class="mb-3">Gestión del Chatbot</h1>
	</div>
	<!-- Encabezado -->

    <div class="d-flex
             justify-content-center
             align-items-center
             vh-100">
        <div class="w-400 p-5 shadow rounded">
            <form method="post" 
                action="../app/http/insert-qa.php"
                enctype="multipart/form-data">
                <div class="d-flex
                            justify-content-center
                            align-items-center
                            flex-column">

                <img src="../img/logo.png" 
                    class="w-25">
                <h3 class="display-4 fs-1 
                        text-center">
                        Agregar Q&A</h3>   
                </div>

                <?php if (isset($_GET['error'])) {?>
                    <div class="alert alert-warning" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php }
                    if (isset($_GET['success'])) {?>
                    <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
                    </div>
                
                <?php }
                    if (isset($_GET['question'])) {
                        $question = $_GET['question'];
                    }else $question = '';
    
                    if (isset($_GET['answer'])) {
                        $answer = $_GET['answer'];
                    }else $answer = '';
                ?>

            <div class="mb-3">
                <label class="form-label">
                    Pregunta</label>
                <textarea name="question"
                        class="form-control"><?=$question?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Respuesta</label>
                <textarea name="answer"
                    class="form-control"><?=$answer?></textarea>
            </div>
            
            <button type="submit" 
                    class="btn btn-success">
                    Aceptar</button>
            <a href="#">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    }else{
        header("Location: ../index.php");
        exit;
    }
?>