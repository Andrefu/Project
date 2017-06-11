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
	
	$error = "";
	
	if(isset($_POST['submit']))
	{	
		$carlocation = mysqli_real_escape_string($con, $_POST['carlocation']);
		$_SESSION['carlocation'] = $carlocation;
		header("location:searchresults.php");		//if user is logged in he can go back only to profile.php and not others
		exit();
	}
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
	
	
	<!--display message error on top-->
	<div id="error" style=" <?php if($error !=""){ ?> display:block; <?php } ?> "><?php echo $error; ?></div>
	
		<div class="wrapper wrapper--signup">
			<div id="formDiv" style="display: inline; padding-top: 100px;">
			
				<form method="POST" action="find-car.php" enctype="multipart/form-data"> 		<!--enctype is necessary for uploading imgies or files-->
					<br/><br/><br/><br/><br/><br/><br/>
					<label>Luogo</label>
					<input type="text" name="carlocation" value ="<?php echo isset($_POST['carlocation']) ? $_POST['carlocation'] : ''?>" class="inputFields" required/>
					
					<label>Da:</label>
					<input type="date" name="startdate" value ="<?php echo isset($_POST['startdate']) ? $_POST['startdate'] : ''?>" class="inputFields" required/>
										
					<label>A:</label>
					<input type="date" name="enddate" value ="<?php echo isset($_POST['enddate']) ? $_POST['enddate'] : ''?>" class="inputFields" required/><br/><br/>
										
										
					<input type="submit" class="theButtons" name="submit"/>
				</form>
			
			</div>
		</div>
	
</body>
	
</html>