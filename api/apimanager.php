<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');



function db_connect()
{
  $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdadd_roomdaddy_new");
 // $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
  
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   die('Failed to connect to MySQL');
  }
  
  return $con;
}
 

  function notificationData($user_type,$message,$sub_com_id){
      
      $con = db_connect();

      if($user_type =='A')
      {
        $sql = "SELECT `tbl_sub_complaints`.*,`tbl_tanents`.`device_id` as device_id  FROM `tbl_sub_complaints`
              INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`= `tbl_complaints`.`fld_id`
              INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id`= `tbl_tanents`.`fld_id`
              WHERE `tbl_sub_complaints`.`fld_id`=$sub_com_id";
      }
      if($user_type =='C'){
        
         $sql = "SELECT `tbl_admin`.*,`tbl_admin`.`device_id` as device_id  FROM `tbl_roles` 
                INNER JOIN `tbl_role_assign` ON `tbl_roles`.`fld_id` = `tbl_role_assign`.`fld_role` 
                INNER JOIN `tbl_admin` ON `tbl_role_assign`.`fld_admin_id`=`tbl_admin`.`fld_id`
                WHERE `tbl_roles`.`fld_role` = 'SuperAdmin'";
      }
      

      $result = $con->query($sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      if(!empty($row['fld_id'])){
       return array('data'=>$row);
      }else{
       return array('data'=>'');
      }
  
   }


 function getAdminDetails($id)
 {
     $con = db_connect();

     $sql = "SELECT * FROM `tbl_admin` WHERE `fld_id`=".$id."";
   
     $result = $con->query($sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     if(!empty($row['fld_id'])){
         return 1;
     }else{
         return 0;
     }
 }


  function getClientDetails($id)
 {
   $con = db_connect();

     $sql = "SELECT * FROM `tbl_tanents` WHERE `fld_id`=".$id."";
   
     $result = $con->query($sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     if(!empty($row['fld_id'])){
         return 1;
     }else{
         return 0;
     }
 }

   function getClientDetails_byId($id)
 {
   $con = db_connect();

     $sql = "SELECT * FROM `tbl_tanents` WHERE `fld_id`=".$id."";
   
     $result = $con->query($sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     if(!empty($row['fld_id'])){
         return array('data'=>$row);
     }else{
         return 0;
     }
 }



function sendPushNotificationToFCMSever($notification_for_user,$message) {
  

  // print_r($notification_for_user);
  // die;   
    $regID = $notification_for_user['data']['device_id'];
   /* $regID = "duv0---Wgpo:APA91bF28dJ5w1EaqpjX8JarprKVlqhL4NZex425bzfHqA0a_dkMQrH343dlALhFh8VVLx3X-ifOaDx9kkBqB6C6t1CnGzd5QtutpGsvPafFHVk0fxDEUbKMnVUPnmQa51hkjSXMuZj0lobiR0FVsk-b0aPUKEfZAA";*/
    $registrationIds = array($regID);
    //$message ="Hello subodh";
    define('API_ACCESS_KEY', 'AAAAtZVN4KY:APA91bER55Jdp8akdKDih69VRRq5nRomMZ8nARI0yEMVSXttnsK7P64ZuzxzdwF8JmF7OvoMEgR_aHtpno8B36ssTeukTAvqysqvCxP44667irzxnWJh1z-uKAeiX13Q7Ls9ug43OcXgtjnBWO4Iiv-0kzBJQHPjvg');
// prep the bundle
    // $msg = array
    //     (
    //     'alert' => $message,
    //     'vibrate' => 1,
    //     'sound' => 1,
    //     'noti_type' => 'chat',
    //     'title'=>'RoomDaddy',
        
    // );

    // $fields = array
    //     (
    //     'registration_ids' => $registrationIds,
    //     'data' => $msg
    // );

//-------------

    $fields = array(
        'registration_ids' => $registrationIds,
        'data' => array(
                            'message' => $message,
                            'click_action' => "FCM_PLUGIN_ACTIVITY",
                            'sound'=>'default',
                            'vibrate' => 1,
                            "time_to_live"  => 10,
                            'sound' => 1,
                            "priority" => "high",
                            "title" => "1 new message",                
                            'noti_type' => 'chat',
                            "sound" => "default",
                            "icon" => "http://roomdaddy.ae/roomdaddy/admin/img/room.png'",   
                      ),
        'notification'=>array(
                            'message' => $message,
                            'click_action' => "FCM_PLUGIN_ACTIVITY",
                            'sound'=>'default',
                            'vibrate' => 1,
                            "time_to_live"  => 10,
                            'sound' => 1,
                            "priority" => "high",
                            "title" => "1 new message",              
                            'noti_type' => 'chat',
                            "sound" => "default",
                            "icon" => "http://roomdaddy.ae/roomdaddy/admin/img/room.png'",   
                          ),
        'priority'=> "high"
    );

//----------------------
    $headers = array
    (
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    
    //print_r($result);
    return 'sent';
}




  function getSubComplaints($sub_com_id)
  {
     $con = db_connect();
     $sql = "SELECT * FROM `tbl_sub_complaints`
             INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`= `tbl_complaints`.`fld_id`
             WHERE `tbl_sub_complaints`.`fld_id`=$sub_com_id";

     $result = $con->query($sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

     if(!empty($row['fld_id'])){
         return 1;
     }else{
         return 0;
     }
  } 


  function updateDeviceId($user_type,$user_id,$device_type,$device_id){
  
   $con = db_connect();
   
   if($user_type=='A'){
    $sql = "UPDATE tbl_admin SET device_type='".$device_type."',device_id='".$device_id."'  WHERE  fld_id=".$user_id."";
   }

   if($user_type=='C'){
    $sql = "UPDATE tbl_tanents SET device_type='".$device_type."',device_id='".$device_id."'  WHERE  fld_id=".$user_id."";
   }

   $result = $con->query($sql);
   
    if($result == 1){
      $status = 1;
    }else{
      $status = 0;
    }

  return array('status'=>$status);
 }






  function closedComplaint($client_id,$status,$complaint_id)
  {
     $con = db_connect();
     $sql = "UPDATE tbl_sub_complaints SET is_closed='".$status."' WHERE  fld_id=".$complaint_id."";
     $result = $con->query($sql);
      if($result == 1){
        $status = 1;
      }else{
        $status = 0;
      }
     return array('status'=>$status);
  }






function notice($tenent_id,$reason,$date)
{
  $con = db_connect();
  $sql = "INSERT INTO tbl_notice (move_out_reason,move_out_date,tenent_id) VALUES ( '".$reason."','".$date."','".$tenent_id."')";
  //echo $sql; exit;
  $result = $con->query($sql);

  if ($result == 1) 
  {
      $json = array(); 
      $bus = array(
     'status' => 'success',
     'msg'  => 'Notice Added Successfully'       
      );
  array_push($json, $bus);
  $jsonstring = array('status'=>true,'message'=>"Notice Added Successfully"); 
  }  
  else 
  {
      $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
  }
  echo json_encode($jsonstring); 
  mysqli_close($con);
}




function update_profile($tenent_id,$whatsapp_no,$phone_no,$occupant_name,$email,$gender,$pic_occupant)
{
  $con = db_connect();
  $sql = "UPDATE tbl_tanents SET fld_whatsapp_no='$whatsapp_no', fld_number='$phone_no', fld_name='$occupant_name',fld_email='$email',fld_sex='$gender',fld_profile_picture='$pic_occupant' WHERE fld_id=$tenent_id ";

  $result = $con->query($sql);
  if($result == 1) 
  {
      $json = array(); 
      $bus = array(
     'status' => 'success',
     'msg'  => 'update profile Successfully'       
      );
 
  $jsonstring = array('status'=>true,'message'=>"update profile Successfully"); 
  }  
  else 
  {
      $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
  }
  echo json_encode($jsonstring); 
  mysqli_close($con);
}

  function change_password_cli($pass,$id)
{
  $con = db_connect();
  $sql = "UPDATE `tbl_tanents` SET `fld_password` = '$pass' WHERE fld_id= $id";

   //echo $sql;
  $result = $con->query($sql);

  if ($result == 1) 
  {
      $status = 1;
  }  
  else 
  {
     $status =0;
  }
  return $status;
  }

function register_complaint($tenent_id,$complaint_type,$complaint_description,$prefer_time,$prefer_date,$attachment_one,$attachment_two,$attachment_three)
{
  $con = db_connect();
  $sql = "INSERT INTO tbl_complaints (fld_tenant_id,fld_complaint_description,fld_prefer_time,fld_prefer_date,fld_attachment_one,fld_attachment_two,fld_attachment_three) VALUES ( '".$tenent_id."','".$complaint_description."','".$prefer_time."','".$prefer_date."','".$attachment_one."','".$attachment_two."','".$attachment_three."')";
  $result = $con->query($sql);
  if($result == 1) 
  {
      $fld_complaint_id = $con->insert_id;

      $complaint_type = explode(',',$complaint_type);
      //$complaint_type1 = array('Cleaning','Key');
      foreach($complaint_type as $complaint_type)
      {
        $sql1 = "INSERT INTO tbl_sub_complaints (fld_complaint_id,fld_complaint_type) VALUES ( '".$fld_complaint_id."','".$complaint_type."')";
        $result = $con->query($sql1);
      }
      $json = array(); 
      $bus = array(
     'status' => 'success',
     'msg'  => 'Complaint insert Successfully'       
      );
  $jsonstring = array('status'=>true,'message'=>"Complaint insert Successfully"); 
  }  
  else 
  {
      $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
  }
  echo json_encode($jsonstring); 
  mysqli_close($con);
}


function add_chatById($sub_com_id,$tenent_id,$user_type,$message)
{

  // print_r($_REQUEST);
  // die;
  $con = db_connect();

  //Get user info.
  // $sql = "INSERT INTO tbl_chats (fld_sub_complain_id,fld_sender_id,fld_message,fld_sender) VALUES ( '".$sub_com_id."','".$tenent_id."','".$message."','Tenant')";
  // $result = $con->query($sql);

  

  $sql = "INSERT INTO tbl_chats (fld_sub_complain_id,fld_sender_id,fld_message,fld_sender) VALUES ('".$sub_com_id."','".$tenent_id."','".$message."','Tenant')";


  $result = $con->query($sql);
  if($result == 1) 
  {
     /* $bus = array(
     'status' => 'success',
     'msg'  => 'Chat insert Successfully'       
      );*/
      return 1;
     //$jsonstring = array('status'=>true,'message'=>"Chat insert Successfully"); 
  }  
  else 
  {
     return 0;
      //$jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
  }
  //echo json_encode($jsonstring); 
  mysqli_close($con);
}


function resubmit_notice($tenent_id,$reason,$date)
{


  $con = db_connect();
  $sql = "Update tbl_notice set move_out_reason='$reason', move_out_date='$date',status=0 WHERE tenent_id=$tenent_id ";

 //echo $sql;
  $result = $con->query($sql);

  if ($result == 1) 
  {
      $json = array(); 
      $bus = array(
     'status' => 'success',
     'msg'  => 'Notice resubmit Successfully'       
      );
  $jsonstring = array('status'=>true,'message'=>"Notice resubmit Successfully"); 
  }  
  else 
  {
      $jsonstring = array('status'=>false,'message'=>"Something Went Wrong!!!");
  }
  echo json_encode($jsonstring); 
  mysqli_close($con);
  }



function get_notice($tenent_id)
{
  $con = db_connect();
  $sql="SELECT * FROM tbl_notice where `tenent_id`=".$tenent_id; 
  $result = $con->query($sql);

 if($result->num_rows > 0) 
 {
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
        $bus = array(
                'move_out_reason'    => $row['move_out_reason'],
                'rating'             => $row['rating'],
                'feedback'           => $row['feedback'],
                'tenent_id'          => $row['tenent_id'],
                'move_out_date'      => $row['move_out_date'],
                'remarks'            => $row['remarks'],
                'approved_by'        => $row['approved_by']);
        array_push($json, $bus);
    }
    $jsonstring = array('status'=>true,'message'=>"Successfull",'data'=>$json);      
  }else{
    $jsonstring = array('status'=>false,'message'=>"Records no found."); 
  }
  echo json_encode($jsonstring); 
  mysqli_close($con);

}
// SELECT `tbl_tanents`.*, `tbl_rooms`.`fld_custom_room_name`, `tbl_rooms`.`fld_room_name`, `tbl_building`.`fld_building` from tbl_tanents LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room`=`tbl_rooms`.`fld_id`
//  LEFT JOIN `tbl_building` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id`

function get_profile($tenent_id)
{
  
  $data = array();
  $con = db_connect();
  $sql = "SELECT `tbl_tanents`.*,`tbl_rooms`.`fld_room_name`,`tbl_rooms`.`fld_custom_room_name`, `tbl_building`.`fld_building` from `tbl_tanents`      LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_room` = `tbl_rooms`.`fld_id` 
          LEFT JOIN `tbl_building` ON `tbl_rooms`.`fld_building_id`=`tbl_building`.`fld_id`
          WHERE  `tbl_tanents`.`fld_id`='$tenent_id'";
      
  $result = $con->query($sql);
  
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 

   if(!empty($row))
   {

       $sql = "SELECT `tbl_rent_status`.`fld_paid_date`, `tbl_rent_status`.`fld_rent_paid` from `tbl_rent_status` WHERE  `fld_tanent_id`='$tenent_id' ORDER BY `tbl_rent_status`.`fld_id` DESC";
    
       $result = $con->query($sql);
       $last_payment_date = mysqli_fetch_array($result,MYSQLI_ASSOC);

       $payment_last_date = $last_payment_date['fld_paid_date'];
       $fld_rent_paid_last = $last_payment_date['fld_rent_paid'];
       $current_date = date('Y-m-d');
       
     
      
       if(!empty($row['fld_profile_picture']))
       {
          $fld_profile_picture = $row['fld_profile_picture'];
       }else{
          $fld_profile_picture = "";
       }

  
  
   if(!empty($row))
   {

    $sql = "SELECT `tbl_tenent_history`.`fld_created_at` AS `created` FROM `tbl_tenent_history` WHERE `tbl_tenent_history`.`fld_tenent_id` =$tenent_id AND `tbl_tenent_history`.`fld_type`=0 ORDER BY `tbl_tenent_history`.`fld_id` ASC LIMIT 1";


       $result = $con->query($sql);
       $last_payment_date_from = mysqli_fetch_array($result,MYSQLI_ASSOC);

       $history_move_in_date = $last_payment_date_from['created'];
           //$history_move_in_date= date('Y-m-d');
       

              // calculate current balance
                 
               
         $total ="SELECT SUM(fld_rent_paid) as total FROM `tbl_rent_status` WHERE fld_tanent_id =$tenent_id "; 
         $result = $con->query($total);
         $total_payment_done = mysqli_fetch_array($result,MYSQLI_ASSOC);
          
          $sum = $total_payment_done['total'];

                $date1 = $row['fld_move_in_date']; 
                $date2 = date("Y/m/d");

                $ts1 = strtotime($date1);
                $ts2 = strtotime($date2);

                $year1 = date('Y', $ts1);
                $year2 = date('Y', $ts2);

                $month1 = date('m', $ts1);
                $month2 = date('m', $ts2);

                $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

                $bal = (($row['fld_rent'] * $diff)+ $row['fld_comission']+  $row['fld_deposit'])- ($sum+ $row['fld_deposit']); 
                if($bal == 0)
              {

                $new_date=date('d', strtotime($date1));
     
                $new_month=$month1+$diff;

                $reminder_date= $new_date.'-'.$new_month.'-'.$year2;
               }
               else if($bal > 0)
               {
                              $paid_till_date = $row['fld_rent']/30;

                              number_format((float)$paid_till_date, 2, '.', '');

                              $date_till_paid = ($row['fld_rent']-$bal) / $paid_till_date;

                              $date_till_paid = (int)$date_till_paid;

                              $req_date=date('d', strtotime($date1));

                              $new_month=$month1+$diff;

                              $total_days = $req_date + $date_till_paid;

                              if($total_days > 30)
                              {
                                // $reminder_date =  $reminder_date/30;
                                //  $reminder_date = (int)$reminder_date;
                                 list($quotient, $total_days) = getQuotientAndRemainder($total_days, 30);
                                 // $new_month= $new_month-$quotient;
                                
                                if($new_month > 12)
                                {
                               list($quotient, $new_month) = getQuotientAndRemainder($new_month, 12);
                                 $year2 = $year2 + $quotient;
                                }  

                              }
                                $reminder_date= $year2.'-'.$new_month.'-'.$total_days; 
                              $immediate = "immediate";
                           
                            
               }

        //-----------  

    
       $data = array(
                'fld_id' => $row['fld_id'],
                'fld_name' => $row['fld_name'],
                'fld_actual_name' => $row['fld_actual_name'],
                'rating' => $row['rating'],
                'feedback' => $row['feedback'],
                'tenent_id' => $row['tenent_id'],
                'move_out_date' => $row['move_out_date'],
                'remarks'  => $row['remarks'],
                'fld_bedspace_id'  => $row['fld_bedspace_id'],
                'fld_deposit'  => $row['fld_deposit'],
                'fld_payment_due_date'  => $row['fld_payment_due_date'],
                'fld_rent'  => $row['fld_rent'],
                'fld_minimum_stay'  => $row['fld_minimum_stay'],
                'fld_comission'  => $row['fld_comission'],
                'fld_sex'  => $row['fld_sex'],
                'fld_move_in_date'  => $row['fld_move_in_date'],
                'approved_by' => $row['approved_by'],
                'fld_rent_paid_last' => $fld_rent_paid_last,
                'Last_Payment'=>$payment_last_date,
                'fld_profile_picture'=>$fld_profile_picture, 
                'history_move_in_date'=>$history_move_in_date, 
                'fld_room_name' => $row['fld_room_name'],
                'fld_email' => $row['fld_email'],
                'fld_number' => $row['fld_number'],
                'room' => $row['fld_custom_room_name'],
                'building_name' => $row['fld_building'],
                'fld_whatsapp_no'=> $row['fld_whatsapp_no'],
                'sum'=> $sum,
                'reminder_date'=> $reminder_date,
                'immediate'=> $immediate,
                'bal'=> $bal
               );
     return array('data'=>$data);      
   }else{
     return array('data'=>'');
   }
}

 
}

function getQuotientAndRemainder($divisor, $dividend) {
    $quotient = (int)($divisor / $dividend);
    $remainder = $divisor % $dividend;
    return array( $quotient, $remainder );
}


function get_tanents_validate($no)
{

  $con = db_connect();
  $sql = "SELECT `tbl_tanents`.* WHERE  `tbl_tanents`.`fld_number`='$no'";

  $result = $con->query($sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 
   
  
   if(!empty($row))
   {

   }
   return array('data'=>$data);
}





function get_complaint($tenent_id)
{ 

  $con = db_connect();
  // $sql = "SELECT `tbl_complaints`.*, `tbl_sub_complaints`.`fld_complaint_type`,`tbl_sub_complaints`.`assigned_to`,`tbl_sub_complaints`.`assigned_on`, `tbl_tanents`.`fld_name`, `tbl_admin`.`fld_name`, `tbl_admin`.`fld_name` AS AdminName, `tbl_admin`.`fld_number` AS AdminContact, `tbl_sub_complaints`.`status` AS status from `tbl_complaints` INNER JOIN `tbl_sub_complaints` ON `tbl_complaints`.`fld_id` = `tbl_sub_complaints`.`fld_complaint_id` INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id` = `tbl_tanents`.`fld_id` INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id` = `tbl_sub_complaints`.`assigned_to` WHERE `tbl_complaints`.`fld_tenant_id`='$tenent_id' ";




$sql = "SELECT `tbl_sub_complaints`.*, `tbl_complaints`.*, `tbl_admin`.`fld_name`, `tbl_admin`.`fld_number`  from `tbl_sub_complaints`  
         INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`= `tbl_complaints`.`fld_id`
         LEFT JOIN `tbl_admin` ON `tbl_sub_complaints`.`assigned_to`= `tbl_admin`.`fld_id`
            WHERE `tbl_sub_complaints`.`is_closed` = 0 AND `tbl_complaints`.`fld_tenant_id`= $tenent_id ";

  $result = $con->query($sql);  
  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


  $data = array();
   while($row = mysqli_fetch_array ($result))     
    {

         
          
          if(!empty($row['fld_name']))
          {
            $AdminName = $row['fld_name'];
          }else{
            $AdminName = "Not Assigned";
          }

             if(!empty($row['fld_number']))
          {
            $AdminContact = $row['fld_number'];
          }else{
            $AdminContact = "Not Assigned";
          }
             if(!empty($row['assigned_on']))
          {
            $DateAssigned = $row['assigned_on'];
          }else{
            $DateAssigned = "Not Assigned";
          }


       $bus = array(
               'fld_id' => $row['fld_id'],
                'fld_complaint_id' => $row['fld_complaint_id'],
                'fld_complaint_type' => $row['fld_complaint_type'],
                'assigned_to' => $row['assigned_to'],
                'assigned_on' => $DateAssigned,
                'status' => $row['status'],
                'is_closed' => $row['is_closed'],
                'remarks' => $row['remarks'],
                'fld_is_resolved_by' => $row['fld_is_resolved_by'],
                'Description' => $row['fld_complaint_description'],
                'fld_update_date' => $row['fld_update_date'],
                'fld_attachment_one'    => $row['fld_attachment_one'],
                'fld_attachment_two'    => $row['fld_attachment_two'],
                'fld_attachment_three'  => $row['fld_attachment_three'],
                'AdminName' => $AdminName,
                'AdminContact' => $AdminContact,
                'assigned_by'=> $row['assigned_by']
               ); 
      array_push($data, $bus);      
   }
    return array('data'=>$data);
}


function get_client_complaint($tenent_id)
{ 
$con = db_connect();
$sql = "SELECT `tbl_sub_complaints`.*,`tbl_sub_complaints`.`fld_id` as sub_com_id, `tbl_complaints`.*, `tbl_admin`.`fld_name` AS Assign_name, `tbl_admin`.`fld_number` As `staff_num` from `tbl_sub_complaints`  
         INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`= `tbl_complaints`.`fld_id`
         LEFT JOIN `tbl_admin` ON `tbl_sub_complaints`.`assigned_to` = `tbl_admin`.`fld_id`
            WHERE `tbl_complaints`.`fld_tenant_id`= $tenent_id AND `tbl_sub_complaints`.`is_closed`=0";
 // echo $sql;
  $result = $con->query($sql);  
  $data = array();
  $row = mysqli_fetch_array ($result);

 /* echo "<pre/>";
  print_r($row);
  die;*/
   while($row = mysqli_fetch_array ($result))     
    {        
       $bus = array(
                'fld_id'                => $row['sub_com_id'],
                'fld_complaint_id'      => $row['fld_complaint_id'],
                'fld_complaint_type'    => $row['fld_complaint_type'],
                'assigned_to'           => $row['assigned_to'],
                'Assign_name'           => $row['Assign_name'],
                'staff_num'           => $row['staff_num'],
                'status'                => $row['status'],
                'is_closed'             => $row['is_closed'],
                'remarks'               => $row['remarks'],
                'fld_is_resolved_by'    => $row['fld_is_resolved_by'],
                'Description'           => $row['Description'],
                'fld_update_date'       => $row['fld_update_date'],
                'fld_attachment_one'    => $row['fld_attachment_one'],
                'fld_attachment_two'    => $row['fld_attachment_two'],
                'fld_attachment_three'  => $row['fld_attachment_three'],
                'assigned_by'           => $row['assigned_by']
               ); 
      array_push($data, $bus);      
   }

 /*  echo "<pre/>";
   print_r($data);
   die;*/
    return array('data'=>$data);
}



function notice_status($tenent_id)
{ 
  $con = db_connect();
  //$sql = "SELECT * from `tbl_notice` WHERE  `tenent_id`='$tenent_id' ORDER BY `id` DESC LIMIT 1";
  $sql = "SELECT * from `tbl_notice` WHERE `tenent_id`='$tenent_id' ORDER BY `id` DESC LIMIT 1";
  $result = $con->query($sql);  
  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $data = array();
   while($row = mysqli_fetch_array ($result))     
    {
       $bus = array(
               'move_out_reason' => $row['move_out_reason'],
                'status' => $row['status'],
                'remarks' => $row['remarks'],
                'move_out_date' => $row['move_out_date']
               ); 
      array_push($data, $bus);      
   }
    return array('data'=>$data);
}




function payment_history($tenent_id)
{ 
  $con = db_connect();
  $sql="SELECT * FROM `tbl_rent_status` WHERE `fld_tanent_id` = '$tenent_id'";
  $result = $con->query($sql);  
  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $data = array();
   while($row = mysqli_fetch_array ($result))     
    {
       $bus = array(
               'fld_paid_date' => $row['fld_paid_date'],
                'fld_rent_paid' => $row['fld_rent_paid']
               ); 
      array_push($data, $bus);      
   }
    return array('data'=>$data);
}



?>


