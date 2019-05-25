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
$org_name=$_SESSION["org_name"];

// Create connection
$conn = new mysqli("localhost", "root", "", "jobs");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$job_title=$job_titleErr=$category=$categoryErr=$req_skill=$req_skillErr=$designation=$designationErr=$salary=$salaryErr="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST["update"])){
		$_SESSION["jid"]=$_POST["job_id"];
		$jid=$_SESSION["jid"];
		$sql = "SELECT * FROM job_offer WHERE Job_ID='$jid'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$job_title=$row["Job_title"];
		    	$category=$row["Category"];
		    	$req_skill=$row["Req_skill"];
		    	$designation=$row["Designation"];
		    	$salary=$row["Salary"];
			}
		}
	}

	else if(isset($_POST["submit"])){
		if (empty($_POST["job_title"])) {
			$job_titleErr="Title is required";
		}else{
			$job_title = test_input($_POST["job_title"]);
		}

		if (empty($_POST["category"])) {
			$categoryErr="Category is required";
		}else{
			$category = test_input($_POST["category"]);
		}

		if (empty($_POST["req_skill"])) {
			$req_skillErr="Skill is required";
		}else{
			$req_skill = test_input($_POST["req_skill"]);
		}	

		if (empty($_POST["designation"])) {
			$designationErr="Designation is required";
		}else{
			$designation = test_input($_POST["designation"]);
		}

		if (empty($_POST["salary"])) {
			$salaryErr="Salary is required";
		}else{
			$salary = test_input($_POST["salary"]);
		}
		$jid=$_SESSION["jid"];
	if($job_titleErr=="" && $categoryErr=="" && $req_skillErr=="" && $designationErr=="" && $salaryErr==""){
			$sql = "UPDATE job_offer SET Job_title='$job_title', Category='$category', Req_skill='$req_skill', Salary='$salary', Designation='$designation' WHERE Job_ID='$jid'";
			$result = mysqli_query($conn, $sql);
			if($result==true){
				header("location: myoffer.php");
			}
		}
	}
	else if(isset($_POST["delete"])){
		$jid=$_SESSION["jid"];
		$sql = "DELETE FROM job_offer WHERE Job_ID='$jid'";
		$result = mysqli_query($conn, $sql);
		$sql = "DELETE FROM posts WHERE Job_ID='$jid'";
		$result1 = mysqli_query($conn, $sql);
		if($result==true && $result1==true){
			header("location: myoffer.php");
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
	<title>Update A Job Offer</title>
	<link rel="stylesheet" type="text/css" href="all.css">
		<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body>

		<div class="nav">
<a href="home.html">
<img src="logo12.jpg" class="logo">
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
	
	<div class="content">
		<font color="white">
		<center>
			<form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Update A Job Offer</h2>
			<p><span class="error">* required field.</span></p>
			<table class="tableform">
				<tr>
					<td>Job Title</td>
					<td><input type="text" name="job_title" value="<?php echo $job_title;?>"></td>
					<td><span class="error">*<?php echo $job_titleErr; ?></span></td>
				</tr>
				<tr>
				<td>Category</td>
					<td><input type="radio" name="category" <?php if (isset($category) && $category=="Accounting/Finance/Banking") echo "checked";?> value="Accounting/Finance/Banking"> Accounting/Finance/Banking<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Education/Training") echo "checked";?> value="Education/Training"> Education/Training<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Engineer/Architects") echo "checked";?> value="Engineer/Architects"> Engineer/Architects<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="IT and Telecommunication") echo "checked";?> value="IT and Telecommunication"> IT and Telecommunication<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Marketing/Sales") echo "checked";?> value="Marketing/Sales"> Marketing/Sales<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Medical/Pharma") echo "checked";?> value="Medical/Pharma"> Medical/Pharma<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Law/Legal") echo "checked";?> value="Law/Legal"> Law/Legal<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Garments/Textile") echo "checked";?> value="Garments/Textile"> Garments/Textile<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Airline/Travel/Tourism") echo "checked";?> value="Airline/Travel/Tourism"> Airline/Travel/Tourism<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Media/Advertising/Event Mgt.") echo "checked";?> value="Media/Advertising/Event Mgt."> Media/Advertising/Event Mgt.<br>
						<input type="radio" name="category" <?php if (isset($category) && $category=="Others") echo "checked";?> value="Others"> Others<br>		
					</td>
					<td><span class="error">*<?php echo $categoryErr; ?></span></td>
				</tr>
				<tr>
					<td>Required Skill</td>
					<td><input type="text" name="req_skill" value="<?php echo $req_skill;?>"></td>
					<td><span class="error">*<?php echo $req_skillErr; ?></span></td>
				</tr>
				<tr>
					<td>Designation</td>
					<td><input type="text" name="designation" value="<?php echo $designation;?>"></td>
					<td><span class="error">*<?php echo $designationErr; ?></span></td>
				</tr>
				<tr>
					<td>Salary</td>
					<td><input type="text" name="salary" value="<?php echo $salary;?>"></td>
					<td><span class="error">*<?php echo $salaryErr; ?></span></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="UPDATE"></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="delete" value="DELETE THE OFFER"></td>
					<td></td>
				</tr>
			</table>
			</form>
		</center>
	</div></font>
	
</div>

</body>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</html>