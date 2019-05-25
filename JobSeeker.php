<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION["Username"])){
	$userProfile=$_SESSION["Username"];
	$ut=$_SESSION["Usertype"];
	$flag=1;
}
else{
	$flag=0;
}

// Create connection
$conn = new mysqli("localhost", "root", "", "jobs");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM job_seeker";
$result = mysqli_query($conn, $sql);
?>



<html>
<head>
	<title>Writer</title>
	<link rel="stylesheet" type="text/css" href="all.css">
	<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>

<div class="nav">
<a href="home.html">
<a href="index.html"><img src="logo12.jpg" class="logo"></a>
</a>
<ul class="menu">
<li><a href="index.html">Home</a></li>
			<li><a href="Employer.php">Clients</a></li>
			
			<li><a href="AboutUs.php">About Us</a></li>
			<li><a href='login.php'>Login</a></li>
	<li><a href='register.php'>Register</a></li>
</ul>
</div>
<div class="main">
	<div class="header">
		
		<ul>
			
			
			<?php
			if($flag==1){
				if($ut==1){
					echo "<li><a href='JobSeekerProfile.php' style='background: #ffff99;border-radius:10px'>User: ".$userProfile."</a></li>";
				}
				elseif ($ut==2) {
					echo "<li><a href='EmployerProfile.php' style='background: #ffff99;border-radius:10px'>User: ".$userProfile."</a></li>";
				}
				else{
					echo "<li><a href='AdministratorProfile.php' style='background: #ffff99;border-radius:10px'>User: ".$userProfile."</a></li>";
				}
			}
			
			?>
		</ul>
		
	</div>
	<div class="content"><font color="white">
		<center><h2>Our Writers</h2></center>
		<table class="tt">
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Contact Number</td>
			<td>Address</td>
		</tr>
		<?php
		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$name=$row["Name"];
		    	$email=$row["Email"];
		    	$contact=$row["ContactNo"];
		    	$address=$row["Address"];
		    	echo "<tr><td>$name</td><td>$email</td><td>$contact</td><td>$address</td></tr>";
		    }
		} else {
		    echo "0 results";
		}
		$conn->close();
		?> 
		</table><br>
		<center>New Writer?<a href="JobSeekerReg.php"><font color="greem"> Register here</font></a></center>
		<center>Already a member?<a href="JobSeekerReg.php"><font color="greem"> Login here</font></a></center>
	</font>
</div>
	</header>
</div>

</body>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</html>