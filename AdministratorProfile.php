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

$loginUser=$_SESSION["Username"];
$sql = "SELECT * FROM administrator WHERE Username = '$loginUser'";
$result = mysqli_query($conn, $sql);

$name = $email = $username ="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name =$row["Name"];
        $email = $row["Email"];
        $username = $row["Username"];
    }
} else {
    echo "0 results";
}
$conn->close();
?> 

<html>
<head>
	<title>Profile Administrator</title>
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
			<li>
					<?php
			if($flag==1){
				if($ut==1){
					echo "<li><a href='JobSeekerProfile.php' style='border-radius:10px' class='btn input'>User: ".$userProfile."</a></li>";
				}
				elseif ($ut==2) {
					echo "<li><a href='EmployerProfile.php' style='border-radius:10px' class='btn input'>User: ".$userProfile."</a></li>";
				}
				else{
					echo "<li><a href='AdministratorProfile.php' style='border-radius:10px' class='btn input'>User: ".$userProfile."</a></li>";
				}
			}
			
			?>
		</li>
	
</ul>
</div>
	
<div class="main">
	<div class="content"><font color="white">
		<form>
		<table class="protable">
			<tr>
				<td colspan="3" class="proh2"><h2>Administrator Profile</h2></td>
				<td style="text-align:right;"><h4><a href="logout.php">Logout</a></h4></td>
			</tr>
			<tr>
				<td>Name</td>
				<td>:</td>
				<td><?php echo $name?></td>
				<td rowspan="2"><center><h3><a href="approvejoboffer.php">Unapproved Job Offers</a></h3></center></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><?php echo $email?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td>:</td>
				<td><?php echo $username?></td>
				<td rowspan="2"><center><h3><a href="deletejoboffer.php">Delete A Job Offer</a></h3></center></td>
			</tr>
		</table>
			
		</form>
	</div></font>
</header>

</div>
</body>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</html>