<?php
include "header.php";
include_once("dbbridge/top.php");
include_once("common/security.php");
$db=new DBManager();
  
?>

        <div class="content container-fluid">
         <div class="row row-broken">
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li>Ui Kits</li>
                <li class="active">Inputs</li>
              </ol>
            </div>
          </div>


            <div class="row decor-primary decor-primary-main-bx">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <h4>Notice Listing</h4>
                        <?php 
                        $getNotices=$db->GetNotice();
                        
                        if($getNotices[0]!="")
                                {
                                    ?>
                        <table id="datdatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Status</th>
                            
                                    <th>Requested Move Out Date</th>
                                    <th>Remarks</th>
                               
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <?php
                                
                                
                                   
                                    foreach($getNotices as $getNotice)
                                    {  
                                           
                                        ?>
                                        <tr>
                                            <td>
                                                 <?php if($getNotice['status'] =='1' )
                                                       { echo "Approved";
                                                         }
                                                         else if($getNotice['status'] =='0' )
                                                        {
                                                            echo "Pending Approval";
                                                        }
                                                        else{
                                                            echo "Unapproved";
                                                        }
                                                  ?>
                                            </td>
                                           
                                     
                                            
                                            <td>
                                                <?php echo $getNotice['move_out_date']; ?>
                                            </td>
                                            <td> 
                                                      
                                               <?php if(!empty($getNotice['remarks'])){ echo $getNotice['remarks']; } else{echo "Pending Approval"; } ?>
                                            </td>
                                         
                                         <td><?php  if($getNotice['status']==1){$id=$getNotice['id']; ?> <a  href="givefeedback.php?id=<?php echo base64_encode($id); ?>">Give Feedback</a>  <?php }  
                                          else if($getNotice['status']==2){ ?>   <a href="resubmit-notice.php">Resubmit Notice</a>  <?php   }
                                               else { echo "Pending Approval"; }
                                          ?></td>
                                        </tr>
                                        <?php
                                    }
                                }   
                                else {
                                    echo "No Pending Notices Found";
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

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/input.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:17:07 GMT -->
</html>

