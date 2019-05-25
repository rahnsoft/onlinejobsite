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

if(isset($_SESSION["Username"])){
	$loginUser=$_SESSION["Username"];
	$flag=1;
}
else{
	$loginUser="";
	$flag=0;
}
$sql = "SELECT * FROM employer WHERE Username = '$loginUser'";
$result = mysqli_query($conn, $sql);

$name = $email = $contactNo = $username = $org_name ="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $name =$row["Name"];
        $email = $row["Email"];
        $contactNo = $row["ContactNo"];
        $username = $row["Username"];
        $password = $row["Password"];
        $org_name = $row["Org_name"];
    }
} else {
    echo "0 results";
}

$_SESSION["org_name"]=$org_name;

$sql = "SELECT * FROM organization WHERE Name = '$org_name'";
$result = mysqli_query($conn, $sql);

$org_loc=$org_type="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $org_loc=$row["Location"];
        $org_type=$row["Type"];
    }
} else {
    echo "0 results";
}

$conn->close();
?> 

<html>
<head>
	<title>Profile Client</title>
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
			<li><a href="Employer.php">Client</a></li>
			<li><a href="JobSeeker.php">Writer</a></li>
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
	
	<div class="content">
		<font color="yellow">
	<?php 
	if($flag==0){
		echo '<center><h2>Please Login first!!</h2><br><h4><a href="login.php">Login</a></h4></center>';
	}
	else{
	echo
	'<form method="post" action="EmployerReg.php">
		<center>
			<table class="protable">
				<tr>
					<td colspan="6" class="proh2"><h2>Client Profile</h2></td>
					<td style="text-align:right;"><h4><a href="logout.php">Logout</a></h4></td>
				</tr>
				<tr>
					<td colspan="3" class="proh2">Personal Details</td>
					<td colspan="3" class="proh2">Organization Details</td>
					<td rowspan="2"><center><h3><a href="postjoboffer.php">Post A Job Offer</a></h3></center></td>
				</tr>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><input type="text" name="name" value="'.$name.'" readonly="true" class="del2"></td>
					<td>Organization</td>
					<td>:</td>
					<td><input type="text" name="org_name" value="'.$org_name.'" readonly="true" class="del2"></td>
					
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="text" name="email" value="'.$email.'" readonly="true" class="del2"></td>
					<td>Location</td>
					<td>:</td>
					<td>'.$org_loc.'</td>
					<td rowspan="2"><center><h3><a href="myoffer.php">My Job Offer</a></h3></center></td>
				</tr>
				<tr>
					<td>Contact No</td>
					<td>:</td>
					<td><input type="text" name="contactNo" value="'.$contactNo.'" readonly="true" class="del2"></td>
					<td>Type</td>
					<td>:</td>
					<td>'.$org_type.'</td>
				</tr>
				<tr>
					<td>Username</td>
					<td>:</td>
					<td><input type="text" name="username" value="'.$username.'" readonly="true" class="del2"></td>
					<td></td>
					<td></td>
					<td></td>
					<td rowspan="2"><center><h3><a href="alljoboffer.php">All Job Offer</a></h3></center></td>
				</tr>
				<tr>
					<td><input type="text" name="password" value="'.$password.'" readonly="true" class="ppp"></td>
					<td colspan="2" class="insubmit"><input type="submit" name="edit" value="Edit My Profile"></td>
					<td></td>
					<td colspan="2"><h4><a href="editorg.php">Edit Organization Details</a></h4></td>
				</tr>
			</table>
		</center>
		</form>';
		}
	?>
	</div></font>
</header>
	
</div>
<div class="footer"><center><font size="3" color="grey">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </font></a>
	</div>
</body>
</html>