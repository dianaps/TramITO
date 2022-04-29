<?php

function getDepartments($conn)
{
 /*
 Getting all the departments
  */
 $sql = "SELECT * FROM users
            INNER JOIN departments ON users.user_id=departments.user_id
            ORDER BY departments.department_name DESC";

 $stmt = $conn->prepare($sql);
 $stmt->execute();

 if ($stmt->rowCount() > 0) {
  $departments = $stmt->fetchAll();
  return $departments;
 } else {
  $departments = [];
  return $departments;
 }

}
