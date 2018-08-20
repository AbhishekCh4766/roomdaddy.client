<?php 
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: Origin, Content-Type'); 
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');



function db_connect()
{
  $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdadd_roomdaddy_new");
  
  if (mysqli_connect_errno())
  {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
   die('Failed to connect to MySQL');
  }
  
  return $con;
}
 



function notice($tenent_id,$reason,$date)
{
  $con = db_connect();
  $sql = "INSERT INTO tbl_notice (move_out_reason,move_out_date,tenent_id) VALUES ( '".$reason."','".$date."','".$tenent_id."')";
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


function register_complaint($tenent_id,$complaint_type,$complaint_description,$prefer_time,$prefer_date,$attachment_one,$attachment_two,$attachment_three)
{
  $con = db_connect();
  $sql = "INSERT INTO tbl_complaints (fld_tenant_id,fld_complaint_description,fld_prefer_time,fld_prefer_date,fld_attachment_one,fld_attachment_two,fld_attachment_three) VALUES ( '".$tenent_id."','".$complaint_description."','".$prefer_time."','".$prefer_date."','".$attachment_one."','".$attachment_two."','".$attachment_three."')";
  $result = $con->query($sql);
  if($result == 1) 
  {
      $fld_complaint_id = $con->insert_id;

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


function resubmit_notice($tenent_id,$reason,$date)
{

  $con = db_connect();
  $sql = "Update tbl_notice set move_out_reason='$reason', move_out_date=$date WHERE tenent_id=$tenent_id ";

 
  $result = $con->query($sql);

  if ($result == 1) 
  {
      $json = array(); 
      $bus = array(
     'status' => 'success',
     'msg'  => 'Notice resubmit Successfully'       
      );
  array_push($json, $bus);
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


function get_profile($tenent_id)
{
  $data = array();
  $con = db_connect();
  $sql = "SELECT `tbl_tanents`.*,`tbl_rooms`.`fld_room_name`,`tbl_rooms`.`fld_custom_room_name` from `tbl_tanents` LEFT JOIN `tbl_rooms` ON `tbl_tanents`.`fld_id` = `tbl_rooms`.`fld_tanent`  WHERE  `tbl_tanents`.`fld_id`='$tenent_id'";
      
  $result = $con->query($sql);
  
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 

   if(!empty($row))
   {

       $sql = "SELECT `tbl_rent_status`.fld_paid_date from `tbl_rent_status` WHERE  `fld_tanent_id`='$tenent_id'";
    
       $result = $con->query($sql);
       $last_payment_date = mysqli_fetch_array($result,MYSQLI_ASSOC);

       $payment_last_date = $last_payment_date['fld_paid_date'];
       $current_date = Date('Y-m-d');
       
       $Next_Payment_Date ="";
       
       if(!empty($row['fld_profile_picture']))
       {
          $fld_profile_picture = "http://roomdaddy.ae/roomdaddy/Profile/Picture/".$row['fld_profile_picture'];
       }else{
          $fld_profile_picture = "";
       }
    
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
                'Next_Payment'=>$Next_Payment_Date,
                'Last_Payment'=>$payment_last_date,
                'fld_profile_picture'=>$fld_profile_picture, 
                'fld_room_name' => $row['fld_room_name'],
                'fld_custom_room_name' => $row['fld_custom_room_name'],
                'fld_whatsapp_no'=> $row['fld_whatsapp_no'],
                'profile_picture'=>$row['fld_profile_picture'],
               );
     return array('data'=>$data);      
   }else{
     return array('data'=>'');
   }


 
}





function get_complaint($tenent_id)
{ 
  $con = db_connect();
  $sql = "SELECT `tbl_complaints`.*, `tbl_sub_complaints`.`fld_complaint_type`,`tbl_sub_complaints`.`assigned_to`,`tbl_sub_complaints`.`assigned_on`, `tbl_tanents`.`fld_name`, `tbl_admin`.`fld_name`, `tbl_admin`.`fld_name` AS AdminName, `tbl_admin`.`fld_number` AS AdminContact, `tbl_sub_complaints`.`status` AS status from `tbl_complaints` INNER JOIN `tbl_sub_complaints` ON `tbl_complaints`.`fld_id` = `tbl_sub_complaints`.`fld_complaint_id` INNER JOIN `tbl_tanents` ON `tbl_complaints`.`fld_tenant_id` = `tbl_tanents`.`fld_id` INNER JOIN `tbl_admin` ON `tbl_admin`.`fld_id` = `tbl_sub_complaints`.`assigned_to` WHERE `tbl_complaints`.`fld_tenant_id`='$tenent_id' ";
  $result = $con->query($sql);  
  //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $data = array();
   while($row = mysqli_fetch_array ($result))     
    {
       $bus = array(
               'fld_complaint_type' => $row['fld_complaint_type'],
                'AdminName' => $row['AdminName'],
                'AdminContact' => $row['AdminContact'],
                'status' => $row['status'],
                'assigned_on' => $row['assigned_on'],
                'assigned_to'=> $row['assigned_to']
               ); 
      array_push($data, $bus);      
   }
    return array('data'=>$data);
}




function notice_status($tenent_id)
{ 
  $con = db_connect();
  $sql = "SELECT * from `tbl_notice` WHERE  `tenent_id`='$tenent_id'";
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


