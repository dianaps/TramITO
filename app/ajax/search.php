<?php
include '../constants/messages.php';

session_start();

# check if the user is logged in
if (isset($_SESSION['username'])) {
 # check if the key is submitted
 if (isset($_POST['key'])) {
  # database connection file
  include '../db.conn.php';

  # creating simple search algorithm :)
  $key = "%{$_POST['key']}%";

//  Si es estudiante sólo podrá hablar con departamentos
  if (strcmp($_SESSION['role'], 'student') === 0) {
   $sql = "SELECT * FROM users
              INNER JOIN departments ON users.user_id=departments.user_id
	           WHERE departments.department_name LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key]);
  } else {
   $sql = "SELECT * FROM users
              INNER JOIN students ON users.user_id=students.user_id
	           WHERE users.username
	           LIKE ? OR students.name LIKE ? OR students.last_name LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key]);

  }

  if ($stmt->rowCount() > 0) {
   $users = $stmt->fetchAll();

   foreach ($users as $user) {
    if ($user['user_id'] == $_SESSION['user_id']) {
     continue;
    }

    ?>
       <li class="list-group-item">
		<a href="chat.php?user=<?=$user['user_id']?>&role=<?=$user['role']?>"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">

			    <img src="uploads/<?=$user['p_p']?>"
			         class="w-10 rounded-circle">

			    <h3 class="fs-xs m-2">
			    	<?php
//  Si el usuario es estudiante solo podra comunicarse con departamentos
    if ($_SESSION['role'] == 'student') {
     echo $user['department_name'];
    } else {
     echo $user['name'] . " " . $user['last_name'];
    }

    ?>
			    </h3>
			</div>
		 </a>
	   </li>
       <?php }} else {?>
         <div class="alert alert-info
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
         <?php echo sprintf(Messages::ERR_USER_NOT_FOUND, htmlspecialchars($_POST['key'])); ?>
		</div>
    <?php }
 }

} else {
 header("Location: ../../index.php");
 exit;
}