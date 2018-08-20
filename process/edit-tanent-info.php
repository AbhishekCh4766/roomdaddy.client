<?php
include "../dbbridge/top1.php";
$db = new DBManager();


/****Profile Picture ***/
$occupantpic="";
$arrayProfileImg = array();
$arrayProfileImg[] = "pdf";
$arrayProfileImg[] = "png";
$arrayProfileImg[] = "jpg";
$arrayProfileImg[] = "jpeg";



if(!empty($_FILES['pic_occupant']['name'])){
$file_ext  = strtolower(substr($_FILES['pic_occupant']['name'], strrpos($_FILES['pic_occupant']['name'], '.')+1));
 

  $tmpFilePath = $_FILES['pic_occupant']['tmp_name'];
  if ($tmpFilePath != "")
  {
	$target_path = '../Profile/Picture/';
	if (!file_exists($target_path)) {
		
	   mkdir($target_path, 0777, true);
		
	}
    $source = $target_path.$_FILES['pic_occupant']['name'];
	if(in_array($file_ext, $arrayProfileImg)){
    if(move_uploaded_file($tmpFilePath, $source)) {
      chmod($target_path, 0777);
    }
	$path_parts = pathinfo($source);
	$name = time();
	$p_image='PROFILE_'.$name;
	$file = $target_path.$p_image.".".$path_parts['extension'];
	$occupantpic = $p_image.".".$path_parts['extension'];
	if(file_exists($file))
	{
		unlink($file);
	}
	rename($source, $target_path.$p_image.".".$path_parts['extension']);
	}
  }
}
else{

	$image = $db->getTanentById($_REQUEST['tanentid']);
	
	if(!empty($image[0]['fld_profile_picture']))
	{
     	$occupantpic = $image[0]['fld_profile_picture'];
	}else{
       	$occupantpic = null;
	}

}




/****Profile Picture***/
$updateTanent=$db->EditTanent(
								$_REQUEST['tanentid'],
								$_REQUEST['name'],
								$_REQUEST['email'],
								$_REQUEST['number'],
								$_REQUEST['whatsapp_number'],
								$_REQUEST['gender'],
								$occupantpic
								);
//$AddSetupDone=$db->SetupDone($_REQUEST['tanentid']);
header("Location:../index.php");
?>