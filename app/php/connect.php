<?php

	$con = mysqli_connect("localhost","root","","registration"); /*function connecting to database*/
	
	if(mysqli_connect_errno())
	{
		echo "Error occured while connecting with the database".mysqli_connect_errno(); /*prints out the error*/
	}
	
	session_start(); /*must be put in every page of the website*/
?>