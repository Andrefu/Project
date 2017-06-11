<?php

	include("/php/connect.php");		/*includes any file. require is for mandatory files*/
	include("/php/functions.php");

	if(logged_in())
	{
		header("location:profile.php");		/*if user is logged in he can go back only to profile.php and not others*/
		exit(); 							/*script is exited avoiding to read any other stuff below this file as 
											sometimes in the 0,5s needed to change file the code below can be executed*/
	}

	$error = "";
	
	if(isset($_POST['submit'])) /*if button submit is clicked*/
	{
		$email = mysqli_real_escape_string($con, $_POST['email']);			/*mysql_real_escape_string() is used to prevent sql injection attacks*/
		$password = mysqli_real_escape_string($con, $_POST['password']);
		$checkBox = isset($_POST['keep']); 									/*isset needed otherwise it gives an error*/
		
		/*verifies if the email exists in the database*/
		if(email_exists($email,$con))
		{
			$result = mysqli_query($con, "SELECT password FROM users WHERE email='$email'");	/*selects the password corresponding to the email recorded in the database*/
			$retrievepassword = mysqli_fetch_assoc($result); 									/*retrieves a result row as associative array*/
			
			/*if password is not retrieved*/
			if(!password_verify($password, $retrievepassword['password']))
			{
				$error = "Password is incorrect";
			}
			else
			{
				$_SESSION['email'] = $email;	/*After this line is executed user will be logged in.
												An alternative to the email is the id (parameter in the database) is also an option for the login.*/
				
				/*if checkbox is checked*/
				if($checkbox == "on")
				{
					setcookie("email",$email, time()+3600);	/*like in $_SESSION email is the key for the cookie while $email contains the associated value. 
															time()+3600 makes the cookie expire after 1 hour*/
				}
				
				header("location: profile.php"); 			/*header() is used to move the user to another page if the password is correct*/
			}
		}
		else
		{
			$error =  "Email does not exist";
		}
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
	
<body class="body body--signup">
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
				<div class="site-header__btn-container">
					<a href="index.php" class="btn open-modal">Homepage</a>
				</div>
			</div>
		</div>
	</header>
		
		<!--display message error on top-->
		<div id="error" style=" <?php if($error !=""){ ?> display:block; <?php } ?> "><?php echo $error; ?></div>
					
		<div class="wrapper wrapper--signup">
		
		<div id="menu">
			<a href="signup.php">Sign Up</a>
			<a href="login.php">Login</a>
		</div>
		
			<!--form for data insertion-->
			<div id="formDiv">
			
				<form method="POST" action="login.php"> 		<!--enctype is necessary for uploading imgies or files-->
							
				<label>Email:</label><br/>
				<input type="text" name="email" class="inputFields" required/><br/><br/>
				
				<label>Password:</label><br/>
				<input type="password" name="password" class="inputFields" required/><br/><br/>
				
				<input type="checkbox" name="keep" checked="checked"/>
				<label>Keep me logged in</label><br/><br/>
				
				<input type="submit" class="theButtons" name="submit" value="login"/><br/><br/>
				
				</form>
			
			</div>
		
		</div>
	
</body>
	
</html>
