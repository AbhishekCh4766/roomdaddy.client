<?php
  include "dbbridge/top.php";
  include_once("common/security.php");
  $db=new DBManager();
?>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/input.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:17:07 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/vendors/sweetalert.css">
  <link rel="stylesheet" href="css/vendors/loading.css">
    <link rel="stylesheet" href="css/vendors/style.css">
    <link rel="stylesheet" href="css/vendors/input.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/modernizr.js"></script>
  <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

</head>
<body>
    <div id="wrap-content" class="wrap-content">

<div class="aside">
  <a href="index.php" class="btn-logo"></a>
  
  <span class="toggle-fixed fa fa-thumb-tack" data-toggle="tooltip" data-placement="top" title="Fixed top"></span>
</div>
<div class="header">

  <div class="unit backet user">
    <span class="user-btn" id="user-btn">
    <i class="fa fa-user"></i>
  </span>
    <div class="user-content" id="user-content">
    <?php
    $GetTanentInfo=$db->getTanentById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
    
    $getSubTanent=$db->GetSubtanentsByTanentId($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
    ?>

         <?php if($getSubTanent[0]['fld_profile_picture']!='') {?>

                       <img src="Profile/Picture/<?=$GetTanentInfo[0]['fld_profile_picture']?>" alt="image" class="b-profile-avatar" />
                    <?php }  
                            else {

                                ?>

                                <img src="img/default-profile.png" alt="image" class="b-profile-avatar" />
                         
                          <?php  } ?>
                          
        
           <p style="text-align: center;">Hello </p> 
        <div class="b-profile-name">
          <?=$GetTanentInfo[0]['fld_actual_name'];?>
      
        </div>
        <div class="b-profile-profession">

      <?php
      $GetTanentsInfo=$db->getTanentsById($_SESSION[ADMIN_SESSION_NAME]['tanentid']);
      ?>
        </div>
    <!--
        <ul class="b-profile-folders">
          <li><a href="#">Messages <span class="badge badge-success pull-right">25</span></a></li>
          <li><a href="#">Photos <span class="badge badge-success pull-right">2</span></a></li>
          <li><a href="#">Posts <span class="badge badge-primary badge-round pull-right">6</span></a></li>
        </ul>-->
        <a href="logout.php" class="view-profile btn btn-danger">Log Out</a>

    </div>
  </div>
</div>
