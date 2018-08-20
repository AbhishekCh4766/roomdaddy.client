<?php
header('Access-Control-Allow-Origin: *'); // add any additional headers you need to support here header('Access-Control-Allow-Headers: Origin, Content-Type'); header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS')

  //$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdaddy");
  $con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
print_r($_REQUEST);
if($_REQUEST['feedback'] != '' && $_REQUEST['date']!='' && $_REQUEST['tenent_id'] != '')
{

$sql = "INSERT INTO tbl_feedback (feedback, rating,tenent_id)
        VALUES ( '".$_REQUEST['feedback']."','".$_REQUEST['rating']."','".$_REQUEST['tenent_id']."')";

//echo $phone_enc;
$result = $con->query($sql);

//die($result);
if ($result == 1) 
{
    // output data of each row
    $json = array();
    
   
    $bus = array(
   'status' => 'success',
   'msg'  => 'Notice Added Successfully'       
    );
    array_push($json, $bus);
    

    $jsonstring = json_encode($json);
    echo $jsonstring;

    //echo json_encode("[Status:True, Msg:Successfull]");
    
}
 


  else {
    // echo json_encode("{'status':'false', 'Msg':'Invalid Credentials! Please check your Phone Number or password!!!'}");
         $json = array();
    $result = mysqli_query ($con, $sql);
    $i=1;
    while($i<=1)     
    {
    $bus = array( 
        'status' => 'fail',
        'msg' => 'Add Notice Failed'
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

        }

}
else
{
    $json = array();
    $result = mysqli_query ($con, $sql);
    $i=1;
    while($i<=1)     
    {
    $bus = array( 
        'status' => 'fail',
        'msg' => 'Please Enter valid Data!!! reason & date & tenent_id to add notice '
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}
mysqli_close($con);

?>