<?php
session_start();
if (isset($_SESSION['username'])) {
 # database connection file
 include 'app/db.conn.php';

 include 'app/helpers/user.php';
 include 'app/helpers/chat.php';
 include 'app/helpers/opened.php';

 include 'app/helpers/timeAgo.php';

 # Getting User data data
 $chatWith = getUser('xoochbot', $conn);

 if (empty($chatWith)) {
  header("Location: home.php");
  exit;
 }

 $chats = getChats($_SESSION['user_id'], $chatWith['user_id'], $conn);

 opened($chatWith['user_id'], $conn, $chats);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TramITO - Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet"
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="">

	<?php include "sections/header.php"?>
	<!-- Encabezado -->
	<div id class="p-5 text-center bg-light">
		<h1 class="mb-3">TramITO</h1>
	</div>
	<!-- Encabezado -->

	<!-- ChatBot -->
	<div class="d-flex
             justify-content-center
             align-items-center">
    <div class="w-400 shadow p-4 rounded">
    	   <div class="d-flex align-items-center">
    	   	  <img src="uploads/<?=$chatWith['p_p']?>"
    	   	       class="w-15 rounded-circle">

               <h3 class="display-4 fs-sm m-2">
               	  <?=$chatWith['name']?>

               </h3>
    	   </div>

    	   <div class="shadow p-4 rounded
    	               d-flex flex-column
    	               mt-2 chat-box"
    	        id="chatBox">
    	        <?php
if (!empty($chats)) {
  foreach ($chats as $chat) {
   if ($chat['from_id'] == $_SESSION['user_id']) {?>
						<p class="rtext align-self-end
						        border rounded p-2 mb-1">
						    <?=$chat['message']?>
						    <small class="d-block">
						    	<?=$chat['created_at']?>
						    </small>
						</p>
                    <?php } else {?>
					<p class="ltext border
					         rounded p-2 mb-1">
					    <?=$chat['message']?>
					    <small class="d-block">
					    	<?=$chat['created_at']?>
					    </small>
					</p>
                    <?php }
  }
 } else {?>
               <div class="alert alert-info
    				            text-center">
				   <i class="fa fa-comments d-block fs-big"></i>
	               No hay mensajes aún
			   </div>
    	   	<?php }?>
    	   </div>
    	   <div class="input-group mb-3">
    	   	   <textarea cols="3"
    	   	             id="message"
    	   	             class="form-control"></textarea>
    	   	   <button class="btn btn-primary"
    	   	           id="sendBtn">
    	   	   	  <i class="fa fa-paper-plane"></i>
    	   	   </button>
    	   </div>

    </div>
	</div>
 	<!-- ChatBot -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
	var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){

      $("#sendBtn").on('click', function(){
      	message = $("#message").val();
      	if (message == "") return;

      	$.post("app/ajax/insert.php",
      		   {
      		   	message: message,
      		   	to_id: <?=$chatWith['user_id']?>
      		   },
      		   function(data, status){
                  $("#message").val("");
                  $("#chatBox").append(data);
                  scrollDown();
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



      // auto refresh / reload
      let fechData = function(){
      	$.post("app/ajax/getMessage.php",
      		   {
      		   	id_2: <?=$chatWith['user_id']?>
      		   },
      		   function(data, status){
                  $("#chatBox").append(data);
                  if (data != "") scrollDown();
      		    });
      }

      fechData();
      /**
      auto update last seen
      every 0.5 sec
      **/
      setInterval(fechData, 500);

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