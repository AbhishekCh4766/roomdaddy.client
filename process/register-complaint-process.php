<?php
include "../dbbridge/top1.php";
$db = new DBManager();
$tanent_id					=	base64_decode($_REQUEST['tanent']);
$complaint_description		=	$_REQUEST['complaint-description'];
$prefer_time				=	$_REQUEST['prefer-time'];
$prefer_date				=	$_REQUEST['prefer-date'];
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
	$target_path = '../Complaint/Complain_DOCS/';
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
	$p_image11= 'FILE_1_'.$name1;
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

/****Attachment Two***/

$file_name2="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['image2']['name'], strrpos($_FILES['image2']['name'], '.')+1));
  $tmpFilePath = $_FILES['image2']['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../Complaint/Complain_DOCS/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['image2']['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$p_image11= 'FILE_2_'.$name1;
	$file1 = $target_path.$p_image11.".".$path_parts['extension'];
	$file_name2 = $p_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$p_image11.".".$path_parts['extension']);
	}
  }

/****Attachment Two***/

/****Attachment Three***/

$file_name3="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['image3']['name'], strrpos($_FILES['image3']['name'], '.')+1));
$tmpFilePath = $_FILES['image3']['tmp_name'];
if ($tmpFilePath != "")
{
$target_path = '../Complaint/Complain_DOCS/';
if (!file_exists($target_path)) {
	
   mkdir($target_path, 0777, true);
	
}
$source = $target_path.$_FILES['image3']['name'];
if(in_array($file_ext, $arrayProfileImg)){
if(move_uploaded_file($tmpFilePath, $source)) {
  chmod($target_path, 0777);
}
$path_parts = pathinfo($source);
$name1 = time();
$p_image11= 'FILE_3_'.$name1;
$file1 = $target_path.$p_image11.".".$path_parts['extension'];
$file_name3 = $p_image11.".".$path_parts['extension'];
if(file_exists($file1))
{
	unlink($file1);
}
rename($source, $target_path.$p_image11.".".$path_parts['extension']);
}
}
/****Attachment Three***/
$flag=$db->RegisterComplaint($tanent_id,
									$complaint_description,
									$prefer_time,
									$prefer_date,
									$file_name,
									$file_name2,
									$file_name3
									);
									
foreach($_REQUEST['complaint-type'] as $complainttype)
{
	$AddComplainType=$db->AddSubComplaint($flag,$complainttype);
}
header ("Location:../complaint-registered.php");
?>