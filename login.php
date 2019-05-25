<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION["Message"])){
	$message=$_SESSION["Message"];
}
else{
	$message="";
}
if(isset($_SESSION["Username"])){
	header("location: index.php");
}
else{
	session_unset();
}


// Create connection
$conn = new mysqli("localhost", "root", "", "jobs");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mmm=$eee="";
 $username=$password=$usertype=$userErr=$usernameErr=$passwordErr=$usertypeErr="";
 $flag = 0;
 if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST["username"])) {
		$usernameErr="Username is required";
	}else{
		$username = test_input($_POST["username"]);
	}

	if (empty($_POST["password"])) {
		$passwordErr="Password is required";
	}else{
		$password = test_input($_POST["password"]);
	}

	if (empty($_POST["usertype"])) {
		$usertypeErr="Usertype is required";
	}else{
		$usertype = test_input($_POST["usertype"]);
	}

	if($usernameErr=="" && $passwordErr=="" && $usertypeErr==""){
		session_unset();
		if($usertype=="jobseeker"){
			$sql = "SELECT * FROM job_seeker WHERE Username = '$username' AND Password = '$password'";
			$result = mysqli_query($conn, $sql);
			//$result = $conn->query($sql);
			if ($result->num_rows == 1) {
			    // output data of each row
			    $_SESSION["Username"]=$username;
			    $_SESSION["Usertype"]=1;
			    header("location: JobSeekerProfile.php");
			} else {
			    $userErr="Username/Password is wrong";
			}
		}
		if($usertype=="employer"){
			$sql = "SELECT * FROM employer WHERE Username = '$username' AND Password = '$password'";
			$result = mysqli_query($conn, $sql);
			//$result = $conn->query($sql);
			if ($result->num_rows == 1) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	$_SESSION["Username"]=$username;
			    	$_SESSION["Usertype"]=2;
			    	header("location: EmployerProfile.php");
			    }
			} else {
			    $userErr="Username/Password is wrong";
			}			
		}		
		else if($usertype=="administrator"){
			$sql = "SELECT * FROM administrator WHERE Username = '$username' AND Password = '$password'";
			$result = mysqli_query($conn, $sql);
			if ($result->num_rows == 1) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	$_SESSION["Username"]=$username;
			    	$_SESSION["Usertype"]=3;
			    	header("location: AdministratorProfile.php");
			    }
			} else {
			    $userErr="Username/Password is wrong";
			}			
		}

	}

$conn->close();

 }

 function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}


?>

<html>
<head>
	<title>Login</title>
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
			<li><a href="JobSeeker.php">Writers</a></li>
			<li><a href="AboutUs.php">About Us</a></li>
	<li><a href='register.php'>Register</a></li>
</ul>
</div>
<div class="main">
	<div class="header">
		<ul>
			
			
			
		</ul>
		
	</div>
	<font color="white">
	<div class="content">
		<form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<center>
			<h2><font color="yellow">Login</font></h2>

			<?php echo $message;?>

			<table class="tableform">
				<tr>
					<td colspan="3"><center><span class="error"><?php echo $userErr; ?></span></center></td>
				</tr>
				<tr>
					<td><h4>Username</h4></td>
					<td><input type="text" name="username" value="<?php echo $username;?>"></td>
					<td><span class="error"><?php echo $usernameErr; ?></span></td>
				</tr>
				<tr>
					<td><h4>Password</h4></td>
					<td><input type="password" name="password" value="<?php echo $password;?>"></td>
					<td><span class="error"><?php echo $passwordErr; ?></span></td>
				</tr>

				<tr>
					<td><h4>User Type</h4></td>
					<td>
						<p><input type="radio" name="usertype"
						<?php if (isset($usertype) && $usertype=="jobseeker") echo "checked";?>
						value="jobseeker">Writer<br><br>
						<input type="radio" name="usertype"
						<?php if (isset($usertype) && $usertype=="employer") echo "checked";?>
						value="employer">Client<br><br>
						<input type="radio" name="usertype"
						<?php if (isset($usertype) && $usertype=="administrator") echo "checked";?>
						value="administrator">Administrator
						<!---<p>Forgot Password? <a href ="https://mail.google.com/mail/?view=cm&fs=1&to=nicolasbrown47@gmail.com ">email administrator</a></p>--->
					</td>
					<td><span class="error"><?php echo $usertypeErr; ?></span></p></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="login" value="LOGIN"></td>
					
				</tr>

			</table>
			</center>
		</form>
	</font>
</div>
	</header>
</div>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</body>
</html>