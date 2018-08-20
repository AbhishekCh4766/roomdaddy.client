<?php
include "../dbbridge/top1.php";
$db = new DBManager();
									
			$flag = $db->addnotice(
				         //print_r($_REQUEST);

                        SG_Validate_Input($_REQUEST['reason'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['help_us'],INPUT_TYPE_TEXT),
						SG_Validate_Input($_REQUEST['rate'],INPUT_TYPE_TEXT)
				     );

header ("Location:../add-notice.php");
				
?>