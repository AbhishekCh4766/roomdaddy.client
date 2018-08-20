<!DOCTYPE html>
<html lang="en">
<?php
  include "dbbridge/top.php";
  $db=new DBManager();
  
?>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:10:51 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Complaint Status</title>
    <link rel="stylesheet" href="css/vendors/style.css">
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
          reloadbox();

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
</head>


<body>
  <?php
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
 <?php
            $GetTanentInfo=$db->getTanentById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
            ?>
            <div class="row row-broken">
                <div class="col-md-1 col-left b-profile-main">
                    <div class="col-inside-lg decor-primary b-profile">
                        
            <?php
              $getSubComplaint=$db->GetSubComplaintByTenant($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
              if($getSubComplaint[0]!="")
              {
                foreach($getSubComplaint as $subcomplaint)
                {
                  ?>
                  <div class="b-profile-follow" id="<?=$subcomplaint['id']?>" style="cursor:pointer;" onclick="getrelevantThread(<?=$subcomplaint['id']?>)">
                    <div class="unit">
                    <?=$subcomplaint['complaint_type']?> <?=$subcomplaint['id']?>
                    </div>
                  </div>
                  <?php
                }
              }
            ?>
                        
                        
                        
                        
                        
                    </div>
                </div>
        
        <div class="col-md-12 col-right no-cleaner-bx" id="hidethis">
                    <div class="col-inside-lg decor-default activities activities-main" id="activities">
                        <h4>  </h4>
            <br>
            <h5>   </h5>
                <div class="unit">
                  <!-- <a class="avatar" href="#"><img src="img/images/profile/40-2.png" alt="profile"/></a> -->
                  <div class="field title">
                    <b> </b>
                  </div>
                  <div class="field title">
                
                  </div>
                  <div class="field date">
                    <!--<span class="f-l">Today 6:15 pm - 22.03 2015</span>-->
                    <?php
                      
                    ?>
                    <!--<span class="f-r color-success">5 min ago</span>-->
                  </div>
                </div>
                
                <input type="text" class="input__field input__field--minoru" placeholder="Type to comment..." id="newcom"/>
                
                    </div>
          
                </div>
        
        <div class="col-md-12 col-right" id="show">
        
        
        
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

