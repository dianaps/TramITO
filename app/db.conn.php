<?php

# server name
$sName = "localhost";
# user name
$uName = "root";
# password
// $pass = "";
$pass = "ErSg2710";

# database name
$db_name = "tramito";
// $db_name = "tramitov1.2";

#creating database connection
try {
 $conn = new PDO("mysql:host=$sName;dbname=$db_name",
  $uName, $pass);
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 echo "Connection failed : " . $e->getMessage();
}
