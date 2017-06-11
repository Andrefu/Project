<?php

	include("/php/connect.php");		/*includes any file. require is for mandatory files*/
	include("/php/functions.php");
	
	if(logged_in())
	{
		$email = mysqli_real_escape_string($con, $_SESSION['email']);			/*mysql_real_escape_string() is used to prevent sql injection attacks*/
		$result = mysqli_query($con, "SELECT firstName FROM users WHERE email='$email'");
		$retrievefname= mysqli_fetch_assoc($result);
		$fname = $retrievefname['firstName'];
		
		$result = mysqli_query($con, "SELECT image FROM users WHERE email='$email'");
		$retrieveimage= mysqli_fetch_assoc($result);
		$userimage = $retrieveimage['image'];
		
		$result2 = mysqli_query($con, "SELECT carfront FROM auto WHERE email='$email'");
		$retrievecar= mysqli_fetch_assoc($result2);
		$usercar = $retrievecar['carfront'];
	?>
	
<!doctype html>

<html>
	
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
		<title>Login</title>
		<meta name="keywords" content="Travel planning, travel bundles, travel escapes, affordable travel">
		<meta name="description" content="Your clarity. One trip away. We create soul restoring journeys that inspire you to be you.">

		<!-- build:css assets/styles/styles.css -->
		<link rel="stylesheet" href="temp/styles/style.css">  <!--right before the end of the head section the css file is stated.
																ovviamente il file css da usare è quello generato da postCSS!!!-->
		<!-- endbuild -->
		
		<!-- build:js assets/scripts/Vendor.js -->
		<script src="/temp/scripts/Vendor.js"></script> <!--must be run as soon as possible at the beginning of the page otherwise its useless-->
		<!-- endbuild -->
	</head>
	
<body>
	<header class="site-header">
		<div class="wrapper">
		
			<a href="index.php">
				<div class="site-header__logo">		
					<div class="site-header__logo__graphic icon icon--clear-view-escapes">Clear View Escapes</div>
				</div>
			</a>
				
			<div class="site-header__menu-icon">
				<div class="site-header__menu-icon__middle"></div>
			</div>
			
			<div class="site-header__menu-content">
				<div class="dropdown">				
					<button class="btn btn--user open-modal"><?php echo $fname . "  "; ?><img src=<?php echo "images/" . $userimage?> class="site-header__photo-user" alt="user"></button>
					<div class="dropdown-content">
						<a href="find-car.php">Cerca auto</a>
						<a href="register-car.php">Registra la tua auto</a>
						<a href="changepassword.php">Cambia password</a>
						<a href="logout.php">Logout</a>
					</div>
				</div>
			</div>		
		</div>	
	</header>
	
	<div class="large-hero">
		<img src=<?php echo "cars/" . $usercar?> alt="background" class="large-hero__image">
	</div>
	
	<!--display message error on top-->
	<div id="error" style=" <?php if($error !=""){ ?> display:block; <?php } ?> "><?php echo $error; ?></div>
				<div class="row row--gutters row--equal-height-at-large row--gutters-small generic-content-container">
						<div class="testimonial">
							<div class="testimonial__photo-dashboard">
								<img sizes="160px" src=<?php echo "images/" . $userimage?> alt="user">
							</div>

							<h3 class="testimonial__title-dashboard">Ciao <?php echo $fname; ?></h3>
							<h4 class="testimonial__subtitle-dashboard">9 Time Escaper</h4>
							<p>&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.&ldquo;Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>		
						</div>
				</div>
				
</body>
	
</html>
	
	<?php
	}
	else
	{
		header("location:login.php");		/*if user is not logged in he is brought to login.php*/
		exit(); 							/*script is exited avoiding to read any other stuff below this file as 
											sometimes in the 0,5s needed to change file the code below can be executed*/
	}
?>