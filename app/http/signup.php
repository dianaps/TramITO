<?php

include '../constants/messages.php';

# check if username, password, name submitted
if (isset($_POST['username']) &&
 isset($_POST['password']) &&
 isset($_POST['name']) &&
 isset($_POST['last_name']) &&
 isset($_POST['email'])) {

 # database connection file
 include '../db.conn.php';

 # get data from POST request and store them in var
 $name      = $_POST['name'];
 $last_name = $_POST['last_name'];
 $password  = $_POST['password'];
 $username  = $_POST['username'];
 $email     = $_POST['email'];

 # making URL data format
 $data = 'name=' . $name . '&last_name=' . $last_name . '&username=' . $username . '&email=' . $email;

 #simple form Validation
 if (empty($name)) {
  # error message
  $em = Messages::ERR_NAME_REQUIRED;

  # redirect to 'signup.php' and passing error message
  header("Location: ../../signup.php?error=$em");
  exit;
 } else if (empty($last_name)) {
  # error message
  $em = Messages::ERR_LAST_NAME_REQUIRED;

  /*
  redirect to 'signup.php' and
  passing error message and data
   */
  header("Location: ../../signup.php?error=$em&$data");
  exit;
 } else if (empty($username)) {
  # error message
  $em = Messages::ERR_USERNAME_REQUIRED;

  /*
  redirect to 'signup.php' and
  passing error message and data
   */
  header("Location: ../../signup.php?error=$em&$data");
  exit;

 } else if (empty($email)) {
  $em = Messages::ERR_EMAIL_REQUIRED;
  header("Location: ../../signup.php?error=$em&$data");
  exit;

 } else if (empty($password)) {
  # error message
  $em = Messages::ERR_PASSWORD_REQUIRED;

  /*
  redirect to 'signup.php' and
  passing error message and data
   */
  header("Location: ../../signup.php?error=$em&$data");
  exit;
 } else {
  # checking the database if the username is taken
  $sql = "SELECT username
   	          FROM users
   	          WHERE username=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username]);

  if ($stmt->rowCount() > 0) {
   $em = Messages::ERR_USERNAME_ALREADY_EXISTS;
   header("Location: ../../signup.php?error=$em&$data");
   exit;

  }
  # checking the database if the email is taken
  $sql = "SELECT email
   	          FROM users
   	          WHERE email=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$email]);

  if ($stmt->rowCount() > 0) {
   $em = Messages::ERR_EMAIL_ALREADY_EXISTS;
   header("Location: ../../signup.php?error=$em&$data");
   exit;

  }
 }
 # Profile Picture Uploading
 if (isset($_FILES['pp'])) {
  # get data and store them in var
  $img_name = $_FILES['pp']['name'];
  $tmp_name = $_FILES['pp']['tmp_name'];
  $error    = $_FILES['pp']['error'];

  # if there is not error occurred while uploading
  if ($error === 0) {

   # get image extension store it in var
   $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);

   /*
   convert the image extension into lower case
   and store it in var
    */
   $img_ex_lc = strtolower($img_ex);

   /*
   crating array that stores allowed
   to upload image extension.
    */
   $allowed_exs = array("jpg", "jpeg", "png");

   /*
   check if the the image extension
   is present in $allowed_exs array
    */
   if (in_array($img_ex_lc, $allowed_exs)) {
    /*
    renaming the image with user's username
    like: username.$img_ex_lc
     */
    $new_img_name = $username . '.' . $img_ex_lc;

    # crating upload path on root directory
    $img_upload_path = '../../uploads/' . $new_img_name;

    # move uploaded image to ./upload folder
    move_uploaded_file($tmp_name, $img_upload_path);
   } else {
    $em = Messages::ERR_INCORRECT_FILE_EXTENSION;
    header("Location: ../../signup.php?error=$em&$data");
    exit;
   }

  }
 }

 // password hashing
 $password = password_hash($password, PASSWORD_DEFAULT);

 # if the user upload Profile Picture
 if (isset($new_img_name)) {

  # inserting data into database
  $sql = "INSERT INTO users
                    (username, password, p_p, email)
                    VALUES (?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username, $password, $new_img_name, $email]);
 } else {
  # inserting data into database
  $sql = "INSERT INTO users
                    (username, password, email)
                    VALUES (?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username, $password, $email]);
 }

 # success message
 $sm = Messages::SCS_CREATION_ACCOUNT;

 # redirect to 'index.php' and passing success message
 header("Location: ../../index.php?success=$sm");
 exit;
} else {
 header("Location: ../../signup.php");
 exit;
}
