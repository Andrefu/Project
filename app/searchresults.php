<?php

	include("/php/connect.php");		/*includes any file. require is for mandatory files*/
	include("/php/functions.php");
	
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
	
	$error = "";
	
	$carlocation = $_SESSION['carlocation'];
	$result = mysqli_query($con, "SELECT advancenotice FROM auto WHERE carlocation='$carlocation'");
	$retrieveadvancenotice= mysqli_fetch_assoc($result);
	$advancenotice = $retrieveadvancenotice['advancenotice'];
			
	$result2 = mysqli_query($con, "SELECT shortesttrip FROM auto WHERE carlocation='$carlocation'");
	$retrieveshortesttrip = mysqli_fetch_assoc($result2);
	$shortesttrip = $retrieveshortesttrip['shortesttrip'];
		
	$result3 = mysqli_query($con, "SELECT longesttrip FROM auto WHERE carlocation='$carlocation'");
	$retrievelongesttrip = mysqli_fetch_assoc($result3);
	$longesttrip = $retrievelongesttrip['longesttrip'];
		
	$result4 = mysqli_query($con, "SELECT cardescription FROM auto WHERE carlocation='$carlocation'");
	$retrievecardescription = mysqli_fetch_assoc($result4);
	$cardescription = $retrievecardescription['cardescription'];
		
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
					<a href="profile.php">
						<button class="btn btn--user open-modal"><?php echo $fname . "  "; ?><img src=<?php echo "images/" . $userimage?> class="site-header__photo-user" alt="user"></button>
					</a>
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
	
	
	<!--display message error on top-->
	<div id="error" style=" <?php if($error !=""){ ?> display:block; <?php } ?> "><?php echo $error; ?></div>
	
		<div class="row row--gutters row--equal-height-at-large row--gutters-small generic-content-container">
			<div class="page-section">
			<div class="wrapper">
			
			<div class="row row--gutters">
				<div class="row__medium-4 row__medium-4--larger row__b-margin-until-medium">
					<img src=<?php echo "cars/" . $usercar?> alt="background" class="large-hero__image">
				</div>
			
				<div class="row__medium-8 row__medium-8--smaller">
					<div class="generic-content-container">
						<h3 class="headline headline--small"><?php echo $fname; ?></h2>
						
						<p>Preavviso: <?php echo $advancenotice;?> giorni</p>
						<p>Noleggio min: <?php echo $longesttrip;?> giorni</p>
						<p>Noleggio max: <?php echo $shortesttrip;?> giorni</p>
						<p>Descrizione auto: <?php echo $cardescription;?></p>
						
					</div>
				</div>
			</div>
				
			</div>
			</div>
		</div>
	


	
</body>
	
</html>