<?php
session_start();
if (isset($_SESSION['username'])) {
 # database connection file
 include 'app/db.conn.php';

 include 'app/helpers/user.php';
 include 'app/helpers/chat.php';
 include 'app/helpers/opened.php';

 include 'app/helpers/timeAgo.php';

 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Departamentos</title>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
		/>
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/cards.css" />
		<link rel="icon" href="img/logo-buho.png" />
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
					<!-- card 1 -->
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto**.
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="chat.php?user=lenguasextranjeras" class="btn btn-primary">Chat</a>
						</div>
					</div>
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto**.
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="#" class="btn btn-primary">Chat</a>
						</div>
					</div>
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto**.
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="#" class="btn btn-primary">Chat</a>
						</div>
					</div>
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto.**
							</p>
							<br>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto.**
							</p>
							<br>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto.**
							</p>
							<br>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto.**
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="#" class="btn btn-primary">Chat</a>
						</div>
					</div>
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto**.
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="#" class="btn btn-primary">Chat</a>
						</div>
					</div>
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
								src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg"
								alt="Avatar"
							/>
						</div>
						<div class="card-body" style="overflow-y: auto">
							<h4 class="card-title">Lenguas extranjeras</h4>
							<p class="card-text">
								**Con php se traerá de la base de datos la descripción del
								depto**.
							</p>
						</div>
						<div
							class="card-footer"
							style="background: inherit; border-color: inherit"
						>
							<a href="#" class="btn btn-primary">Chat</a>
						</div>
					</div>

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
