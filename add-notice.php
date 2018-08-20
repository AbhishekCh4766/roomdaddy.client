<?php
include "header.php";
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
	

                            $getNotices=$db->GetNotice();
                             ?> 

                                   <div  class="Notice_already_added" style="color: red; text-align: center;padding-top: 0px; ">
                             <?php
                            if($getNotices[0]!="")
                            {  
                             ?>
                                
                                <div class="Notice_already_added_inner" style="color: red; text-align: center;padding-top: 200px; ">
                             <?php
                                echo "YOU HAVE ADDED/ALREADY ADDED A NOTICE!!! PLEASE CHECK IT'S STATUS FROM SIDEBAR OR  ";
                             ?>
                                </div >
                           
                            <p> <a href="notice-status.php">Click Here</a> To Check Notice Status </p>
                              </div>
                           <?php
                           die;
                            }
?>

        <div class="content container-fluid">
         <div class="row row-broken">
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li>Ui Kits</li>
                <li class="active">Inputs</li>
              </ol>
            </div>
          </div>


            <div class="row decor-primary">
                <form  id="addnotice" method="POST"  action="process/add_notice_process.php">
                <div class="col-sm-12">
                    <div class="input-title">Notice Request</div>
                </div>
				
				
                <div class="col-sm-12">
                    <span class="input input--minoru">
                        <input class="input__field input__field--minoru" name="reason" type="text" id="input-13" required="" />
                        <label class="input__label input__label--minoru" for="input-13">
                            <span class="input__label-content input__label-content--minoru">Reason to Move Out</span>
                        </label>
                    </span>
                </div>
                   <div class="col-sm-12">
                    <span class="input input--minoru">
                        <input class="input__field input__field--minoru" name="move_out_date" type="date" id="" required="" />
                        <label class="input__label input__label--minoru" for="input-13">
                            <span class="input__label-content input__label-content--minoru"> Move Out Date</span>
                        </label>
                    </span>
                </div>
               
                <div class="col-sm-12">
                    <span class="input input--minoru">
                       <input type="hidden" value="<?=$_SESSION[ADMIN_SESSION_NAME]['tanentid']?>" name="tenent_id">
                     <input type="submit" class="btn btn-success btn-round" name="Submit">
                    </span>
                </div>
				</form>
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

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/input.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:17:07 GMT -->
</html>

