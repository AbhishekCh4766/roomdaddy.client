<?php
   // RewriteEngine On
   // Redirect /index.php /dashboard.php
	include "header.php";
	
?>
		<div class="content container-fluid">
            <div class="row row-broken">
              <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                  <li class="active">User profile</li>
                </ol>
              </div>
            </div>

            <div class="row row-broken">
                <div class="col-md-12">
                    <div class="col-inside-lg decor-primary b-profile b-profile-room"> 
						<div>
						
						<?php
						$GetTanentInfo=$db->getTanentById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
						$getSubTanent=$db->GetSubtanentsByTanentId($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
						if($GetTanentInfo[0]['fld_is_approved']==0)
						{
							?>
							<script language="javascript">
								window.location.href="approval.php";
							</script>
							<?php
						}
						?>
                             <?php if($GetTanentInfo[0]['fld_profile_picture']!='') {?>

                        <img src="Profile/Picture/<?=$GetTanentInfo[0]['fld_profile_picture']?>" alt="image" class="b-profile-avatar" />
                    <?php }  
                            else {

                                ?>

                                <img src="img/images.jpeg" alt="image" class="b-profile-avatar" />
                         
                          <?php  } ?>
                        <div class="b-profile-name">
							<?php
								
								echo $GetTanentInfo[0]['fld_actual_name'];
							?>
                        </div>
                        <div class="b-profile-profession">
                            <?php
							$getBedspace=$db->GetBedspaceByTanent($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
							$getRoomsById=$db->GetRoomsById($getBedspace[0]['fld_room']);
							$getBuildingById=$db->GetBuildingById($getRoomsById[0]['fld_building_id']);
							echo $getBuildingById[0]['fld_building']." ".$getBuildingById[0]['fld_apt_no'];
							
                              	$getDeposit = $db->GetLastDepositByTanent($GetTanentInfo[0]['fld_id']);

                              	$TanentEntryDate = $db->getTanentEntryDate($GetTanentInfo[0]['fld_id']);

                              	     // print_r($TanentEntryDate);         
								 	 //print_r($getDeposit);
							        //  print_r($GetTanentInfo);
							
							?>
                        </div>
                        <div class="b-profile-profession">
                           <?php
						   if($getRoomsById[0]['fld_custom_room_name']=="")
							{
								echo $getRoomsById[0]['fld_room_name'];
							}
							else
							{
								echo $getRoomsById[0]['fld_custom_room_name'];
							}
						   ?>
                        </div>
						</div>
                        <div class="b-profile-follow">
                            <div class="unit">
                                <span>AED 
								<?php
									echo $GetTanentInfo[0]['fld_deposit'];
								?>
								</span>
                                <span>Agreed Deposit</span>
                            </div>
                            <div class="unit">
                                <span>AED 
								<?php
									//Deposit In Sum
									$GetDepositInSum=$db->GetDepositInSumByTanent($GetTanentInfo[0]['fld_id']);
									//Deposit Out Sum
									$GetDepositOutSum=$db->GetDepositOutSumByTanent($GetTanentInfo[0]['fld_id']);
									
									echo $GetDepositInSum[0]['deposit']-$GetDepositOutSum[0]['deposit'];
								?>
								</span>
                                <span>Deposit Balance</span>
                            </div>
                        </div>
                        <ul class="b-profile-folders">
                            <li><a href="javascript:void(0)">Move In Date <span class="badge badge-success pull-right">
							<?php
								$date= date_create($TanentEntryDate[0]['fld_created_at']);
								echo date_format($date,"d M Y");
							?>
							</span></a></li>
                            <li><a href="javascript:void(0)">Minimum Stay commitment <span class="badge badge-success pull-right">
							<?php
								echo $GetTanentInfo[0]['fld_minimum_stay']." Months";
							?>
							</span></a>
							</li>
                            <li><a href="javascript:void(0)">Agreed Rent <span class="badge badge-success pull-right">AED 
							<?php
								echo $GetTanentInfo[0]['fld_rent'];
							?>
							</span></a></li>
                            <li><a href="javascript:void(0)">Agency Fee <span class="badge badge-success pull-right">AED 
							<?php
								echo $GetTanentInfo[0]['fld_comission'];
							?>
							</span></a></li>
                            <li><a href="javascript:void(0)">Last Payment <span class="badge badge-success pull-right">
							AED 
							<?php
								$index=0;

								$getLastPayment=$db->GetLastPaymentByTanent($GetTanentInfo[0]['fld_id']);
                              
                              
								$sum =0;
								foreach ($getLastPayment as $key => $payvalue) {
									$sum += $payvalue['fld_rent_paid'];


								}

								$date1 = $GetTanentInfo[0]['fld_move_in_date']; 
								$date2 = date("Y/m/d");

								$ts1 = strtotime($date1);
								$ts2 = strtotime($date2);

								$year1 = date('Y', $ts1);
								$year2 = date('Y', $ts2);

								$month1 = date('m', $ts1);
								$month2 = date('m', $ts2);

								$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

								
								
								if($getLastPayment[0]!="")
								{
									if($getLastPayment[0]['fld_rent_paid']=="")
									{
										echo "0";
									}
									else
									{
										echo $getLastPayment[0]['fld_rent_paid'];
									}
								}
								else
								{
									echo "0";
								}
							?>
							</span></a></li>
                            <li><a href="javascript:void(0)">Current Balance<span class="badge badge-success pull-right">AED <?php $bal = (($getBedspace[0]['fld_expected_rent'] * $diff)+ $GetTanentInfo[0]['fld_comission']+  $GetTanentInfo[0]['fld_deposit'])- ($sum+ $getDeposit[0]['fld_deposit']); echo $bal; ?></span></a></li>
                            <li><a href="javascript:void(0)">Next Payment Date<span class="badge badge-success pull-right">
							<?php
							if($bal > 0)
							{

                               echo "Immediate";

                              $paid_till_date = $GetTanentInfo[0]['fld_rent']/30;

                              number_format((float)$paid_till_date, 2, '.', '');

                              $date_till_paid = ($GetTanentInfo[0]['fld_rent']-$bal) / $paid_till_date;

                              $date_till_paid = (int)$date_till_paid;

							}
							else if($bal == 0)
							{  
                               $new_date=date('d', strtotime($date1));
     
                               $new_month=$month1+$diff;

                           echo $reminder_date= $new_date.'-'.$new_month.'-'.$year2;
                           
							}
							else {
							 $new_bal = $bal/ $GetTanentInfo[0]['fld_rent'];
							 $new_bal= (int)$new_bal * (-1);
							   if($new_bal > 0)
							   {
							   	 echo $_SERVER['dataInicio'] = date('Y-m-d', mktime(0, 0, 0, date('m')+$new_bal+1, 1, date('Y')));
							   }
							   else {
							   	  echo $_SERVER['dataInicio'] = date('Y-m-d', mktime(0, 0, 0, date('m')+1, 1, date('Y')));
							   }
							}
							?>
							</span></a></li>
						   <li> <a href="javascript:void(0)"> Days till Rent Paid <span class="badge badge-success pull-right"> <?php 

						             $date_till_paid; 
                           
                                     $req_date=date('d', strtotime($date1));
     
                                     $new_month=$month1+$diff;

                                     $total_days = $req_date + $date_till_paid;

                                      if($total_days > 30)
                              {
                                // $reminder_date =  $reminder_date/30;
                                //  $reminder_date = (int)$reminder_date;
                                 list($quotient, $total_days) = getQuotientAndRemainder($total_days, 30);
                                 
                                
                                
                              }
                                $reminder_date= $total_days.'/'.$new_month.'/'.$year2; 
                                echo $reminder_date;


						   ?></span></a> </li>
                        </ul>
                        <div class="b-profile-about">
                            <h6>About</h6>
                            <p>Contact Person Saqib +971552352113<br> info@roomster.com</p>
                        </div>
                    
                        <div class="b-profile-botton">
                       <a href="edit-profile.php" class="btn btn-danger btn-block view_docments">Edit Profile</a>
                       <a href="register-complaint.php" class="btn btn-danger btn-block complaint-btn">Make a Complaint</a>
                       <a href="payment-details.php" class="btn btn-danger btn-block payment_history">Payment History</a>
                       <?php  $getNotices=$db->GetNotice(); if($getNotices[0] == null) { ?>
                       <a href="add-notice.php" class="btn btn-danger btn-block out_notice">Move Out Notice</a>

                   <?php } else{ ?> <a href="notice-status.php" class="btn btn-danger btn-block out_notice">Notice Status</a>  <?php }  ?>
					   <a href="view-documents.php" class="btn btn-danger btn-block view_docments">View Documents</a>
					   
                        </div>
                    </div>
					
                </div>


        </div>
        <div class="footer">
            © 2015 Copyright.
        </div>
    </div>


    <?php
	include "sidebar.php";
	?>

<div id="overlay" class="overlay"></div>
       <?php 
        function getQuotientAndRemainder($divisor, $dividend) {
    $quotient = (int)($divisor / $dividend);
    $remainder = $divisor % $dividend;
    return array( $quotient, $remainder );
}
       ?>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 28 28" style="display: none;" xml:space="preserve">
  <g id="icon-close">
    <line x1="2" y1="2" x2="26" y2="26" />
    <line x1="2" y1="26" x2="26" y2="2" />
  </g>
</svg>


        <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/ui.js"></script>
    <script src="js/search.js"></script>
    <script src="js/sweetalert.min.js"></script>



    <script src="js/jquery.sparkline.min.js"></script>

    <script>
        $("#activities").niceScroll();

        $("#bar").sparkline([12, 32, 9, 11, 14, 24, 19, 6, 8, 13, 22, 12, 32], {
          barColor: "#42b382",
          negBarColor: "#e4ad06",
          type: 'bar'
        });

        $("#pie").sparkline([4, 6, 4], {
          type: 'pie',
          sliceColors: ["#ffc107", "#63A8EB", "#E9585B"]
        });

        $("#line").sparkline([5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7, 5, 6, 7, 9, 9, 5, 3, 2, 2, 4, 6, 7], {
          type: 'line',
          spotColor: "#fff",
          minSpotColor: "#fff",
          maxSpotColor: "#fff",
          spotRadius: 4,
          lineWidth: 3,
          lineColor: "#fff",
          fillColor: "transparent",
          highlightSpotColor: '#E9585B',
          highlightLineColor: '#E9585B',
          defaultPixelsPerValue: 5
        });

    </script>
</body>

</html>

