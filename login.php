<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<link rel="stylesheet" href="logincss.css"/>
<link href="jquery-ui.css" rel="stylesheet" />
<title>Log In</title>
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
				<a class="nav_link" href="registration.php">Register</a>
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
				<a class="nav_link active" href="login.php">Login</a>
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


<section class="py-5">
	<div class="container">
		<form class="box" action="index.html" method="post">
		<h1>Login</h1>
		<input type="text" placeholder="Username" id="username" required /> <br/>
		<input type="password" placeholder="Password" id="password" required /> <br/>
		<input type="button" id="btnLogin" value="Login"></input><br/>
		</form>
		</div>
	</section>



<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
      $("document").ready(function(){
        $("#btnLogin").click(function(){
      var un = $("#username").val();
      var pw = $("#password").val();

          $.ajax ({
          url: "process.php",
          type: "POST",
          data:	{
          		login:1,
          		uName: un,
          		pWord: pw,
          		},
          	success: function(respond) {
          		if(respond ==="Customer")
          		//redirects customer to this page after logged in
          			window.location.href="catalogue.php";
          		//redirects admin to add product
          		else if(respond ==="Admin")
          			window.location.href="addProduct.php";
          		else
          			alert(respond);
          }
         });
     });
});
</script>



</body>

</html>
