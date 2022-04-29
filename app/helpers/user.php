<?php

function getUser($user_id, $role, $conn)
{
 if (strcmp($role, 'student') === 0) {
  $sql = "SELECT * FROM users
           JOIN students ON users.user_id=students.user_id
           WHERE users.user_id=?";
 } else if (strcmp($role, 'department') === 0) {
  $sql = "SELECT * FROM users
           JOIN departments ON users.user_id=departments.user_id
           WHERE users.user_id=?";
 }
 $stmt = $conn->prepare($sql);
 $stmt->execute([$user_id]);
 if ($stmt->rowCount() === 1) {
  $user = $stmt->fetch();
  return $user;
 } else {
  $user = [];
  return $user;
 }
}
