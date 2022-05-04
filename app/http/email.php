<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

function sendMail($email, $new_password)
{
 $mail = new PHPMailer(true);

 // Sender data
 $host          = 'smtp.gmail.com';
 $from_email    = 'grupotramito@gmail.com';
 $from_name     = 'TramITO';
 $from_password = '@5PgSs9M%LUd';
 $port          = 587;

 // Mail content
 $subject = 'Recuperación de contraseña TramITO';
 $body    = 'Tu contraseña temporal es:  <b>' . $new_password . '</b>. Recomendamos actualizar la contraseña inmediatamente.';
 $altBody = "Tu contraseña temporal es: '" . $new_password . "'. Recomendamos actualizar la contraseña inmediatamente.";

 try {
  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
  $mail->isSMTP(); //Send using SMTP
  $mail->Host       = $host; //Set the SMTP server to send through
  $mail->SMTPAuth   = true; //Enable SMTP authentication
  $mail->Username   = $from_email; //SMTP username
  $mail->Password   = $from_password; //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable implicit TLS encryption
  $mail->Port       = $port; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom($from_email, $from_name);
  $mail->addAddress($email); //Name is optional

  //Content
  $mail->isHTML(true); //Set email format to HTML
  $mail->Subject = $subject;
  $mail->Body    = $body;
  $mail->AltBody = $altBody;

  $mail->send();
  return true;
 } catch (Exception $e) {
  return false;
//   echo "No se pudo enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
 }
 return false;
}
