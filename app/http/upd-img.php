<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {

 # database connection file
 include '../db.conn.php';

 include '../helpers/user.php';
 include '../constants/domain.php';

 $user = getUser($_SESSION['user_id'], $_SESSION['role'], $conn);

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
    $upload_path     = '../../uploads/';
    $img_upload_path = $upload_path . $new_img_name;
    $old_img_path    = $upload_path . $user['p_p'];

    # delete old path image
    if (file_exists($old_img_path) && $user['p_p'] !== Domain::DEFAULT_P_P) {
     unlink($old_img_path);
    }

    # move uploaded image to ./upload folder
    move_uploaded_file($tmp_name, $img_upload_path);

   } else {
    $em = Messages::ERR_INCORRECT_FILE_EXTENSION;
    header("Location: ../../upd-img.php?error=$em&$data");
    exit;
   }
  }
 }

 # if the user upload Profile Picture
 if (isset($new_img_name)) {

  # inserting data into database
  $sql = "UPDATE users
                        SET (p_p)
                        VALUES (?)
                        WHERE user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$new_img_name, $_SESSION['user_id']]);

 }

 # success message
 $sm = Messages::SCS_CREATION_ACCOUNT;

 # redirect to 'profile.php' and passing success message
 header("Location: ../../profile.php?success=$sm");
 exit;
} else {
 header("Location: ../../profile.php");
 exit;
}
