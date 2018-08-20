<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

include_once("apimanager.php");
$action = '';


if(isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch($action){

    case 'add_notice':
         add_notice();
         break;

    case 'view_notice':
         view_notice();
         break;

    case 'save_register_complaint':
          save_register_complaint();
          break;   

    case 'get_user_profile':
          get_user_profile();
          break;

    case 'update_user_profile':
          update_user_profile();
          break;

    case 'get_complaint_status':
          get_complaint_status();
          break;

    case 'get_notice_status':
          get_notice_status();
          break;

    case 'get_payment_history':
          get_payment_history();
          break;

    case 'get_resubmit_notice':
          get_resubmit_notice();
          break;

    default:
        not_found();
}




function add_notice()
{ 
   $tenent_id = $_GET['tenent_id'];
   $date      = $_GET['date'];
   $reason    = $_GET['reason'];
   notice($tenent_id,$reason,$date);

}

function get_resubmit_notice()
{ 
   $tenent_id = $_GET['tenent_id'];
   $date      = $_GET['date'];
   $reason    = $_GET['reason'];
   resubmit_notice($tenent_id,$reason,$date);

}

function view_notice()
{ 
   $tenent_id = $_GET['tenent_id'];
   get_notice($tenent_id);

}

function save_register_complaint()
{
  if(!empty($_REQUEST['tenent_id']))
  {
      $tenent_id = $_REQUEST['tenent_id']; 
      if(!empty($_REQUEST['complaint-type']))
      {
         $complaint_type = $_REQUEST['complaint-type'];
      }

      if(!empty($_REQUEST['complaint_description']))
      {
         $complaint_description = $_REQUEST['complaint_description'];
      }

      if(!empty($_REQUEST['prefer_time']))
      {
         $prefer_time = $_REQUEST['prefer_time'];
      }

      if(!empty($_REQUEST['prefer_date']))
      {
         $prefer_date = $_REQUEST['prefer_date'];
      }
     
      if(!empty($_FILES['image1']['name']))
      { 
          $attachment_one="";
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
            $attachment_one = $p_image11.".".$path_parts['extension'];
            if(file_exists($file1))
            {
              unlink($file1);
            }
            rename($source, $target_path.$p_image11.".".$path_parts['extension']);
            }
          }
        }

    if(!empty($_FILES['image2']['name']))
    { 
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
          $attachment_two = $p_image11.".".$path_parts['extension'];
          if(file_exists($file1))
          {
            unlink($file1);
          }
          rename($source, $target_path.$p_image11.".".$path_parts['extension']);
          }
        }
    }

     if(!empty($_FILES['image3']['name']))
     { 
        $attachment_three ="";
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
        $attachment_three = $p_image11.".".$path_parts['extension'];
        if(file_exists($file1))
        {
          unlink($file1);
        }
        rename($source, $target_path.$p_image11.".".$path_parts['extension']);
        }
        }
    }
   $return =  register_complaint($tenent_id,$complaint_type,$complaint_description,$prefer_time,$prefer_date,$attachment_one,$attachment_two,$attachment_three);
  }
  else
  {
    $jsonstring = array('status'=>false,'message'=>"Please enter tenent_id."); 
  }
}



function update_user_profile()
{
    $tenent_id =$_POST['tenent_id'];

  if(!empty($tenent_id))
  {
     $tenent_id =$_POST['tenent_id'];
     $get_tenent_info = get_profile($tenent_id);
       
    /* echo "<pre/>";
    
    print_r($get_tenent_info);
    die;*/

     if(!empty($get_tenent_info['data']) && !empty($get_tenent_info))
     { 

      if(!empty($_POST['whatsapp_no']))
      {
        $whatsapp_no = $_POST['whatsapp_no'];
      }else{
        $whatsapp_no =$get_tenent_info['data']['fld_whatsapp_no'];
      }
     
      if(!empty($_POST['phone_no']))
      {
        $phone_no = $_POST['phone_no'];
      }else{
        $phone_no =$get_tenent_info['data']['fld_number'];
      }
     
      if(!empty($_POST['occupant_name']))
      {
        $occupant_name = $_POST['occupant_name'];
      }else{
        $occupant_name =$get_tenent_info['data']['fld_name'];
      }
      
      if(!empty($_POST['email']))
      {
        $email = $_POST['email'];
      }else{
        $email =$get_tenent_info['data']['fld_email'];
      }
      
      if(!empty($_POST['gender']))
      {
        $gender = $_POST['gender'];
      }else{
        $gender =$get_tenent_info['data']['fld_sex'];
      }

    //$image =  $_FILES['pic_occupant']['name'];
    if(!empty($_FILES['pic_occupant']['name']))
     {
        $occupantpic="";
        $arrayProfileImg = array();
        $arrayProfileImg[] = "pdf";
        $arrayProfileImg[] = "png";
        $arrayProfileImg[] = "jpg";
        $arrayProfileImg[] = "jpeg";
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
          $pic_occupant = $occupantpic;
    }else{
         $pic_occupant = $get_tenent_info['data']['profile_picture'];
    }
    

    //die('here');
   
     $return =  update_profile($tenent_id,$whatsapp_no,$phone_no,$occupant_name,$email,$gender,$pic_occupant);


     }
     else{
       $jsonstring = array('status'=>false,'message'=>"tenent_id not found."); 
     }
  }else{
    $jsonstring = array('status'=>false,'message'=>"Please enter tenent_id."); 
  }

}








function update_user_profilddde()
{
   
die('hersssse');
  $tenent_id =191;
  if(!empty($tenent_id))
  {
     $tenent_id = $_REQUEST['tenent_id'];
     $get_tenent_info = get_profile($tenent_id);
    
     /* echo "<pre/>";
      print_r($get_tenent_info['fld_profile_picture']);
      die;*/
       
     if(!empty($get_tenent_info['data']))
     { 

      if(!empty($_REQUEST['whatsapp_no']))
      {
        $whatsapp_no = $_REQUEST['whatsapp_no'];
      }else{
        $whatsapp_no =$get_tenent_info['data']['fld_whatsapp_no'];
      }
     
      if(!empty($_REQUEST['phone_no']))
      {
        $phone_no = $_REQUEST['phone_no'];
      }else{
        $phone_no =$get_tenent_info['data']['fld_number'];
      }
     
      if(!empty($_REQUEST['occupant_name']))
      {
        $occupant_name = $_REQUEST['occupant_name'];
      }else{
        $occupant_name =$get_tenent_info['data']['fld_name'];
      }
      
      if(!empty($_REQUEST['email']))
      {
        $email = $_REQUEST['email'];
      }else{
        $email =$get_tenent_info['data']['fld_email'];
      }
      
      if(!empty($_REQUEST['gender']))
      {
        $gender = $_REQUEST['gender'];
      }else{
        $gender =$get_tenent_info['data']['fld_sex'];
      }
      



     //$image =  $_FILES['pic_occupant']['name'];

     $target_dir = "http://roomdaddy.ae/Profile/Picture/";

      if(!empty($_FILES['profile_pic']['name']))
     {
        $occupantpic="";
        $arrayProfileImg = array();
        $arrayProfileImg[] = "pdf";
        $arrayProfileImg[] = "png";
        $arrayProfileImg[] = "jpg";
        $arrayProfileImg[] = "jpeg";
        $file_ext  = strtolower(substr($_FILES['profile_pic']['name'], strrpos($_FILES['profile_pic']['name'], '.')+1));
          $tmpFilePath = $_FILES['profile_pic']['tmp_name'];
          if ($tmpFilePath != "")
          {
          $target_path = '../Profile/Picture/';
          if (!file_exists($target_path)) {
            
             mkdir($target_path, 0777, true);
            
          }
            $source = $target_path.$_FILES['profile_pic']['name'];
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
          $pic_occupant = $occupantpic;
    }else{
         $pic_occupant = $get_tenent_info['data']['profile_picture'];
    }

  /*  echo "<pre/>";
    print_r($_FILES['profile_pic']['name']);
    die('KAMAKL');*/

   
     $return =  update_profile($tenent_id,$whatsapp_no,$phone_no,$occupant_name,$email,$gender,$pic_occupant);


     }
     else{
       $jsonstring = array('status'=>false,'message'=>"tenent_id not found."); 
     }
  }else{
    $jsonstring = array('status'=>false,'message'=>"Please enter tenent_id."); 
  }

}

function get_complaint_status()
{

  $tenent_id = $_GET['tenent_id'];
  if(!empty($tenent_id))
  {
    $return =  get_complaint($tenent_id);

     if(!empty($return['data']))
     {

      $result = $return['data'];
      $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 
     }else{
      
      $jsonstring = array('status'=>false,'message'=>"Tenent not found."); 
     }
      

    }else{
      $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
}

function get_notice_status()
{

  $tenent_id = $_GET['tenent_id'];
  if(!empty($tenent_id))
  {
    $return =  notice_status($tenent_id);

     if(!empty($return['data']))
     {

      $result = $return['data'];
      $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 
     }else{
      
      $jsonstring = array('status'=>false,'message'=>"Tenent not found."); 
     }
      

    }else{
      $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
}



function get_payment_history()
{

  $tenent_id = $_GET['tenent_id'];
  if(!empty($tenent_id))
  {
    $return =  payment_history($tenent_id);

     if(!empty($return['data']))
     {

      $result = $return['data'];
      $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 
     }else{
      
      $jsonstring = array('status'=>false,'message'=>"Tenent not found."); 
     }
    
    }else{
      $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);
}


function get_user_profile()
{

  $tenent_id = $_GET['tenent_id'];
  if(!empty($tenent_id))
  {
    $return =  get_profile($tenent_id);

     if(!empty($return['data']))
     {

      $result = $return['data'];
      $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$result); 
     }else{
      
      $jsonstring = array('status'=>false,'message'=>"Tenent not found."); 
     }
      

    }else{
      $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }
    echo json_encode($jsonstring);

}




 /*Not found*/
  function not_found() {
    $bind = [];
    $bind['status'] = 0;
    $bind['message'] = 'The requested action not found';
    $json = json_encode($bind);
    header('HTTP/1.1 400 Not Found');
    header('Content-Type: application/json');
    echo $json;
    die;
}
?>