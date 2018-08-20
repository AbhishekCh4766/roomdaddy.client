<?php
$db = new DBManager();
$subcomplaint=$_POST['tid'];
$getsubcomplaintbyId=$db->GetSubComplaintById($subcomplaint);
//echo $subcomplaint;
$getComplaintById=$db->GetComplaintbyId($getsubcomplaintbyId[0]['fld_complaint_id']);
?>

                    <div class="col-inside-lg decor-default activities" id="activities" style="background-color:#a6a7ab">
                        <h4 style="font-family: initial;">
						<?= $getComplaintById[0]['fld_complaint_description']?>
						</h4>
						<br>
						<h5 style="font-family: initial;"><?=$getsubcomplaintbyId[0]['fld_complaint_type']?></h5>
						<?php
								$GetChat=$db->getChatByComplaint($subcomplaint);
								if($GetChat[0]!="")
								{
								foreach($GetChat as $chat)
								{
									?>
						<div class="unit" style="background-color:
						
						<?php
						if($chat['fld_sender']=="Tenant")
						{
							echo "#97b9de";
						}
						if($chat['fld_sender']=="Admin")
						{
							echo "#dadada";
						}
						?>
						">
							<?php
								if($chat['fld_sender']=="Admin")
								{
									$getAdminName=$db->getAdminNamebyId($chat['fld_sender_id']);
										?>
								<a class="avatar admin-data" href="#"><img src="roomdaddy/admin/img/profile/<?=$getAdminName[0]['fld_profile_pic']?>" alt="profile"/></a>
									
							<?php
									
								}
								if($chat['fld_sender']=="Tenant")
								{
									$getTenantName=$db->getTanentById($chat['fld_sender_id']);
									//print_r($getTenantName);
									?>

								<a class="avatar" href="#"><img src="Profile/Picture/<?=$getTenantName[0]['fld_profile_picture']?>" alt="profile"/></a>
									
							<?php	}

								?>

							
							<div class="field title">
								<b>
								<?php
								if($chat['fld_sender']=="Admin")
								{
									$getAdminName=$db->getAdminNamebyId($chat['fld_sender_id']);
									//print_r($getAdminName);
									foreach($getAdminName as $admin)
									{
										echo $admin['fld_name']; echo "	"; 
										?>  <span>
											<?php
											$currentDateTime = $chat['fld_update_date'];
											$currentDateTime = $chat['fld_update_date'];
										 $newDate = date('d-M', strtotime($currentDateTime));
										 $newTime = date('h:i A', strtotime($currentDateTime));

										echo $newDate;
										echo ",";
										echo $newTime; 
										 
									

										

											 ?>
										</span>
										<?php
									}
								}
								if($chat['fld_sender']=="Tenant")
								{
									$getTenantName=$db->getTanentById($chat['fld_sender_id']);
									//print_r($getTenantName);
									foreach($getTenantName as $tenant)
									{
										echo $tenant['fld_name']; 
											?>  <span>
											<?php
										$currentDateTime = $chat['fld_update_date'];
											$currentDateTime = $chat['fld_update_date'];
										 $newDate = date('d-M', strtotime($currentDateTime));
										 $newTime = date('h:i A', strtotime($currentDateTime));

										echo $newDate;
										echo ","; 
										echo $newTime; 
										

										?>
										</span>
										<?php
									}
								}

								?>
								</b>
							</div>
							<div class="field title">

								<?=$chat['fld_message']?>
							
							</div>
							<div class="field date">
								<!--<span class="f-l">Today 6:15 pm - 22.03 2015</span>-->
								
								<!--<span class="f-r color-success">5 min ago</span>-->
							</div>
						</div>
								<?php

								}
								}
								?>
							
							<input type="hidden" value="<?=$subcomplaint?>" name="subcomplaint" id="subcomplaint"/>
							<input type="hidden" value="<?=$_SESSION[ADMIN_SESSION_NAME]['tanentid']?>" name="senderid" id="senderid"/>
							<input type="hidden" value="Tenant" name="sender" id="sender"/>
							<input type="text" class="input__field input__field--minoru" name="message" id="message" placeholder="Type to comment..." style="width:80%;" required/>
							<input type="button" class="btn btn-success hovered submit_button_chat" id="addthread" value="Send" style="min-width:72px;font-size: 17px;"  onclick="addcomment()"/>
                    </div>
               
<?php
//$getThreads=$db->getSubComplaintsByComplaint($subcomplaint);

?>

                    