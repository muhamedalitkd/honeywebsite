<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Montserrat:400,700&mp;subset=cyrillic-ext" rel="stylesheet" />
<link rel="stylesheet" href="search.css"/>
<link href="jquery-ui.css" rel="stylesheet" />
<?php
session_start();
if(!isset($_SESSION['role']))
header("location:login.php");
?>
<title>Search</title>
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
				<a class="nav_link" href="catalogue.php">Catalogue</a>
				<a class="nav_link active" href="search.php">Search</a>
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

  <!-- Page Content -->
  <div class="content">
    <section class="py-5">
      <div class="container">
        <h1>Search Product</h1>
        <b>Product Name :</b> <input type="text" id="search" required />
        <input type="button" id="btnSearch" value="Search"></input><br/>
        <div id="display"></div>
        <div id="test"></div> <!--for catalogue-->
        <input type="button" id="btnEdit" value="Update" style="display: none;"></input>
        <input type="button" id="btnDelete" value="Delete" style="display: none;"></input>
        <input type="button" id="btnSave" value="Save" style="display: none;"></input>
      </div>
    </section></div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
   $("document").ready(function(){ //this for catalogue 
    $("#search").keyup(function(){

      var prodName = $("#search").val();
      if (prodName == "") {
        $("#display").html("");
      }
      else{
        $.ajax({
          type: "POST",
          url: "process.php",
          data: {
            search_prod:1,
            searchName: prodName
          },
          success: function(respond) {
            $("#display").html(respond).show();
            $('#test').hide();
          }
        });
      }
    });

    $("#btnSearch").click(function(){
      var prodName = $("#search").val();
      $.ajax({ //continue from line 63
        type: "POST",
        url: "process.php",
        data: {
          display_product:1,
          searchName: prodName
        },
        success: function(respond) {
          $("#test").html(respond).show();
          $("#display").hide();
          <?php //from here 
          if($_SESSION['role']=="Admin")
          {
            ?>
            $("#btnEdit").show();
            $("#btnDelete").show();
            <?php
          }
          ?> //till here is not required (98-106)
        }
      });
    });//till here for catalogue
  }); // the rest no need

      $("#btnEdit").click(function(){
        var prodName = $("#search").val();
        $.ajax({
          type: "POST",
          url: "process.php",
          data: {
            edit_product:1,
            searchName: prodName
          },
          success: function(respond) {
            $("#test").html(respond).show();
            $("#btnSave").show();
            $("#btnEdit").hide();
            $("#btnDelete").hide();
          }
        });
      });

      $("#btnSave").click(function() {
        var prodName = $("#search").val();
        var nPrice = $("#newPrice").val();
        var nDesc = $("#newDesc").val();

        $.ajax({
          type: "POST",
          url: "process.php",
          data: {
            save_edit:1,
            searchName: prodName,
            nP : nPrice,
            nD : nDesc
          },
          success: function(respond){
            alert(respond);
            $("#btnSave").hide();
          }
        });
      });

      $("#btnDelete").click(function() {
        var prodName = $("#search").val();

        $.ajax({
          type: "POST",
          url: "process.php",
          data: {
            del:1,
            nm: prodName,
          },
          success: function(respond){
            alert(respond);
            $("#search").val('');
            $("#display").hide();
            $("#test").hide();
            $("#btnEdit").hide();
            $("#btnDelete").hide();
          }
        });
      });

   function insert(data) {
    $("#search").val(data);
    $("#display").hide();
   }
    </script>
  </body>

</html>
