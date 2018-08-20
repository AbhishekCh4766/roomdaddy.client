<!DOCTYPE html>
<html lang="en">
<?php
  include "dbbridge/top.php";
  $db=new DBManager();


  if(isset($_GET['comp_id'])){
    $id = $_GET['comp_id'];
    $db=new DBManager();
    $db->CloseComplaint($id);

    header('Location:complaint-open.php');
}
?>



<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:10:51 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Complaint Status</title>


  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/vendors/sweetalert.css">
  <link rel="stylesheet" href="css/vendors/loading.css">
  



  <link rel="stylesheet" href="css/main.css">
  <script src="js/modernizr.js"></script>

  <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  
<script>


function addcomment()
{
  var subcomplaint=$("#subcomplaint").val();
  var senderid=$("#senderid").val();
  var sender=$("#sender").val();
  var message=$("#message").val();
  var datastring="&subcomplaint="+subcomplaint+"&senderid="+senderid+"&sender="+sender+"&message="+message;
    $.ajax({
    type: "post",
    url: "request_process.php?calling=3"+datastring,
    success: function(responseData, textStatus, jqXHR) {
      getrelevantThread(responseData);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
    }
  })
}


function getrelevantThread(tid)
{
  $.ajax({
         type: "POST",
         url: 'request_process.php?calling=2',
         data: "tid="+tid,
       
         
         beforeSend: function(){
        jQuery("#hidethis").html('<img src="img/ajaxspinner.gif" style="margin-left:400px;">');
         },
         success: function(msg)
         {
          $("#hidethis").html(msg);
          $("#show").show();
          $("#table_options").show();
         // reloadbox();

        },
        error: function(){ //so, if data is retrieved, store it in html 
          alert('error');
          //$("#some").html('Error Loading Script'); //show the html inside .content div 
            //reloadbox();
        }
       });
}
</script>
  <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.src.js"></script>
  <![endif]-->

  <style>
    .complaints_status_table {
    width: 100%;
  }
  .complaints_status_table th, .complaints_status_table td {
    border: 1px solid #ddd;
    padding: 5px;
    font-size: 14px;
  }
  .complaints_status_table {
    background: #fff;
  }
  .complaints_status_table th {
    font-weight: bold;
    background: #ddd;
    border: 1px solid #ccc;
  }
  </style>
</head>


<body>
    <div id="wrap-content" class="wrap-content">

            <div class="preloader">
  <div class="preloader-anim la-animate"></div>
  <div class="loading-anim">Loading</div>
</div>
<div class="aside">
  <a href="index.php" class="btn-logo"></a>
  <span class="menu-btn-open" id="menu-btn-open">Menu</span>
  <span class="toggle-fixed fa fa-thumb-tack" data-toggle="tooltip" data-placement="top" title="Fixed top"></span>
</div>
<div class="header">
  <div class="unit title">
    <h5 class="primary font-weight-700">Complaint Status</h5>

  </div>
  <div class="unit morphsearch" id="morphsearch">
    <form class="morphsearch-form">
      <input class="morphsearch-input" type="search" placeholder="Search..." />
      <button class="morphsearch-submit" type="submit">Search</button>
    </form>
    <div class="morphsearch-content">
      <div class="dummy-column">
        <h2>People</h2>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Sara Soueidan" />
          <h3>Sara Soueidan</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Sara Soueidan" />
          <h3>Rachel Smith</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Peter Finlan" />
          <h3>Peter Finlan</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Patrick Cox" />
          <h3>Patrick Cox</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Tim Holman" />
          <h3>Tim Holman</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img class="round" src="img/images/search/50.png" alt="Shaun Dona" />
          <h3>Shaun Dona</h3>
        </a>
      </div>
      <div class="dummy-column">
        <h2>Popular</h2>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="PagePreloadingEffect" />
          <h3>Page Preloading Effect</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="ArrowNavigationStyles" />
          <h3>Arrow Navigation Styles</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="HoverEffectsIdeasNew" />
          <h3>Ideas for Subtle Hover Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="FreebieHalcyonDays" />
          <h3>Halcyon Days Template</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="ArticleIntroEffects" />
          <h3>Inspiration for Article Intro Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-2.png" alt="DraggableDualViewSlideshow" />
          <h3>Draggable Dual-View Slideshow</h3>
        </a>
      </div>
      <div class="dummy-column">
        <h2>Recent</h2>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="TooltipStylesInspiration" />
          <h3>Tooltip Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="AnimatedHeaderBackgrounds" />
          <h3>Animated Background Headers</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="OffCanvas" />
          <h3>Off-Canvas Menu Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="TabStyles" />
          <h3>Tab Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="ResponsiveSVGs" />
          <h3>Make SVGs Responsive with CSS</h3>
        </a>
        <a class="dummy-media-object" href="#">
          <img src="img/images/search/50-3.png" alt="NotificationStyles" />
          <h3>Notification Styles Inspiration</h3>
        </a>
      </div>
    </div>
    <span class="morphsearch-close"><svg><use xlink:href="#icon-close"></use></svg></span>
  </div>
  <div class="unit email">
    <span class="btn-email" id="email-btn"><span class="notification-count">6</span></span>
    <div class="mail-content" id="email-content">
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-2.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-3.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <img src="img/images/mail-widget/60-4.png" alt="mail" />
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="email-list.html" class="show-all btn btn-danger">Show all mails</a>
    </div>
  </div>
  <div class="unit message">
    <span class="btn-message" id="message-btn"><span class="notification-count">4</span></span>
    <div class="message-content" id="message-content">
      <div class="percent">
        <div class="percent-title">Database Repair</div>
        <div class="percent-mark">70%</div>
        <div class="percent-value color-1" style="width: 70%;"></div>
      </div>
      <div class="percent">
        <div class="percent-title">Database Repair</div>
        <div class="percent-mark">10%</div>
        <div class="percent-value color-2" style="width: 10%;"></div>
      </div>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-android"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-album"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-science"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="unit">
        <span class="icon-box"></span>
        <p>It is a long esta blished fact that a reader distracted by the readable content of</p>
      </a>
      <a href="javascript:void(0);" class="clear-all btn btn-danger">Clear all</a>

      <div class="check-ok">
        <i class="fa fa-check-circle"></i>
        <br>
        <span class="text-uppercase">Empty</span>
      </div>
    </div>
  </div>
  <div class="unit backet user">
    <span class="user-btn" id="user-btn"><i class="fa fa-user"></i></span>
    <div class="user-content" id="user-content">
        <img src="img/images/profile/64.png" alt="image" class="b-profile-avatar" />
        <div class="b-profile-name">
          Alexander Van Gok
        </div>
        <div class="b-profile-profession">
          Web Designer
        </div>
        <ul class="b-profile-folders">
          <li><a href="#">Messages <span class="badge badge-success pull-right">25</span></a></li>
          <li><a href="#">Photos <span class="badge badge-success pull-right">2</span></a></li>
          <li><a href="#">Posts <span class="badge badge-primary badge-round pull-right">6</span></a></li>
        </ul>
        <a href="profile.html" class="view-profile btn btn-danger">View profile</a>

    </div>
  </div>
</div>



            <div class="content container-fluid">

            <div class="row row-broken">
              <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                  <li class="active">User profile</li>
                </ol>
              </div>
            </div>
 <?php
            $GetTanentInfo=$db->getTanentById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
            ?>
            
                  
                    
                        
            <?php
              $getSubComplaint=$db->GetSubComplaintByTenantopen($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
              if($getSubComplaint[0]!="")
              {
               
                ?>
                    <table class="complaints_status_table">
                      <thead>
                        <tr>
                          <th>Complaint ID</th>
                          <th>Date opened</th>
                          <th>Type</th>
                          <th>Assigned to</th>
                          <th>Phone of staff</th>
                          <th>Complaint Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                <?php
                foreach($getSubComplaint as $subcomplaint)
                {
                
                                    ?>
                                      


                               <tbody>
                        <tr>
                          <td>
                              
                            <?=$subcomplaint['fld_id']?> <?php echo "/";?> <?=$subcomplaint['fld_complaint_id']?> 
                                
                        </td>
                          <td><?=$subcomplaint['fld_update_date']?>  </td>
                          <td><?=$subcomplaint['fld_complaint_type']?> </td>
                          <td><?php $AdminName=$db->getAdminNamebyId($subcomplaint['assigned_to']); if($subcomplaint['assigned_to'] == 0) {echo "Not Opened";} else { echo $AdminName[0]['fld_name'];} ?></td>
                          <td><?php $AdminName=$db->getAdminNamebyId($subcomplaint['assigned_to']); if($subcomplaint['assigned_to'] == 0) {echo "Not Opened";} else { echo $AdminName[0]['fld_number'];} ?></td>
                          <td><?php if($subcomplaint['status']== 0){ echo "Pending Approval";} else { echo "Closed By Admin";}?></td>
                          <td><a href="<?php $_SERVER['PHP_SELF']; ?>?comp_id=<?php echo $subcomplaint['fld_id']; ?>" onclick="return confirm('Are You Sure You Want to Close this complaint!!!');">Close Complaint</a></td>
                        </tr>
                        </tbody>
                    
                                    <?php
                
                }
              }
              else
              {
                echo "No Complaints found !!!";
              }
            ?>
                        
                        
      
        </table>
        
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
  <!--
  <script>
  var input = document.getElementById("message");
  input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13){
      alert("Hello");
      //document.getElementById("addthread").click();
    }
  });
  </script>-->
</body>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:11:33 GMT -->
</html>

