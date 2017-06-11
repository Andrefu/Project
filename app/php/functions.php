<?php
	
	/*determines if the email provided as parameter exists in the database*/
	function email_exists($email, $con)
	{
		$result = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");	/*find the id from user table containing $email*/
		
		if(mysqli_num_rows($result) == 1)  	/*mysqli_num_rows() returns the n. of rows (in integers) containing $result. There should be one*/
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*determines if the user is logged in*/
	function logged_in() 
	{
		if(isset($_SESSION['email']) || isset($_COOKIE['email']))	/*if there is an open session (with email parameter) OR 
																	the cookie exists then the user is logged in*/
		{
			return true;
		}
		else
		{
			return false;
		}
	}
?>