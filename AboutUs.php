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
	<title>About Us</title>
	<link href="css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<video autoplay loop class="video-background" muted plays-inline>
<source src="videob.mp4" type="video/mp4">
</video>
<div class="nav">
<a href="home.html">
<a href="index.html"><img src="logo12.jpg" class="logo"></a>
</a>
<ul class="menu">
<li><a href="index.html">Home</a></li>
			<li><a href="Employer.php">Clients</a></li>
			<li><a href="JobSeeker.php">Writers</a></li>
		<!--	<li><a href="AboutUs.php">About Us</a></li>-->
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
	<div class="content">
<br>
<br>
		<font color="white"size="5">
		 <h5><center><font color ="yellow" size="6">About Unique Assignments</center><br></h5>
		 	</font>
		 <p><center>We are solely committed to providing high-end and secure services to our clients. We believe that in writing you can achieve all.We are mainly focused in helping clients achieve their academic, experience excellence by rendering out our services to those at need.
		 </center><br>
		<h5><center><font color ="yellow" size="6">Our Services</center></h5></font><br>
		 <center>Using our platform you can register as a client or a writer.A client is the one incharge of posting various writing jobs or offers and entering the details of the offer via our plaatform. This ony happens when you as a client sign ups with us and then exclusively using our services. After a client has posted the offer or offers,they can view their offers to the detail and either update or delete the supposed job offers.</center>
		 <center>When it comes to clients we know how to serve them right. A writer can only use our platform to find job offers and view the job offer details after registering and login in with their registered credentials. They can also view the client details, job posted time and date.Moreover the writer can  browse through job offers by Categories or Organization type.</center>
		<center><br> <br><font size="5">Sign Up Below<br><br>
		 <li><a href='register.php'><br><font color="greem">Sign Up</font></a></li></p></font>
		</center>
	</font>
		
	</div>
</header>
	
</div>
<div class="footer"><center><font size="4" color="white">&copy <?php echo date("Y"); ?>- UniqueAssignments.com Created and Designed  by <a href="https://www.instagram.com/wesbrown1" target="_blank" style="color: #CDDC39;">Nicklaus and Moreen </a></font>
	</div>
</body>

</html>