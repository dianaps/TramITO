<?php
session_start();

if (isset($_SESSION['username'])) {
 # database connection file
 include 'app/db.conn.php';
 include 'app/helpers/user.php';
 include 'app/helpers/conversations.php';
 include 'app/helpers/timeAgo.php';
 include 'app/helpers/last_chat.php';
 include 'app/constants/messages.php';

 # Getting User data
 $user = getUser($_SESSION['user_id'], $_SESSION['role'], $conn);

 # Getting User conversations
 $conversations = getConversation($user['user_id'], $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TramITO</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet"
			href="css/style.css">
		<link rel="icon" href="img/logo-buho.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="">
		<?php include "sections/header.php"?>
		<!-- Encabezado -->
		<div id class="p-5 text-center bg-light">
			<!-- <h1 class="mb-3">TramITO</h1> -->
			<img src="img/logo-nombre.png" class="img-fluid" alt="">
		</div>
		<!-- Encabezado -->

		<div class="d-flex
             justify-content-center
             align-items-center">

			 <div class="p-2 w-400
			 rounded shadow">
				<div class="d-flex
							mb-3 p-3 bg-light
							justify-content-between
							align-items-center">
					<div class="d-flex
								align-items-center">
						<img src="uploads/<?=$user['p_p']?>"
							class="w-25 rounded-circle">
						<?php
if ($_SESSION['role'] == 'student') {
  ?>
						<h3 class="fs-xs m-2"><?php echo $user['name'] . " " . $user['last_name'] ?></h3>
						<?php
} else {
  ?>
						<h3 class="fs-xs m-2"><?=$user['department_name']?></h3>
						<?php
}
 ?>
					</div>
				</div>

				<!-- Eliminar el cuadro de busqueda -->
				<div class="input-group mb-3">
					<input type="text"
						placeholder="Buscar..."
						id="searchText"
						class="form-control">
					<button class="btn btn-primary"
							id="serachBtn">
							<i class="fa fa-search"></i>
					</button>
				</div>
				<ul id="chatList"
					class="list-group mvh-50 overflow-auto">
					<?php if (!empty($conversations)) {?>
						<?php foreach ($conversations as $conversation) {?>
						<li class="list-group-item">
							<a href="chat.php?user=<?=$conversation['user_id']?>"
							class="d-flex
							justify-content-between
							align-items-center p-2">
								<div class="d-flex align-items-center">
									<img src="uploads/<?=$conversation['p_p']?>"
										class="w-10 rounded-circle">
									<h3 class="fs-xs m-2">
										<!-- Cambian los campos dependiendo del rol  -->
										<?php
$user_extra_data = getUser($conversation['user_id'], $conversation['role'], $conn);
  if ($_SESSION['role'] == 'student') {
   echo $user_extra_data['department_name'];
  } else {
   echo $user_extra_data['name'] . " " . $user_extra_data['last_name'];
  }
  ?>
										<br>
										<small>
											<?php echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn); ?>
										</small>
									</h3>
								</div>
								<?php if (last_seen($conversation['last_seen']) == "Active") {?>
									<div title="online">
										<div class="online"></div>
									</div>
								<?php }?>
							</a>
						</li>
						<?php }?>
					<?php } else {?>
						<div class="alert alert-info
									text-center">
						<i class="fa fa-comments d-block fs-big"></i>
						<?php echo Messages::EMPTY_MESSAGES; ?>
						</div>
					<?php }?>
				</ul>
			</div>
		</div>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function(){

			// Search
			$("#searchText").on("input", function(){
				var searchText = $(this).val();
				if(searchText == "") return;
			$.post('app/ajax/search.php',
					{
						key: searchText
					},
				function(data, status){
					$("#chatList").html(data);
				});
		});

		// Search using the button
		$("#serachBtn").on("click", function(){
			var searchText = $("#searchText").val();
			if(searchText == "") return;
			$.post('app/ajax/search.php',
					{
						key: searchText
					},
				function(data, status){
					$("#chatList").html(data);
				});
		});


		/**
		 auto update last seen
		for logged in user
		**/
		let lastSeenUpdate = function(){
			$.get("app/ajax/update_last_seen.php");
		}
		lastSeenUpdate();
		/**
		 auto update last seen
		every 10 sec
		**/
		setInterval(lastSeenUpdate, 10000);

		});
	</script>
	</body>
</html>
<?php
} else {
 header("Location: index.php");
 exit;
}
?>