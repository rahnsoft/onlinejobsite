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
?>
<html>
<head>
	<title>UniqueAssignments.Com</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	
<div class="main">
	<div class="header">
		<img src="images/logo.png" width="300" height="70">
		<ul>
			<li><a href="home.html">Home</a></li>
			<li><a href="Employer.php">Client</a></li>
			<li><a href="JobSeeker.php">Writer</a></li>
			<li><a href="AboutUs.php">About Us</a></li>
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
			else{
				echo "
				<li><a href='login.php'>Login</a></li>
				<li><a href='register.php'>Register</a></li>
				";
			}
			?>
			
		</ul>
		<img id="pic" src="images/bigpicture.jpg" alt="" width="960" height="300" />
	</div>
	<div class="content">
		<h2><b>WELCOME</b></h2>
		<p><b>Welcome to Unique Assignments site. It provides facility to the Writer to search for various writing jobs as per his qualification. Here a writer can register himself on the web portal and create his profile along with his educational information. A writer can also search various jobs and apply.<br>This Portal is also designed for various Clients who require to recruit writers in their organization. A Client can register himself on the web portal and upload information of various writing job vacancies in their organization. Furthermore a Client can also view the applications of the writer and call the various writers.</b></p>
	</div>
	
	<div class="footer">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Designed and edited by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a>
	</div>
</div>
</body>
</html>