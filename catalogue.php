<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="search.css"/>
<link href="jquery-ui.css" rel="stylesheet" />
<?php
session_start();
if(!isset($_SESSION['role']))
header("location:login.php");
?>
<title>Catalogue</title>
<style>
a :hover {
	cursor: pointer ;
	background-color: aqua;
}
</style>
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
				<a class="nav_link active" href="catalogue.php">Catalogue</a>
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

  <!-- Page Content -->
	<div class="container">
	    <div id="display"></div>
    	<div id="catalogue"></div> <!--for catalogue-->
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
   $("document").ready(function(){ //this for catalogue 
      $.ajax({ //continue from line 63
        type: "POST",
        url: "process.php",
        data: {
          display_catalogue:1,
          // searchName: prodName
        },
        success: function(respond) {
          $("#catalogue").html(respond).show();
          $("#display").hide();
        }
      });
    });//till here for catalogue
    </script>
  </body>

</html>
