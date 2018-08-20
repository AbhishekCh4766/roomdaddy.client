<?php
header('Access-Control-Allow-Origin: *'); // add any additional headers you need to support here header('Access-Control-Allow-Headers: Origin, Content-Type'); header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS')

//$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdaddy");
$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_leasing1");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 
$id = $_REQUEST['user_id'];

$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_tanent_id` = '$id'";


//echo $phone_enc;
$result = $con->query($sql);

if ($result->num_rows > 0) 
{
    // output data of each row
    $json = array();
    $result = mysqli_query ($con, $sql);
    while($row = mysqli_fetch_array ($result))     
    {
    $bus = array(
        
        'id' => $row['fld_id'],
        'fld_tanent_id' => $row['fld_tanent_id'],
        'fld_building_id' => $row['fld_building_id'],
        'fld_rent_paid' => $row['fld_rent_paid'],
        'fld_date ' => $row['fld_date '],
        'fld_income_type' => $row['fld_income_type'],
        'fld_paid_date' => $row['fld_paid_date'],
        'fld_description' => $row['fld_description'],
        'fld_collected_by' => $row['fld_collected_by'],
        'fld_landlord_id' => $row['fld_landlord_id'],
        'approved_by' => $row['approved_by'],
        'fld_bedspace_id' => $row['fld_bedspace_id'],
        'fld_update_date' => $row['fld_update_date'],
        'status' => 'success'
        
    );
    array_push($json, $bus);
    }

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
        'msg' => 'No Payment Done.!!!'
    );
    array_push($json, $bus);
    $i++;
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

        }

mysqli_close($con);

?>