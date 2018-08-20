<?php 
	include_once("dbbridge/top.php");
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '1')
	{
		include("process/login_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '2')
	{
		include("process/get_thread_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '3')
	{
		include("process/add_comment_process.php");
	}
	if($_REQUEST['calling'] !="" && $_REQUEST['calling'] == '4')
	{
		include("process/add_notice_process.php");
	}
	
?>

