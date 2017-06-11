<?php

	include("/php/connect.php");		/*includes any file. require is for mandatory files*/
	include("/php/functions.php");
	
	$error = "";
	
	/*if savepass button is clicked*/
	if(isset($_POST['savepass']))
	{
		$password = $_POST['password'];
		$confirmPassword = $_POST['passwordConfirm'];
		
		if(strlen($password) < 8)									/*if password is shorter than 8 characters*/
		{
			$error = "Password must be greater than 8 characters";
		}
		else if($password !== $confirmPassword)						/*if passwords match*/
		{
			$error = "passwords do not match";
		}
		else														/*if everything is ok*/
		{
			$password = password_hash($password, PASSWORD_DEFAULT); /*password_hash is the most recent encryption method (uses 60 characters strings)*/
																	/*md5 can also be used but its obsolete and insecure*/
			
			$email = $_SESSION['email'];
			if(mysqli_query($con, "UPDATE users SET password='$password' WHERE email='$email'")) /*if updating the password in the database is successful*/
			{
				$error = "password successfully updated, <a href='profile.php'> click here </a> to go to the profile";
			}
		}
	}
	
	/*only logged in users can change their password*/
	if(logged_in()) 
	{

	?>
	
	<?php echo $error; ?>
	
		<form method="POST" action="changepassword.php">
		
			<label>New Password:</label><br/>
			<input type="password" name="password"/><br/><br/>
					
			<label>Re-enter Password:</label><br/>
			<input type="password" name="passwordConfirm"/><br/><br/>
			
			<input type="submit" name="savepass" value="save"/><br/><br/>
			
		</form>
	
	<?php
	}
	else
	{
		header("location: profile.php");	/*if user is not logged in he is redirected to profile*/
	}
	?>