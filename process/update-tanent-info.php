<?php
include "../dbbridge/top1.php";
$db = new DBManager();

$getTenantById=$db->getTanentById($_REQUEST['tanentid']);
$GetSubtanentByTanentId=$db->GetSubtanentsByTanentId($_REQUEST['tanentid']);
if($GetSubtanentByTanentId[0]!="")
{
	$deleteSubtanents=$db->DeleteSubtanentsByTanentid($_REQUEST['tanentid']);
}

// function UpdateTanent($id,$name,$email,$number,$whatsapp,$nationality,$profilepicture,$sex)

for($i=1;$i<=$getTenantById[0]['fld_num_of_occupants'];$i++)
{
	
/****Profile Picture ***/
$occupantpic="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['pic_occupant'.$i]['name'], strrpos($_FILES['pic_occupant'.$i]['name'], '.')+1));
  $tmpFilePath = $_FILES['pic_occupant'.$i]['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../Profile/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['pic_occupant'.$i]['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$p_image11= $i.'PROFILE_'.$name1;
	$file1 = $target_path.$p_image11.".".$path_parts['extension'];
	$occupantpic = $p_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$p_image11.".".$path_parts['extension']);
	}
  }
/****Profile Picture***/


/****Passport Page**********/

$passport_pic="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['passport'.$i]['name'], strrpos($_FILES['passport'.$i]['name'], '.')+1));
  $tmpFilePath = $_FILES['passport'.$i]['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../Passport/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['passport'.$i]['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$pp_image11= $i.'PASSPORT_'.$name1;
	$file1 = $target_path.$pp_image11.".".$path_parts['extension'];
	$passport_pic = $pp_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$pp_image11.".".$path_parts['extension']);
	}
  }
/****Passport Page**********/

/****Visa Page**********/

$visa_pic="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['visa'.$i]['name'], strrpos($_FILES['visa'.$i]['name'], '.')+1));
  $tmpFilePath = $_FILES['visa'.$i]['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../visa/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['visa'.$i]['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$pp_image11= $i.'VISA_'.$name1;
	$file1 = $target_path.$pp_image11.".".$path_parts['extension'];
	$visa_pic = $pp_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$pp_image11.".".$path_parts['extension']);
	}
  }
/****Visa Page**********/

/****Emirates ID Front Page**********/

$emiratesfront="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['emiratefront'.$i]['name'], strrpos($_FILES['emiratefront'.$i]['name'], '.')+1));
  $tmpFilePath = $_FILES['emiratefront'.$i]['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../emiratefront/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['emiratefront'.$i]['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$pp_image11= $i.'EmiratesFront_'.$name1;
	$file1 = $target_path.$pp_image11.".".$path_parts['extension'];
	$emiratesfront = $pp_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$pp_image11.".".$path_parts['extension']);
	}
  }
/****Emirates ID Front Page**********/

/****Emirates ID Back Page**********/

$emiratesback="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";


$file_ext  = strtolower(substr($_FILES['emirateback'.$i]['name'], strrpos($_FILES['emirateback'.$i]['name'], '.')+1));
  $tmpFilePath = $_FILES['emirateback'.$i]['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../emirateback/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['emirateback'.$i]['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name1 = time();
	$pp_image11= $i.'EmiratesBack_'.$name1;
	$file1 = $target_path.$pp_image11.".".$path_parts['extension'];
	$emiratesback = $pp_image11.".".$path_parts['extension'];
	if(file_exists($file1))
	{
		unlink($file1);
	}
	rename($source, $target_path.$pp_image11.".".$path_parts['extension']);
	}
  }
/****Emirates ID Back Page**********/
	$AddSubtanent=$db->AddSubTanents(
									$_REQUEST['tanentid'],
									$_REQUEST['user-name'.$i],
									$_REQUEST['email'.$i],
									$_REQUEST['number'.$i],
									$_REQUEST['whatsapp-number'.$i],
									$_REQUEST['nationality'.$i],
									$_REQUEST['gender'.$i],
									$occupantpic,
									$passport_pic,
									$visa_pic,
									$emiratesfront,
									$emiratesback
									);
}

// function UpdateTanent($id,$name,$email,$number,$whatsapp,$nationality,$profilepicture,$sex)

$moveindate=$_REQUEST['move-in-year']."-".$_REQUEST['move-in-month']."-".$_REQUEST['move-in-date'];
$updateTanent=$db->UpdateTanent(
								$_REQUEST['tanentid'],
								$_REQUEST['user-name'."1"],
								$_REQUEST['email'."1"],
								$_REQUEST['number'."1"],
								$_REQUEST['whatsapp-number'."1"],
								$_REQUEST['nationality'."1"],
								"",
								$_REQUEST['gender'."1"],
								$moveindate
								);
//$AddSetupDone=$db->SetupDone($_REQUEST['tanentid']);
header("Location:../index.php");
?>