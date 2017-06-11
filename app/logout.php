<?php

	session_start(); 						/*session must be started everywhere otherwise, in this file, it will not know which session to destroy*/
	session_destroy(); 						/*session is destroyed*/
	setcookie("email", '', time()-3600);	/*time()-3600 will make the cookie expire*/
	header("location: login.php"); 			/*with the session being destroyed, user is brought to login.php*/

?>