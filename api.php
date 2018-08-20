<?php

// if(!defined("DB_SERVER"))       define("DB_SERVER", "localhost");
// if(!defined("DB_NAME"))			define("DB_NAME","roomdadd_roomdaddy");
// if(!defined("DB_USER"))			define("DB_USER", "roomdadd_room");
// if(!defined("DB_PASSWORD"))     define("DB_PASSWORD", '!P!L_Z33X#+Y');




$con=mysqli_connect("localhost","roomdadd_room","!P!L_Z33X#+Y","roomdadd_roomdaddy");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $phone = $_REQUEST['phone'];
  $password = ($_REQUEST['password']);

 $sql="SELECT * FROM tbl_tanents where `fld_number`='$phone' AND `fld_password` ='$password' ";


$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	//echo"<pre/>";
         echo json_encode($row);
    }
    echo "success";
} 
else {
       echo "0 results";
}


// 07f74121e98b5aa925f5ae9bd382eb1f:3c
// a13065d755f2b33f0dffbee51607dd3c


		//$sql="select *  from tbl_tanents WHERE `fld_number`='".$phone."' ";
		//echo $sql;exit;
// 		 $result = $con->query($sql);
//      echo " .......       ";
// print_r($result);



// 		if($result[0])
// 		{
// 			if($result[0] && ($password, $result[0]['fld_password']))
// 			{
// 				if($result[0]['fld_is_current_tanent'] == 1)
// 				{
// 					return $result[0];
// 				}
// 				else
// 				{
// 					return $result[0]['fld_is_current_tanent'] = 'blocked'; 
// 				}
// 			}	
// 			else
// 			{
// 				return array();
// 			}		
// 		}
mysqli_close($con);

?>