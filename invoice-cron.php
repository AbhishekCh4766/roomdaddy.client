<?php 

include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();

$GetTanentInfo=$db->getAllTanent();

// echo "<pre/>";
// print_r($GetTanentInfo);


			

			//$msg = wordwrap($msg,70);
// send mail fun


//$to = "abhishek.allalgos@gmail.com";

			foreach ($GetTanentInfo as  $GetTanent) {
                                $date1 = $GetTanent['fld_move_in_date']; 
								$date2 = date("Y/m/d");

								$ts1 = strtotime($date1);
								$ts2 = strtotime($date2);

								$year1 = date('Y', $ts1);
								$year2 = date('Y', $ts2);

								$month1 = date('m', $ts1);
								$month2 = date('m', $ts2);

								//echo "<pre/>";
                                // echo $date1.'/'; 
                                // echo $date2.'/';
							 $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                           
								
        //echo   $date1->modify('+3 month');
        //echo $date = date($date1, mktime(date($date1),  date('d'),date('m')+$diff,date('Y')));
       // echo "--";
        
         $new_date=date('d', strtotime($date1));
     
          $new_month=$month1+$diff;
        
         $headers = "From: Roomdaddy \r\n";
         $headers = "MIME-Version: 1.0\r\n";
		 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

         $reminder_date= 'Due Date:-'.$new_date.'/'.$new_month.'/'.$year2;
         
		 $msg = 'Hi '.$GetTanent['fld_actual_name']."\r\n";	
		 $msg .= 'Please Pay Your Monthly Rent. Amount: AED'.$GetTanent['fld_rent'].'. before'.$reminder_date.'.'."\r\n";
		//echo $sub = 'Please pay it before your due date';
		 $to = $GetTanent['fld_email'];
		 $subject = "Roomdaddy test Monthly Rent Reminder";
		 $msg .= 'Thanks And Regards from Roomdaddy';
			//$message = "Monthly Rent from Roomdaddy";

			// if(mail($to, $subject, $msg, $headers))
			// {
			// 	echo "<br/>";
			// 	echo "thanks for sending mail dflkkh";
			// }
			// else 
			// { 
			// 	echo "<br/>";
			// 	echo "Some Error Occured!!! Please check";
			// }


		 echo $reminder_date.'--'.$new_date.'--'.$new_month;

			}


?>