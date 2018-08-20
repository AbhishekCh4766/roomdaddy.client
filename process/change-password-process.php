<?php
include "../dbbridge/top1.php";
$db = new DBManager();
$tanent_id  = $_SESSION[ADMIN_SESSION_NAME]['tanentid'];


$tenentDetails = $db->GetTanentsPassbyId($tanent_id);

$old_db_pass= $tenentDetails[0]['fld_password'];

$old_pass =$_REQUEST['old_pass'];
$password =$_REQUEST['password']; 
$confirm_password =$_REQUEST['confirm_password']; 


     if(ifish_validatePassword($old_pass,$old_db_pass))
     {
      if($old_pass==$password)
      {
      	echo "<div>Oops! Looks Like New Password And Old Password is same!!! Please enter a Different Password!!! </div>";
      	echo "<p> Sorry! Your Password Could't be changed </p>";
      	
      }
        else{
           $pass  =	ifish_encryptPassword($password);

                $flag = $db->changePassword(
  	                       	    SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT),
								SG_Validate_Input($pass,INPUT_TYPE_TEXT)
                             );

                echo "<div> Password Changed Successfully <div>";
             }
         
      }else{  echo "<div> Current Password is wrong! Please Enter Valid Password! <div>"; exit;}
        ?>
                <script>
					window.location.href="/index.php";
				</script>

