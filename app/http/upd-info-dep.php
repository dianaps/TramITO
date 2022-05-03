<?php

session_start();

# Conexión a la BD
include '../db.conn.php';

# Incluyendo el archivo que contiene los mensajes
include '../constants/messages.php';

# Verificando si el usuario mantiene abierta la sesión
if (isset($_SESSION['username'])) {

 if ($_SESSION['role'] === 'student') {
  if (isset($_POST['name']) &&
   isset($_POST['last_name']) &&
//    isset($_POST['username']) &&
   isset($_POST['email']) &&
//    isset($_POST['career']) &&
   isset($_POST['semester'])) {

   # Obteniendo todos los datos
   //    $username   = trim($_POST['username']);
   //    $career   = trim($_POST['career']);
   $name      = trim($_POST['name']);
   $last_name = trim($_POST['last_name']);
   $email     = trim($_POST['email']);
   $semester  = trim($_POST['semester']);

   # Formando el URL
   $data = 'name=' . $name . 'last_name=' . $last_name . '&email=' . $email . 'semester=' . $semester;

   # Verificando si los datos no se encuentran vacíos
   if (empty($name)) {
    # Mensaje de error
    $em = Messages::ERR_NAME_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   }
   if (empty($last_name)) {
    # Mensaje de error
    $em = Messages::ERR_LAST_NAME_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($email)) {
    # Mensaje de error
    $em = Messages::ERR_EMAIL_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($semester)) {
    # Mensaje de error
    $em = Messages::ERR_SEMESTER_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else {
    # Verificando si el email ya ha sido registrado
    $sql = "SELECT email
                            FROM users
                            WHERE email = ? AND user_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
     # Mensaje de error
     $em = Messages::ERR_EMAIL_ALREADY_EXISTS;

     # Redireccionando a 'update-info' y pasando el mensaje de error
     header("Location: ../../update-info.php?error=$em&$data");
     exit;
    }

    # Preparando la actualización y ejecutándola en la tabla 'users'
    $sql = "UPDATE users
                    SET email = ?
                    WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $_SESSION['user_id']]);

    # Preparando la actualización y ejecutándola en la tabla 'departments'
    $sql = "UPDATE students
                    SET name = ?, last_name = ?, semester = ?
                    WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, $last_name, $semester, $_SESSION['user_id']]);
    # Mensaje de éxito
    $sm = Messages::SCS_INFO_UPDATE;

    # Redirección a 'update-info' y pasando el mensaje de éxito
    header("Location: ../../update-info.php?success=$sm");
    exit;
   }
  }
 }

 if ($_SESSION['role'] === 'department') {
  if (isset($_POST['username']) &&
   isset($_POST['email-dep']) &&
   isset($_POST['department']) &&
   isset($_POST['info']) &&
   isset($_POST['boss'])) {

   # Obteniendo todos los datos
   $username   = trim($_POST['username']);
   $email      = trim($_POST['email-dep']);
   $department = trim($_POST['department']);
   $info       = trim($_POST['info']);
   $boss       = trim($_POST['boss']);

   # Formando el URL
   $data = 'username=' . $username . '&email=' . $email . '&department=' . $department .
    '&info=' . $info . '&boss=' . $boss;

   # Verificando si los datos no se encuentran vacíos
   if (empty($username)) {
    # Mensaje de error
    $em = Messages::ERR_USERNAME_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($email)) {
    # Mensaje de error
    $em = Messages::ERR_EMAIL_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($department)) {
    # Mensaje de error
    $em = Messages::ERR_NAME_DEPARTMENT_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($info)) {
    # Mensaje de error
    $em = Messages::ERR_INFO_DEPARTMENT_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else if (empty($boss)) {
    # Mensaje de error
    $em = Messages::ERR_BOSS_DEPARTMENT_REQUIRED;

    # Redireccionando a 'update-info' y pasando el mensaje de error
    header("Location: ../../update-info.php?error=$em&$data");
    exit;
   } else {
    # Verificando si el nombre de usuario ya ha sido elegido
    $sql = "SELECT username
                            FROM users
                            WHERE username = ? AND user_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
     # Mensaje de error
     $em = Messages::ERR_USERNAME_ADMIN_ALREADY_EXISTS;

     # Redireccionando a 'update-info' y pasando el mensaje de error
     header("Location: ../../update-info.php?error=$em&$data");
     exit;
    }

    # Verificando si el email ya ha sido registrado
    $sql = "SELECT email
                            FROM users
                            WHERE email = ? AND user_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
     # Mensaje de error
     $em = Messages::ERR_EMAIL_ALREADY_EXISTS;

     # Redireccionando a 'update-info' y pasando el mensaje de error
     header("Location: ../../update-info.php?error=$em&$data");
     exit;
    }

    # Preparando la actualización y ejecutándola en la tabla 'users'
    $sql = "UPDATE users
                            SET username = ?, email = ?
                            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $_SESSION['user_id']]);

    # Preparando la actualización y ejecutándola en la tabla 'departments'
    $sql = "UPDATE departments
                            SET department_name = ?, info = ?, department_head = ?
                            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$department, $info, $boss, $_SESSION['user_id']]);

    # Mensaje de éxito
    $sm = Messages::SCS_INFO_UPDATE;

    # Redirección a 'update-info' y pasando el mensaje de éxito
    header("Location: ../../update-info.php?success=$sm");
    exit;
   }
  }
 }
} else {
 header("Location: ../../index.php");
 exit;
}
