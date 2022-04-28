<?php
session_start();

include '../constants/messages.php';

# check if username & password  submitted
if (isset($_POST['username']) &&
 isset($_POST['password'])) {

 # database connection file
 include '../db.conn.php';

 # get data from POST request and store them in var
 $password = $_POST['password'];
 $username = $_POST['username'];

 #simple form Validation
 if (empty($username)) {
  # error message
  $em = Messages::ERR_USERNAME_REQUIRED;

  # redirect to 'index.php' and passing error message
  header("Location: ../../index.php?error=$em");
 } else if (empty($password)) {
  # error message
  $em = Messages::ERR_PASSWORD_REQUIRED;

  # redirect to 'index.php' and passing error message
  header("Location: ../../index.php?error=$em");
 } else {
  $sql = "SELECT * FROM
               users WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username]);

  # if the username is exist
  if ($stmt->rowCount() === 1) {
   # fetching user data
   $user = $stmt->fetch();

   # if both username's are strictly equal
   if ($user['username'] === $username) {

    # verifying the encrypted password
    if (password_verify($password, $user['password'])) {

     # successfully logged in
     # creating the SESSION
     $_SESSION['username'] = $user['username'];
     $_SESSION['name']     = $user['name'];
     $_SESSION['user_id']  = $user['user_id'];

     # redirect to 'home.php' or 'home-admin'
     if (is_numeric($_SESSION['username'])) {
      header("Location: ../../home.php");
     } else {
      header("Location: ../../home-admin.php");
     }

    } else {
     # error message
     $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

     # redirect to 'index.php' and passing error message
     header("Location: ../../index.php?error=$em");
    }
   } else {
    # error message
    $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

    # redirect to 'index.php' and passing error message
    header("Location: ../../index.php?error=$em");
   }
  } else {
   # error message
   $em = Messages::ERR_INCORRECT_USERNAME_OR_PASSWORD;

   # redirect to 'index.php' and passing error message
   header("Location: ../../index.php?error=$em");
  }
 }
} else {
 header("Location: ../../index.php");
 exit;
}
