<?php
include "header.php";
include_once("common/security.php");
$db=new DBManager();
?>

    <div class="content container-fluid">
      

      
            <div class="row row-broken">
                <div class="col-md-12">

      <div class="row grids">
        <div class="col-lg-12">
          
            <!-- Stack the columns on mobile by making one full-width and the other half-width -->
			
							<?php
								$GetTanentInfo=$db->getTanentDocumentsById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
								
							?>
                
			
			<table class="table">
				<tr class="tr_bg">
					<th><b>NAME</b></th>
					<th>PROFILEPIC</th>
					<th>PASSPORT</th>
					<th>VISA</th>
					<th>EMIRATES FRONT</th>
					<th>EMIRATES BACK</th>
				</tr>
				
				   <tr>
				   	<td><?php echo $GetTanentInfo[0]['fld_name']; ?></td>
				   
				  

				                      <td>
                                              <?php

                                          $target_path ='http://roomdaddy.ae/Profile/Picture/';
                                            if($GetTanentInfo[0]['fld_profile_picture'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetTanentInfo[0]['fld_profile_picture'];?>" target="_blank"><img src="<?=$target_path.$GetTanentInfo[0]['fld_profile_picture'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                    <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/Passport/Picture/';
                                            if($GetTanentInfo[0]['fld_passport_pic'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetTanentInfo[0]['fld_passport_pic'];?>" target="_blank"><img src="<?=$target_path.$GetTanentInfo[0]['fld_passport_pic'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                      <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/visa/Picture/';
                                            if($GetTanentInfo[0]['fld_visa_page'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetTanentInfo[0]['fld_visa_page'];?>" target="_blank"><img src="<?=$target_path.$GetTanentInfo[0]['fld_visa_page'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>

                                       <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/emiratefront/Picture/';
                                            if($GetTanentInfo[0]['fld_emirates_front'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetTanentInfo[0]['fld_emirates_front'];?>" target="_blank"><img src="<?=$target_path.$GetTanentInfo[0]['fld_emirates_front'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                        
                                    </td>
                                     <td>
                                         <?php

                                          $target_path ='http://roomdaddy.ae/emirateback/Picture/';
                                            if($GetTanentInfo[0]['fld_emirates_back'] != ''){ ?>

                                                 <a href="<?php echo $target_path.$GetTanentInfo[0]['fld_emirates_back'];?>" target="_blank"><img src="<?=$target_path.$GetTanentInfo[0]['fld_emirates_back'];?>" width="60" height="40"></a>
                                               
                                           <?php }else{
                                                echo '-';
                                            }
                                        ?> 
                                    </td>
				   </tr>
			</table>
           
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

 </body>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:17:05 GMT -->
</html>

