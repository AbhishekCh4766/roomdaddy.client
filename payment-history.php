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
			<div class="col-inside-lg decor-primary b-profile">
						
                        <img src="Profile/Picture/<?=$GetTanentInfo[0]['fld_profile_picture']?>" alt="image" class="b-profile-avatar" />
                         <div class="b-profile-name">
							<?php
								$GetTanentInfo=$db->getTanentById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
								echo $GetTanentInfo[0]['fld_name'];
							?>
                        </div>
                        <div class="b-profile-profession">
                            <?php
							$getBedspace=$db->GetBedspaceByTanent($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
							$getRoomsById=$db->GetRoomsById($getBedspace[0]['fld_room']);
							$getBuildingById=$db->GetBuildingById($getRoomsById[0]['fld_building_id']);
							echo $getBuildingById[0]['fld_building']." ".$getBuildingById[0]['fld_apt_no'];
							
							?>
                        </div>
			
			</div>
			</div>

			<table class="table">
				<tr>
					<th><b>Date</b></th>
					<th><b>Amount</b></th>
					<th><b>Receipt</b></th>
				</tr>
				<!--
				<tr>
					<td>01 Jan 2018</td>
					<td>AED 5000</td>
					<td>pdf</td>
				</tr>-->
				<?php
				$getPaymentHistory=$db->GetPaymentHistroy($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
				foreach($getPaymentHistory as $history)
				{
					if($getPaymentHistory[0]!="")
					{
					?>
					<tr>
						<td><?=$history['fld_paid_date']?></td>
						<td>AED <?=$history['fld_rent_paid']?></td>
						<td>pdf</td>
					</tr>
					<?php
					}
					else
					{
						?>
						<tr>
							<td colspan="3">No Transaction Found </td>
						</tr>
						<?php
					}
				}
				?>
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

