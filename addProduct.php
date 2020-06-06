<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if($_SESSION['role']!="Admin")
header("location:login.php");
?>
<head>
<meta charset="UTF-8"><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<link rel="stylesheet" href="search.css"/>
<link href="jquery-ui.css" rel="stylesheet" />
<title>Add Product</title>
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
				<a class="nav_link" href="#">About Us</a>
				<a class="nav_link" href="catalogue.php">Catalogue</a>
				<a class="nav_link" href="search.php">Search</a>
				<a class="nav_link" href="#">Contact Us</a>
				<a class="nav_link" href="registration.php">Register</a>
				<?php
            if (isset($_SESSION['name']) && $_SESSION['role']=="Admin")
            {
              ?>
				<a class="nav_link active" href="addProduct.php">Add Product</a>
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


<div class="content">
<section class="py-5">
	<div class="container">
		<form id="frmAddProduct">
		<h1>Add Product</h1>
		<table>
		<tr>
		<td>Product Name:</td>
		<td><input type="text" id="prodName" name="pN" required/></td>
		</tr>
		<tr>
		<td>Product Price:</td>
		<td><input type="text" id="productPrice" name="pP" required/></td>
		</tr>
		<tr>
		<td>Product Description: </td>
		<td><textarea rows="3" id="prodDesc" name="pD"></textarea></td>
		</tr>
		<tr>
		<td>Product Image :</td>
		<td><input type="file" id="prodImg" name="pI"/></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Add" name="btnSubmit"></td>
		</tr>
		</table>
		</form>
		</div>
	</section></div>


	<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
     $("document").ready(function(){
      $("#frmAddProduct").on('submit',(function(e){
        e.preventDefault();

        var fdata = new FormData(this);

        $.ajax({
          url: "process.php",
          type: "POST",
          data: fdata,
          contentType: false,
          cache: false,
          processData: false,
          success: function(response)
          {
            alert(response);
            $("#prodName").val('');
            $("#prodPrice").val('');
            $("#prodDesc").val('');
            $("#prodImg").val('');
          }
        });
      }));
    });
    </script>
  </body>

</html>
