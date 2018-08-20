<?php 
	if(!isset($_SESSION[ADMIN_SESSION_NAME]['tanentid']))
	{
		header("Location: login.php");
	}
?>