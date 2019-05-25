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

$msg="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$jid=$_POST["job_id"];
	if(isset($_POST["approve"])){
		$sql = "UPDATE job_offer SET Ad_username='$userProfile' WHERE Job_ID='$jid'";
		$result = mysqli_query($conn, $sql);
		if($result==true){
			$msg="The Job Offer is successfully approved";
		}
	}
	else if(isset($_POST["delete"])){
		$sql = "DELETE FROM job_offer WHERE Job_ID='$jid'";
		$result = mysqli_query($conn, $sql);
		$sql = "DELETE FROM posts WHERE Job_ID='$jid'";
		$result1 = mysqli_query($conn, $sql);
		if($result==true && $result1==true){
			$msg="The Job Offer is deleted";
		}
	}
}

$sql = "SELECT job_offer.Job_ID,job_offer.Job_title,job_offer.Category, job_offer.Req_skill,job_offer.Salary,job_offer.Designation, job_offer.Timestamp,posts.Org_name,employer.Name, employer.Email,employer.ContactNo FROM job_offer,posts,employer WHERE job_offer.Ad_username='' AND job_offer.Job_ID=posts.Job_ID AND posts.E_username=employer.Username ORDER BY job_offer.Job_ID ";
$result = mysqli_query($conn, $sql);

?>
<html>
<head>
	<title>Approve A Job Offer</title>
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
		<center>
		<h2 class="proh2" style="margin-bottom: 5px">Unapproved Job Offers</h2>
		<h4><?php echo $msg;?></h4>

		<?php 

			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {

					$job_id=$row["Job_ID"];
			    	$job_title=$row["Job_title"];
			    	$category=$row["Category"];
			    	$req_skill=$row["Req_skill"];
			    	$designation=$row["Designation"];
			    	$time=$row["Timestamp"];
			    	$salary=$row["Salary"];
			    	$e_name=$row["Name"];
			    	$email=$row["Email"];
			    	$contact=$row["ContactNo"];
			    	$org_name=$row["Org_name"];

			    echo '
			    	<form method="post" action="'.$_SERVER["PHP_SELF"].'">
					  <table class="offer">
						<tr>
							<td>Job ID</td>
							<td>:</td>
							<td><input type="text" name="job_id" value="'.$job_id.'" readonly="true" class="del2"></td>
							<td></td>
							<td>Organization</td>
							<td>:</td>
							<td>'.$org_name.'</td>
						</tr>
						<tr>
							<td>Job Title</td>
							<td>:</td>
							<td>'.$job_title.'</td>
							<td></td>
							<td>Employer Name</td>
							<td>:</td>
							<td>'.$e_name.'</td>
						</tr>
						<tr>
							<td>Category</td>
							<td>:</td>
							<td>'.$category.'</td>
							<td></td>
							<td>Email</td>
							<td>:</td>
							<td>'.$email.'</td>
						</tr>
						<tr>
							<td>Required Skill</td>
							<td>:</td>
							<td>'.$req_skill.'</td>
							<td></td>
							<td>Contact No</td>
							<td>:</td>
							<td>'.$contact.'</td>
						</tr>
						<tr>
							<td>Designation</td>
							<td>:</td>
							<td>'.$designation.'</td>
							<td></td>
							<td>Posted on</td>
							<td>:</td>
							<td>'.$time.'</td>
						</tr>
						<tr>
							<td>Salary</td>
							<td>:</td>
							<td>'.$salary.'</td>
							<td></td>
							<td><input type="submit" name="approve" value="Approve" class="det2"></td>
							<td></td>
							<td><input type="submit" name="delete" value="Delete" class="det3"></td>
						</tr>
					</table>
				</form>
			    ';

				}

			}else{
				echo "0 results";
			}

		?>



		</center>
	</div>
</font>
</header>
	<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</div>
</body>
</html>