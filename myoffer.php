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

$sql = "SELECT job_offer.Job_ID,job_offer.Job_title,job_offer.Category,job_offer.Req_skill,job_offer.Salary,job_offer.Designation,job_offer.Ad_username,job_offer.Timestamp FROM job_offer INNER JOIN posts ON job_offer.Job_ID=posts.Job_ID AND posts.E_username='$userProfile'  ";
$result = mysqli_query($conn, $sql);

?>
<html>
<head>
	<title>About Us</title>
	<link rel="stylesheet" type="text/css" href="all.css">
	<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
	
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
		<center>
			<h2 class="proh2" style="margin-bottom: 5px;">My Job Offer</h2>
			<?php

			 if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			    	$job_id=$row["Job_ID"];
			    	$job_title=$row["Job_title"];
			    	$category=$row["Category"];
			    	$req_skill=$row["Req_skill"];
			    	$designation=$row["Designation"];
			    	$salary=$row["Salary"];
			    	$time=$row["Timestamp"];
			    	if($row["Ad_username"]==""){
			    		$status = "Pending for Approval";
			    	}else{
			    		$status = "Approved";
			    	}
			    	
			    echo
			    '<form action="editmyoffer.php" method="post">
				    <table class="offer">
					<tr>
						<td>Job ID</td>
						<td>:</td>
						<td><input type="text" name="job_id" value="'.$job_id.'" readonly="true" class="del2"></td>
						<td></td>
						<td>Designation</td>
						<td>:</td>
						<td>'.$designation.'</td>
					</tr>
					<tr>
						<td>Job Title</td>
						<td>:</td>
						<td>'.$job_title.'</td>
						<td></td>
						<td>Salary</td>
						<td>:</td>
						<td>'.$salary.'</td>
					</tr>
					<tr>
						<td>Category</td>
						<td>:</td>
						<td>'.$category.'</td>
						<td></td>
						<td>Posted on</td>
						<td>:</td>
						<td>'.$time.'</td>
					</tr>
					<tr>
						<td>Required Skill</td>
						<td>:</td>
						<td>'.$req_skill.'</td>
						<td></td>
						<td>Status</td>
						<td>:</td>
						<td>'.$status.'</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><input type="submit" name="update" value="Update" class="det2"></td>
					</tr>			
				</table>
			</form>';
			   }
			} else {
			    echo "0 results";
			}
			$conn->close();

			?>
		</center>
	</div>
</font>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</div>

</body>

</html>