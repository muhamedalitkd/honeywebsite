<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<link rel="stylesheet" href="registercss.css"/>
<link href="jquery-ui.css" rel="stylesheet" />

<title>Registration</title>
</head>
<body>
<!-- Navigation Bar -->
<header class="header" style="border: 0;">
<div class="fixed-nav-bar">
	<div class="container" >
		<div class="header_inner">
			<div class="header_logo">HoneyKG</div>
			
			<nav class="nav">
				<a class="nav_link" href="main.php">Menu</a>
				<a class="nav_link" href="main.php">About Us</a>
				<a class="nav_link" href="catalogue.php">Catalogue</a>
				<a class="nav_link" href="search.php">Search</a>
				<a class="nav_link" href="main.php">Contact Us</a>
				<a class="nav_link active" href="registration.php">Register</a>
				<?php
            if (isset($_SESSION['name']) && $_SESSION['role']=="Admin")
            {
              ?>
				<a class="nav_link" href="addProduct.php">Add Product</a>
				<?php
            }
            ?>
             <?php
            if (!isset($_SESSION['name']))
            {
              ?>
				<a class="nav_link" href="login.php">Login</a>
				<?php
            }
            else
            {
              ?>
				<a class="nav_link" href="logout.php">Log Out</a>
				<?php
            }
            ?>
			</nav> 
		</div></div>
	</div>
</header>
<!-- Background Video -->
<video autoplay muted loop id="myVideo">
  <source src="honeykg.mp4" type="video/mp4">
</video>

<!-- Registration Box -->
<form class="box" action="index.html" method="post">
	<h1>Register</h1>
		 <input type="text" placeholder="Username" id="username" required><br/>
         <input type="email" placeholder="Email" id="email" required><br/> 
         <input type="password" placeholder="Password" id="password" required><br/>
          <div id="msg"></div>
          <input type="button" value="Register" id="btnSubmit">
          <div id="error_msg"></div>

</form>

<!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      $("document").ready(function(){
        var email_state = false;

        $("#email").blur(function(){
          var emailAdd = $("#email").val();
          if(emailAdd == "") {
            email_state = false;
            return;
          }
          $.ajax({
            url: "process.php",
            type: "post",
            data: {
              "email_check" : 1,
              "email" : emailAdd,
            },
            success: function(response){
              if(response == "not_available") {
                email_state = false;
                $("#msg").text("Email already exist!");
              }else if (response == "available") {
                email_state = true;
                $("#msg").text("");
        }
      }
    });
  });
        $("#btnSubmit").click( function(){
          var user_name = $("#username").val();
          var emailAdd = $("#email").val();
          var pass_word = $("#password").val();

          if (email_state == false) {
            $("#error_msg").text("Fix the errors in the form first");
          }else{
            $("#error_msg").text("");
            $.ajax({
              url: "process.php",
              type: "post",
              data: {
                "save" : 1,
                "username" : user_name,
                "email" : emailAdd,
                "password" : pass_word,
              },
              success: function(response){
                alert(response);
                $("#username").val("");
                $("#email").val("");
                $("#password").val("");
              }
            });
          }
        });
      });
    </script>



</body>

</html>
