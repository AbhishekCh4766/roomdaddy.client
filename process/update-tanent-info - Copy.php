<?php
include "../dbbridge/top1.php";
$db = new DBManager();

$tanentid			=	$_REQUEST['tanentid'];
$tanentname			=	$_REQUEST['user-name'];
$tanentemail		=	$_REQUEST['email'];
$tanenetnumber		=	$_REQUEST['number'];
$tanentwhatsapp		=	$_REQUEST['whatsapp-number'];
$tanentnationality	=	$_REQUEST['nationality'];
$tanentgender		=	$_REQUEST['gender'];
/****Attachment One***/


$file_name="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['image1']['name'], strrpos($_FILES['image1']['name'], '.')+1));
  $tmpFilePath = $_FILES['image1']['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../Profile/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['image1']['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$p_image11= 'PROFILE_'.$name1;
	$file1 = $target_path.$p_image11.".".$path_parts['extension'];
	$file_name = $p_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$p_image11.".".$path_parts['extension']);
	}
  }

/****Attachment One***/
$flag=$db->UpdateTanent($tanentid,
						$tanentname,
						$tanentemail,
						$tanenetnumber,
						$tanentwhatsapp,
						$tanentnationality,
						$file_name,
						$tanentgender
						);

header("Location:../index.php");
?>