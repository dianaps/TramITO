<?php

# server name
$sName = "localhost";
# user name
$uName = "root";
# password
// $pass = "Contrasena123*";
$pass = "";

# database name
$db_name = "tramito";

#creating database connection
try {
  $conn = new PDO("mysql:host=$sName;dbname=$db_name",
    $uName, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  mysqli_set_charset($conn,"utf8")
} catch (PDOException $e) {
  echo "Connection failed : " . $e->getMessage();
}
