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
	if(isset($_POST["type"])){
		$type=$_POST["type"];
		$msg="Job Offers from ".$type." Category";
		$sql = "SELECT job_offer.Job_ID,job_offer.Job_title,job_offer.Category, job_offer.Req_skill,job_offer.Designation,job_offer.Timestamp,job_offer.Ad_username FROM job_offer WHERE job_offer.Category='$type' ORDER BY job_offer.Job_ID DESC";
		$result = mysqli_query($conn, $sql);
	}
	
}
else{
	$sql = "SELECT * FROM job_offer ORDER BY Job_ID  DESC";
	$result = mysqli_query($conn, $sql);
	$msg="All Job Offers";
}


?>
<html>
<head>
	<title>All Job Offer</title>
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
		<table class="alljob">
			<tr>
				<td class="proh2"><h2><?php echo $msg;?></h2></td>
			</tr>

			<tr>
				<td>

				<?php

				 if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	$job_id=$row["Job_ID"];
				    	$job_title=$row["Job_title"];
				    	$category=$row["Category"];
				    	$req_skill=$row["Req_skill"];
				    	$designation=$row["Designation"];
				    	$time=$row["Timestamp"];
				    	

				    	if($row["Ad_username"]!="")
				    	{
				    	echo
				    	'<form action="detailjoboffer.php" method="post">
				    	<table class="offer">
						<tr>
							<td colspan="2"><h4>
							<input type="submit" name="" value="Job ID:'.$job_id.'" class="detoffer">
							
							</h4></td>
							<td style="text-align:right;"><h4>
							<input type="text" name="job_id" value="'.$job_id.'" readonly="true" id="del">
							Posted on: '.$time.'   
							<input type="submit" name="" value="Details" class="detoffer">
							</h4></td>
						</tr>
						<tr>
							<td>Job Title</td>
							<td>:</td>
							<td>'.$job_title.'</td>
						</tr>
						<tr>
							<td>Category</td>
							<td>:</td>
							<td>'.$category.'</td>
						</tr>
						<tr>
							<td>Required Skill</td>
							<td>:</td>
							<td>'.$req_skill.'</td>
						</tr>
						<tr>
							<td>Designation</td>
							<td>:</td>
							<td>'.$designation.'</td>
						</tr>
					</table>
					</form>';
						}

				    }
				} else {
				    echo "0 results";
				}
				$conn->close();
				?>



					
				</td>
			</tr>
		</table>
		<form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<table class="category">
			<tr>
				<td><h3 class="ctitle">Category</h3></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Accounting/Finance/Banking"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Education/Training"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Engineer/Architects"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="IT and Telecommunication"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Marketing/Sales"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Medical/Pharma"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Law/Legal"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Garments/Textile"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Airline/Travel/Tourism"></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Media/Advertising/Event Mgt."></td>
			</tr>
			<tr>
				<td><input type="submit" name="type" value="Others"></td>
			</tr>
		</table>
		</form>
	</div></font>
	<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</div>
</body>
</html>
