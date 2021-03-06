<?php
header("Content-Type: text&html;charset=utf-8");
session_start();
if (isset($_SESSION['username'])) {
 # database connection file
 include 'app/db.conn.php';
 include 'app/helpers/departments.php';
# Getting Departments Data
 $departments = getDepartments($conn);
 ?>
<!DOCTYPE html>
<html lang="es-MX">
	<head>
		<?php include "sections/head-tags.php"?>
		<title>TramITO - Departamentos</title>
		<link rel="stylesheet" href="css/cards.css" />
	</head>
	<body>
		<?php include "sections/header.php"?>
		<!-- Encabezado -->
		<div id class="p-5 text-center bg-light">
			<h1 class="mb-3">Departamentos</h1>
		</div>
		<!-- Encabezado -->
		<div class="container">
			<div class="row m-auto p-0">
				<div class="row justify-content-center">

<?php
if (!empty($departments)) {
  foreach ($departments as $department) {?>
  					<div
						class="card card-custom bg-white border-white border-0 col-xl-3 col-lg-4 col-md-6 col-xs-12 mx-3 mb-4 p-0"
						style="height: 450px"
					>
						<div
							class="card-custom-img"
							style="
								background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);
							"
						></div>
						<div class="card-custom-avatar">
							<img
								class="img-fluid"
								src="uploads/<?=$department['p_p']?>"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title"><?=$department['department_name']?></h4>
							<p class="card-text">
								<?=$department['info']?>
							</p>
						</div>
						<?php
if ($_SESSION['role'] === 'student') {
   ?>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="chat.php?user=<?=$department['user_id']?>" class="btn btn-primary">Chat</a>
						</div>
						<?php
}
   ?>
					</div>
<?php
}
 } else {?>
						<div class="alert alert-info
									text-center">
							<i class="fa fa-comments d-block fs-big"></i>
							<?php echo Messages::EMPTY_DEPARTMENTS; ?>
						</div>
<?php
}
 ?>

				</div>

			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	</body>
</html>
<?php
} else {
 header("Location: index.php");
 exit;
}
?>
