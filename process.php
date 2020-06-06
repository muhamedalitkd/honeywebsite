<?php
	include("conn.php");
	session_start();
	if (isset($_POST['email_check'])) {
		$email = $_POST['email'];
		$sql = "SELECT * FROM users WHERE email='$email'";
		$results = mysqli_query($db, $sql);
		if (mysqli_num_rows($results) > 0) {
			echo "not_available";
		}else{
			echo "available";
		}
		exit();
		}

		if (isset($_POST['save'])) {
			$stmt = $db -> prepare("INSERT INTO users(username, email, password, usertype) VALUES (?, ?, ?, ?) ");
			$stmt->bind_param("ssss",$username, $email, $password, $type);

			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			$type = "Customer";

			$stmt->execute();
			$stmt->close();
			mysqli_close($db);

			echo "Registered Successfully";
			exit();
		}
		
 //if there is a file selected via file uploader, then execute the below coe
if (isset($_FILES["pI"]["name"])) {
			$imagelocation= "images/".basename($_FILES['pI']['name']);
			$extension = pathinfo($imagelocation,PATHINFO_EXTENSION);

			if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
				echo"Uncrecognized file format.";
			}
			else
			{
				if(move_uploaded_file($_FILES['pI']['tmp_name'],$imagelocation) )
				{
					$stmt = $db -> prepare("INSERT INTO products (productName, productPrice, productDesc, productPhoto) VALUES (?,?,?,?)");
					$stmt->bind_param("ssss", $pName, $pPrice, $pDesc, $imagelocation);

					$pName = $_POST['pN']; 
					$pPrice = $_POST['pP']; 
					$pDesc = $_POST['pD'];

					$stmt->execute();
					$stmt->close();
					mysqli_close($db);

					echo "Registered Sucessfully"; 
				}
				else
				{
					echo "Unable to reg";
				}
			}
		}

//login
if (isset($_POST['login'])) {
		$stmt = $db -> prepare("select usertype from users where username =? and password =?");
		$stmt->bind_param("ss",$uname,$pword);
		
		$uname = $_POST['uName'];
		$pword = md5($_POST['pWord']);
		
		//execute sql & close connection
		$stmt->execute();
		$stmt->bind_result($usertype);
		$stmt->store_result();
		if($stmt->fetch()) //fetching the contents of the row
		{
			$_SESSION['name'] = $uname;
			$_SESSION['role'] = $usertype;
			echo $_SESSION['role'];
		}
		else 
		{
			echo "Incorrect username or password";
		}  
		$stmt->close();
		mysqli_close($db);
		exit();
}


//search product name

	if (isset($_POST['search_prod'])) {
		$name = $_POST['searchName'];
		$query = "select * from products where productName like '%$name%'";
		$execQuery = mysqli_query($db, $query);
		while ($result = mysqli_fetch_array($execQuery))
		{
			?>
			<a onclick = 'insert("<?php echo $result['productName']; ?>")'>
				<?php echo $result['productName'];
				?><br/>
			</a>
			<?php
		}
	}	
//display product name
	if (isset($_POST['display_product'])) { //['di
		$name = $_POST['searchName'];
		$query = "select * from products where productName = '$name'"; //select * from products; (for catalogue)
		$execQuery = mysqli_query($db, $query);
		while ($result = mysqli_fetch_array($execQuery))
		{
			?>
			<table width="100%">
				<tr>
					<td><b>Name</b></td>
					<td><b>Price</b></td>
					<td><b>Description</b></td>
					<td><b>Photo</b></td>
				</tr>
				<tr>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['productPrice']; ?></td>
					<td><?php echo $result['productDesc']; ?></td>
					<td><img src="<?php echo $result['productPhoto']; ?>" height = "200" width="200"></td>
					</tr>
					</table>
					<?php	
		}
			exit();
}

//edit product
if (isset($_POST['edit_product'])) {
			$name = $_POST['searchName'];
			$query = "select * from products where productName = '$name'";
			$execQuery = mysqli_query($db, $query);
			while ($result = mysqli_fetch_array($execQuery))
			{
				?>
				<table class="table table-hover">
					<tr scope = "col">
						<th>Name</th>
						<th>Price</th>
						<th>Description</th>
					</tr>
					<tr>
						<td><?php echo $result['productName']; ?> </td>
						<td><input type="text" id="newPrice" value ="<?php echo $result['productPrice'];?>"></td>
						<td><textarea rows="3" columns="20" id="newDesc"><?php echo $result['productDesc'];?></textarea></td>
						</tr>
					</table>
					<?php
			}
		
		exit();
	}
//save edited product
	if (isset($_POST['save_edit'])) {
		$stmt = $db -> prepare("update products set productPrice=?, productDesc=? where productName=?");
		$stmt->bind_param("sss", $newPrice, $newDesc, $name);
		$newPrice = $_POST['nP'];
		$newDesc = $_POST['nD'];
		$name = $_POST['searchName'];
		$stmt->execute();
		$stmt->close();
		mysqli_close();
		echo "Updated Successfully!";
		exit();
	}
//delete product
	if (isset($_POST['del'])) {
		$stmt = $db -> prepare("delete from products where productName =?");
		$stmt->bind_param("s",$name);
		$name = $_POST['nm'];
		$stmt->execute();
		$stmt->close();
		mysqli_close();
		echo "deleted Successfully!";
		exit();
		}
// display catalogue
	if (isset($_POST['display_catalogue'])) { //['di
		$query = "select * from products"; //select * from products; (for catalogue)
		$execQuery = mysqli_query($db, $query);
		echo "<table class='table' style='margin-top: 80px; background:#bd8787'>";
		echo "	
			<thead>
				<tr>
					<th scope='col'>Name</td>
					<th scope='col'>Price</td>
					<th scope='col'>Description</td>
					<th scope='col'>Photo</td>
				</tr>
			</thead>
			<tbody>
		";
		while ($result = mysqli_fetch_array($execQuery))
		{
			?>
				<tr>
					<td scope="row"><?php echo $result['productName']; ?></td>
					<td><?php echo $result['productPrice']; ?></td>
					<td><?php echo $result['productDesc']; ?></td>
					<td><img src="<?php echo $result['productPhoto']; ?>" height = "200" width="200"></td>
				</tr>
			<?php	
		}
		echo "</tbody></table>";
			exit();
}

?>