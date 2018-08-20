<?php
include "../dbbridge/top1.php";
$db = new DBManager();
			// print_r($_REQUEST);	
			// die;					
			$flag = $db->editnotice(
				         

                        SG_Validate_Input($_REQUEST['reason'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['help_us'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['id'],INPUT_TYPE_TEXT)
				     );

header ("Location:../notice-status.php");
				
?>