<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

include_once("apimanager.php");
include_once("../common/functions.php");
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

    case 'get_client_complaint_status':
          get_client_complaint_status();
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

    case 'get_chat':
          get_chat();
          break;

    case 'add_chat':
          add_chat();
          break;

    case 'closed_complaint':
          closed_complaint();
          break;

    case 'book_room':
          book_room();
          break;

    case 'update_device_id':
          update_device_id();
          break;

    case 'change_password':
          change_password();
          break;

    default:
        not_found();
}




 function update_device_id()
 {
  $user_type  = $_REQUEST['user_type'];
  $user_id = $_REQUEST['user_id'];
  $device_type = $_REQUEST['device_type'];
  $device_id = $_REQUEST['device_id'];

  if(!empty($user_type) && !empty($user_id) && !empty($device_type) && !empty($device_id))
  {
       $status = updateDeviceId($user_type,$user_id,$device_type,$device_id);
       if($status['status'] == 1)
       {
        $jsonstring = array('status'=>true,'message'=>"Updated successfull."); 
       }else{
        $jsonstring = array('status'=>false,'message'=>"Something went wrong."); 
       }
  }else{
    $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
 }


 function change_password()
 {
  $old_pass  = $_REQUEST['old_pass'];
  $new_pass = $_REQUEST['new_pass'];
  $conf_pass = $_REQUEST['conf_pass'];
  $id = $_REQUEST['id'];


  if(!empty($old_pass) && !empty($new_pass)&& !empty($id) && !empty($conf_pass))
  {   if($new_pass== $conf_pass)
       {
         if($old_pass == $new_pass)
       {
        
        $jsonstring = array('status'=>false,'message'=>"Oops!!! Old Password And New Password can not be same, Please enter different Password"); 
       }
       else {
       $result = getClientDetails_byId($id);
       $result = $result['data'];

        if(ifish_validatePassword($old_pass,$result['fld_password']))
      {  
        $pass  =  ifish_encryptPassword($new_pass);

        $change_pass = change_password_cli($pass, $id);
        $jsonstring = array('status'=>true,'message'=>"Password Updated successfully."); 
       }else{
        $jsonstring = array('status'=>false,'message'=>"You Entered Wrong Password!!!"); 
       }         
                  
             }
       }
       else {
         $jsonstring = array('status'=>false,'message'=>"New Password And Confirm Password did't match!!! Please check");
       }
      
  }else{
    $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
 }






function book_room(){
  
  sendPushNotificationToFCMSever();

 /* $client_id  = $_REQUEST['client_id'];
  $status = $_REQUEST['status'];
  $complaint_id = $_REQUEST['complaint_id'];*/
    

}





function closed_complaint(){
  $client_id  = $_REQUEST['client_id'];
  $status = $_REQUEST['status'];
  $complaint_id = $_REQUEST['complaint_id'];
   

   if(!empty($client_id) && !empty($status) && !empty($complaint_id))
   {
      $status = closedComplaint($client_id,$status,$complaint_id);
       if($status['status']==1)
       {
      
         $jsonstring = array('status'=>true,'message'=>"Status changed successfull."); 
       }else{
         $jsonstring = array('status'=>false,'message'=>"Something went wrong please try again."); 
       }
   }else{
    $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
   }
   echo json_encode($jsonstring);
 }






function add_notice()
{ 

   $tenent_id = $_REQUEST['tenent_id'];
   $date      = $_REQUEST['date'];
   $reason    = $_REQUEST['reason'];
   notice($tenent_id,$reason,$date);

}






function get_resubmit_notice()
{ 
   $tenent_id = $_REQUEST['tenent_id'];
   $date      = $_REQUEST['date'];
   $reason    = $_REQUEST['reason'];
  resubmit_notice($tenent_id,$reason,$date);

}






function view_notice()
{ 
   $tenent_id = $_GET['tenent_id'];
   get_notice($tenent_id);

}






function add_chat()
{  
     
    $sub_com_id = $_REQUEST['sub_com_id'];
    $message = $_REQUEST['message'];
    $tenent_id = $_REQUEST['tenent_id'];
    $user_type = $_REQUEST['user_type'];

    if(!empty($sub_com_id) && !empty($message) && !empty($tenent_id) && !empty($user_type)){
      $get_sub_complaints  = getSubComplaints($sub_com_id);

      if($get_sub_complaints == 1)
      {

        $sent_chat_status =  add_chatById($sub_com_id,$tenent_id,$user_type,$message);
        
        if($user_type =='A')
        {
          $get_admin_details = getAdminDetails($tenent_id);

          if($get_admin_details == 0)
          {
           $jsonstring = array('status'=>false,'message'=>"Admin id not found.");
            echo json_encode($jsonstring);
           die;  
          }
        }
        if($user_type =='C'){
          $get_client_details = getClientDetails($tenent_id);  
          if($get_client_details == 0)
          {
           $jsonstring = array('status'=>false,'message'=>"Client id not found.");
           echo json_encode($jsonstring);
           die; 
          } 
       
        }
         //for notification

         if($user_type =='A')
         {
           //when send admin then noti for client 
           $notification_for_user =  notificationData($user_type,$message,$sub_com_id);
           if(!empty($notification_for_user['data']))
               {
                 sendPushNotificationToFCMSever($notification_for_user,$message);
               }
           
         }

         if($user_type =='C')
         {
           $notification_for_user =  notificationData($user_type,$message,$sub_com_id);
           //when send admin then noti for admin 
           //$notification_for_user = 
         }


          
            //$regID,$message
          sendPushNotificationToFCMSever($notification_for_user,$message);


         

      if($sent_chat_status == 1)
      {
         $jsonstring = array('status'=>true,'message'=>"Message sent successfully."); 
      }else{
        $jsonstring = array('status'=>false,'message'=>"Something went wrong."); 
      }
     
      }else{
      $jsonstring = array('status'=>false,'message'=>"Sub com id not found."); 
      }

    }else{
      $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
    }

    /* $message = $_REQUEST['message'];
    $tenent_id = $_REQUEST['tenent_id'];
    $user_type = $_REQUEST['user_type'];
    add_chatById($sub_com_id,$tenent_id,$user_type,$message);*/
    echo json_encode($jsonstring);
}







function get_chat(){
  $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdadd_roomdaddy_new");
  //$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
  // Check connection
  if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die('Failed to connect to MySQL');
  }
      $sub_com_id = $_REQUEST['sub_com_id'];  
   //$sql = "SELECT * from `tbl_chats` WHERE `fld_sub_complain_id`=$sub_com_id ";
  /*  $sql = "SELECT `tbl_chats`.*,`tbl_admin`.`fld_name`,`tbl_admin`.`fld_profile_pic` from `tbl_chats`
    LEFT JOIN `tbl_admin` ON `tbl_admin`.`fld_id`=`tbl_chats`.`fld_sender_id` WHERE `fld_sub_complain_id`=$sub_com_id";*/
  
  $sql = "SELECT `tbl_chats`.* from `tbl_chats`  WHERE `fld_sub_complain_id`=$sub_com_id";

  $result = $con->query($sql);

  if ($result->num_rows > 0) 
  {
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    { 

      if($row['fld_sender']=='Admin')
      {  
        $sql= "SELECT `tbl_admin`.* from `tbl_admin` WHERE `tbl_admin`.`fld_id`=".$row['fld_sender_id']."";
        $data = $con->query($sql);
        $admin_details = mysqli_fetch_array($data,MYSQLI_ASSOC);
                       
        $admin_name = $admin_details['fld_name'];

        if(!empty($admin_details['fld_profile_pic']))
        {
          $admin_image  = "http://roomdaddy.ae/roomdaddy/admin/img/profile/".$admin_details['fld_profile_pic'];
        }else{
          $admin_image ="";
        }

      }
         

      if($row['fld_sender']=='Tenant')
      {
        $sql = "SELECT `tbl_tanents`.* from `tbl_tanents` WHERE `tbl_tanents`.`fld_id`=".$row['fld_sender_id']."";
        $data = $con->query($sql);
        $tenant_details = mysqli_fetch_array($data,MYSQLI_ASSOC);

        $tenant_name = $tenant_details['fld_name'];

        if(!empty($tenant_name['fld_profile_pic']))
        {
          $tenant_image  ="http://roomdaddy.ae/Profile/Picture/".$tenant_details['fld_profile_pic'];
        }else{
          $tenant_image ="";
        }

       
      }   

    $bus = array(
                'fld_id' => $row['fld_id'],
                'fld_sub_complain_id' => $row['fld_sub_complain_id'],
                'fld_sender' => $row['fld_sender'],
                'fld_sender_id' => $row['fld_sender_id'],
                'fld_message' => $row['fld_message'],
                'fld_update_date' => $row['fld_update_date'],
                'admin_name' =>$admin_name,
                'admin_image'=>$admin_image,
                'tenant_name' =>$tenant_name,
                'tenant_image'=>$tenant_image,
               ); 

    array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json); 
      
  }
  else{
     $jsonstring = array('status'=>false,'message'=>"Please fill all the fields."); 
  }
  echo json_encode($jsonstring);
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
  $tenent_id =$_REQUEST['tenent_id'];
  if(!empty($tenent_id))
  {  
     $tenent_id =$_REQUEST['tenent_id'];
     $get_tenent_info = get_profile($tenent_id);
   
 
     if(!empty($get_tenent_info['data']) || !empty($get_tenent_info))
     { 
      
      if(!empty($_REQUEST['whatsapp_no']))
      {
        $whatsapp_no = $_REQUEST['whatsapp_no'];
      }else{
        $whatsapp_no =$get_tenent_info['data']['fld_whatsapp_no'];
      }
    
      if(!empty($_REQUEST['phone_no']))
      {
        $phone_no =$_REQUEST['phone_no'];
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
    }

    else
    {
         $pic_occupant = $get_tenent_info['data']['fld_profile_picture'];
    }
     
     $return =  update_profile($tenent_id,$whatsapp_no,$phone_no,$occupant_name,$email,$gender,$pic_occupant);

     }
     else
     {
       $jsonstring = array('status'=>false,'message'=>"tenent_id not found."); 
     }
  }
  else
  {
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


function get_client_complaint_status()
{
  $tenent_id = $_GET['tenent_id'];
  if(!empty($tenent_id))
  {
    $return =  get_client_complaint($tenent_id);

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