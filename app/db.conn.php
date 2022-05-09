<?php

# server name
$sName = "localhost";
# user name
$uName = "root";
# password
$pass = "Contrasena123*";
// $pass = "";

# database name
$db_name = "tramito";

#creating database connection
try {
 $conn = new PDO("mysql:host=$sName;dbname=$db_name;charset=utf8",
  $uName, $pass);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo "Connection failed : " . $e->getMessage();
}
