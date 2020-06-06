<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="honeycss.css"/>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<title>HONEY KG</title>
</head>

<body>


<!-- Navigation Bar -->
<header class="header" style="border: 0;">
<div class="fixed-nav-bar">
	<div class="container" >
		<div class="header_inner">
			<div class="header_logo">HoneyKG</div>
			
			<nav class="nav">
				<a class="nav_link active" href="main.php">Menu</a>
				<a class="nav_link" href="#" id="about_us" >About Us</a>
				<a class="nav_link" href="catalogue.php">Catalogue</a>
				<a class="nav_link" href="search.php">Search</a>
				<a class="nav_link" href="#" id="contact_us">Contact Us</a>
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


<div class="intro">
	<div class="container">
	<div class="intro_inner">
	<h1 class="intro_title">WELCOME TO HONEY KG</h1>
	<h2 class="intro_subtitle">Your Best Choice of Honey</h2>
	
	<a class="ctl" href="catalogue.php">Catalogue</a>
	</div>
		<div class="slider">
			<div class="slider_item active">
			<span class="slider_num">1</span>
				Menu
			</div>
			<div class="slider_item">
			<span class="slider_num">2</span>
				About Us
			</div>
			<div class="slider_item">
			<span class="slider_num">3</span>
				Contact Us
				</div>
			</div>
		</div>
	</div>
	
	
	<section class="section" id="section_about_us">
		<div class="container">
			<div class="section_header">
			<h3 class="section_title">What We Do?</h3>
			<div class="section_text"><p>We provide the best honey in the world straight from the Kyrgyzstan. <br>Our mission is to provide 100% natural honey for our
			beloved customers.<br> Our vision is to take over the whole honey market in the world. <h3>Our motto: Get honey - be happy</h3> </p>
			</div>
			</div>
			<div class="about">
				<div class="about_item">
					<div class="about_image">
						<img src="123123.PNG" style="max-width:100%;height:auto;">
											</div>
				</div>
				<div class="about_item"><div class="about_image">
						<img src="111.PNG" style="max-width:100%;height:auto;">
											</div>
				</div>
				</div>
		</div>
	</section>
	<div class="ctitle">Fill up the form and We will contact You</div>
	<div class="message">


<section class="py-5" id="section_contact_us">
	<div class="container">
		<form action="#" method="post">
	<label for="name">Name</label>
	<input type="text" id="txtName" name="name" placeholder="Your name..">
	<br>
	<label for="email">Email</label>
	<input type="text" id="txtEmail" name="email" placeholder="Your email.">
	<br>
	<label for="comments">Commentaries</label>
	<textarea id="txtComment" name="comments" placeholder="Write something.." style="height:auto"></textarea>
	<br>
	<input type="submit" value="Submit" id="btnSubmit">
	</form>
		</div>
	</section>
</div>
<footer>


<!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    	$(document).ready(function(){
    		$("#btnSubmit").click( function() {
				alert ("Message was sent");
          var isValid = true;
          $('input[type="text"]').each(function(){
            if ($.trim($(this).val()) == '') {
              isValid = false;
              $(this).css({
                "border": "1px solid red",
                "background": "#FFCECE"
              });
            }
            else {
              $(this).css({
                "border": "",
                "background": ""
              });
            }
           });  
        if (isValid == false)
          e.preventDefault();
        else
          alert ("Thank you "+$("#txtName").val()+" for your feedback");
      });

  });
    </script>



	<div class="ftext">Copyright &copy; All Rights Reserved by Mukhamed-Ali and Adilet 	
		<!-- Add icon library -->
			<span><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

				<!-- Add font awesome icons -->
				<a href="http://facebook.com" class="fa fa-facebook" style="max-width:100%;height:auto;"></a>
				<a href="http://instagram.com" class="fa fa-instagram" style="max-width:100%;height:auto;"></a>
				<a href="http://whatsapp.com" class="fa fa-whatsapp" style="max-width:100%;height:auto;"></a></span>	
	</div>
</footer>
<script>
	$("#about_us").click(function() {
		$('html,body').animate({
			scrollTop: $("#section_about_us").offset().top},
			'slow');
	});
	$("#contact_us").click(function() {
		$('html,body').animate({
			scrollTop: $("#section_contact_us").offset().top},
			'slow');
	});
</script>
</body>

</html>
