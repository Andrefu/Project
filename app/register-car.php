<?php

	include("/php/connect.php");		/*includes any file. require is for mandatory files*/
	include("/php/functions.php");
	
	// if(!logged_in())
	// {
		// header("location:login.php");		/*if user is logged in he can go back only to profile.php and not others*/
		// exit(); 							/*script is exited avoiding to read any other stuff below this file as 
											// sometimes in the 0,5s needed to change file the code below can be executed*/
	// }

	$error = "";
	
	if(isset($_POST['submit'])) /*if button submit is clicked*/
	{
		$nlicensecard = mysql_real_escape_string($_POST['nlicensecard']);
		$countryrelease = mysql_real_escape_string($_POST['countryrelease']);
		$lcardreleasedata = mysql_real_escape_string($_POST['lcardreleasedata']);
		$birthdate = mysql_real_escape_string($_POST['birthdate']);
		$carlocation = mysql_real_escape_string($_POST['carlocation']);
		$advancenotice = mysql_real_escape_string($_POST['advancenotice']);
		$shortesttrip = mysql_real_escape_string($_POST['shortesttrip']);
		$longesttrip = mysql_real_escape_string($_POST['longesttrip']);
		$licenseplate = mysql_real_escape_string($_POST['licenseplate']);
		$cardescription = mysql_real_escape_string($_POST['cardescription']);	

		$image = $_FILES['carfront']['name'];			/*$_FILES is a global variable*/
		$tmp_image = $_FILES['carfront']['tmp_name'];	/*needed to upload files*/
		$imageSize = $_FILES['carfront']['size'];		/*needed to fix an upper limit to the file size*/
		$email = $_SESSION['email'];
		
		
		$conditions = isset($_POST['conditions']);
		
		$date = date("F, d Y"); /*registration date in the format July 4, 2015*/
		
			if(strlen($nlicensecard) < 2)							/*if first name is shorter than 2 characters*/
			{
				$error = "Licence card number too short";
			}
			else if(strlen($countryrelease) < 2)						/*if last name is shorter than 2 characters*/
			{
				$error = "Nation name too short";
			}	
			else if($image == "")								/*if image variable is empty*/
			{
				$error = "Please upload your image";
			}
			else if($imageSize > 1048576)						/*size must be in bytes (1Mb)*/
			{	
				$error = "Image size must be less than 1Mb";
			}
			else												/*if there are no errors*/
			{			
				$imageExt = explode(".", $image);				/*explodes the name of the element in array $imageExt*/
				$imageExtension =  $imageExt[1];				/*$imageExt[1] is the 2nd element of the array containing */
				
				/*limiting image formats to png and jpg*/
				if($imageExtension == 'PNG' || $imageExtension == 'png' || $imageExtension == 'JPG' || $imageExtension == 'jpg')
				{
									
					$image = rand(0, 100000).rand(0, 100000).rand(0, 100000).time().".".$imageExtension; /*generates a random number in the range 0 100000 and adds time*/ 
					
					$error = $nlicensecard . $countryrelease . $lcardreleasedata . $birthdate . $advancenotice . $shortesttrip . $longesttrip . $licenseplate . $cardescription . $date;
					
					$insertQuery = "INSERT INTO auto(nlicensecard, countryrelease, lcardreleasedata, birthdate, carlocation, advancenotice, shortesttrip, longesttrip, licenseplate, cardescription, carfront, date, email) VALUES('$nlicensecard','$countryrelease','$lcardreleasedata','$birthdate','$carlocation','$advancenotice','$shortesttrip','$longesttrip','$licenseplate','$cardescription','$image','$date','$email')"; /*queries are used to communicate with databases*/
					$error = $nlicensecard . $countryrelease . $lcardreleasedata . $birthdate . $advancenotice . $shortesttrip . $longesttrip . $licenseplate . $cardescription . $date;
					if(mysqli_query($con, $insertQuery))		/*1st parameter is the connection, 2nd is insertQuery*/
					{
						if(move_uploaded_file($tmp_image, "cars/$image")) /**/
						{
							$error = "You are successfully registered";
						}
						else
						{
							$error = "Image is not uploaded";
						}
					}
				}
				/*if the file is not an image*/
				else
				{
					$error = "File must be an image";
				}
			}
	}
?>

<!DOCTYPE html>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>
  <title>Registra la tua auto</title>
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

  <!-- <div class="large-hero"> -->
    
	<!--display message error on top-->
		<div id="error" style=" <?php if($error !=""){ ?> display:block; <?php } ?> "><?php echo $error; ?></div>
					
		<div class="wrapper wrapper--signup">
			
			<!--form for data insertion-->
			<div id="formDiv">
			
				<form method="POST" action="register-car.php" enctype="multipart/form-data"> 		<!--enctype is necessary for uploading imgies or files-->
					<br/><br/><br/><br/>
					<label>Numero di Patente</label><br/>
					<input type="text" name="nlicensecard" value ="<?php echo isset($_POST['nlicensecard']) ? $_POST['nlicensecard'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Nazione di rilascio</label><br/>
					<input type="text" name="countryrelease" value ="<?php echo isset($_POST['countryrelease']) ? $_POST['countryrelease'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Data di rilascio</label><br/>
					<input type="date" name="lcardreleasedata" value ="<?php echo isset($_POST['lcardreleasedata']) ? $_POST['lcardreleasedata'] : ''?>" class="inputFields" required/><br/><br/>
										
					<label>Data di nascita</label><br/>
					<input type="date" name="birthdate" value ="<?php echo isset($_POST['birthdate']) ? $_POST['birthdate'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Luogo</label><br/>
					<input type="text" name="carlocation" value ="<?php echo isset($_POST['carlocation']) ? $_POST['carlocation'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Advance Notice</label><br/>
					<input type="text" name="advancenotice" value ="<?php echo isset($_POST['advancenotice']) ? $_POST['advancenotice'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Durata minima</label><br/>
					<input type="text" name="shortesttrip" value ="<?php echo isset($_POST['shortesttrip']) ? $_POST['shortesttrip'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Durata massima</label><br/>
					<input type="text" name="longesttrip" value ="<?php echo isset($_POST['longesttrip']) ? $_POST['longesttrip'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Numero di targa</label><br/>
					<input type="text" name="licenseplate" value ="<?php echo isset($_POST['licenseplate']) ? $_POST['licenseplate'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Descrizione auto</label><br/>
					<input type="text" name="cardescription" value ="<?php echo isset($_POST['cardescription']) ? $_POST['cardescription'] : ''?>" class="inputFields" required/><br/><br/>
					
					<label>Images</label><br/>
					<input type="file" name="carfront" id="imageupload"/><br/><br/>
										
					<input type="submit" class="theButtons" name="submit"/><br/><br/>
										
				</form>
			
			</div>
		
		</div>
	
    <!-- <picture> <!--responsive image. la dimensione 1920w indica quanto è grande il file così il browser capisce quale usare-->
	  <!-- <source srcset="assets/images/hero--large.jpg 1920w, assets/images/hero--large-hi-dpi.jpg 3480w" media="(min-width: 1380px)"> -->
	  <!-- <source srcset="assets/images/hero--medium.jpg 1380w, assets/images/hero--medium-hi-dpi.jpg 2760w" media="(min-width: 990px)"> -->
	  <!-- <source srcset="assets/images/hero--small.jpg 990w, assets/images/hero--small-hi-dpi.jpg 1980w" media="(min-width: 640px)"> -->
	  <!-- <img srcset="assets/images/hero--smaller.jpg 640w, assets/images/hero--smaller-hi-dpi.jpg 1280w" alt="Coastal view" class="large-hero__image">  <!--questa è la dimensione più piccola-->
	<!-- </picture> -->
	
<!--     <div class="large-hero__text-content">
	  <div class="wrapper">
	    <h1 class="large-hero__title">Your clarity.</h1>
        <h2 class="large-hero__subtitle">One trip away.</h2>
        <p class="large-hero__description">We create soul restoring journeys that inspire you to be you.</p>
        <p><a href="#" class="btn btn--orange open-modal">Get Started Today</a></p>
	  </div>
	</div> -->
  <!-- </div> -->

 

  <footer class="site-footer">
    <div class="wrapper">
		<p><span class="site-footer__text">Copyright &copy; 2016 Clear View Escapes. All rights reserved.</span><a href="#" class="btn btn--orange open-modal">Get in Touch</a></p>
	</div>
  </footer>
  
  <div class="modal">	
	<div class="modal__inner">
		<h2 class="section-title section-title--blue section-title--less-margin"><span class="icon icon--mail section-title__icon"></span>Get in <strong>Touch</strong></h2>
		<div class="wrapper wrapper--narrow">
			<p class="modal__description">We will have an online order system soon. Until then connect with us on any of the platforms below</p>
		</div>
		
		<div class="social-icons">
			<a href="#" class="social-icons__icon"><span class="icon icon--facebook"></span></a>
			<a href="#" class="social-icons__icon"><span class="icon icon--twitter"></span></a>
			<a href="#" class="social-icons__icon"><span class="icon icon--instagram"></span></a>
			<a href="#" class="social-icons__icon"><span class="icon icon--youtube"></span></a>
		</div>
	</div>
	<div class="modal__close">X</div>
  </div>
  
  <!-- build:js assets/scripts/App.js -->
  <script src="/temp/scripts/App.js"></script>
  <!-- endbuild -->
  
</body>
</html>