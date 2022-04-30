<?php
session_start();
if (isset($_SESSION['username'])) {
 # database connection file
 include 'app/db.conn.php';
 include 'app/helpers/user.php';
 include 'app/helpers/chat.php';
 include 'app/helpers/opened.php';
 include 'app/helpers/timeAgo.php';

 if (!isset($_GET['user']) || !isset($_GET['role'])) {
  header("Location: home.php");
  exit;
 }

 # Getting User data data
 $chatWith = getUser($_GET['user'], $_GET['role'], $conn);
 if (empty($chatWith)) {
  header("Location: home.php");
  exit;
 }

 $chats = getChats($_SESSION['user_id'], $chatWith['user_id'], $conn);
 opened($chatWith['user_id'], $conn, $chats);

//   header("Location: home.php");
 //   exit;

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
	<script src="https://kit.fontawesome.com/66b2a98c0c.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include "sections/header.php"?>

<div class="d-flex
             justify-content-center
             align-items-center">
    <div class="w-400 shadow p-4 rounded">
    	<a onclick = "window.history.back();"
    	   class="fs-4 link-dark btn"><span class="fa solid fa-arrow-left"></span></a>

    	   <div class="d-flex align-items-center">
    	   	  <img src="uploads/<?=$chatWith['p_p']?>"
    	   	       class="w-15 rounded-circle">

               <h3 class="display-4 fs-sm m-2">
<?php if ($_SESSION['role'] == 'student') {
  echo $chatWith['department_name'];
 } else {
  echo $chatWith['name'] . $chatWith['last_name'];

 }
 ?>
					 <br>
               	  <div class="d-flex
               	              align-items-center"
               	        title="online">
               	    <?php
if (last_seen($chatWith['last_seen']) == "Active") {
  ?>
               	        <div class="online"></div>
               	        <small class="d-block p-1"><?php echo Messages::STATUS_ONLINE; ?></small>
               	  	<?php } else {?>
               	         <small class="d-block p-1">
               	         	<?php echo Messages::LAST_SEEN; ?>
               	         	<?=last_seen($chatWith['last_seen'])?>
               	         </small>
               	  	<?php }?>
               	  </div>
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
                <div id="empty_chat" class="alert alert-info
    				            text-center">
				   <i class="fa fa-comments d-block fs-big"></i>
	               <?php echo Messages::EMPTY_MESSAGES; ?>
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
</div>
 </body>
 </html>
<?php
} else {
 header("Location: index.php");
 exit;
}
?>