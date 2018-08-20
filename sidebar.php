
<div id="wrap-menu" class="wrap-menu">
  <span id="menu-btn-close" class="menu-btn-close">
          <svg><use xlink:href="#icon-close"></use></svg>
        </span>
  <h1 class="menu-title">Navigation</h1>
  <ul id="menu" class="menu">
    <li id="menu-btn-back" class="back">
      <span>Back</span>
    </li>
    <li>
      <!--  <i class="fa fa-bars more"></i>-->
       <i class="fa fa-globe"></i>
     <a href="index.php"> <span>Dashboards</span></a>
	  <!--
      <ul class="menu">
        <li><i class="fa fa-hashtag"></i><a href="index.html">Dashboard v1</a></li>
        <li><i class="fa fa-cube"></i><a href="dashboard2.html">Dashboard v2</a></li>
      </ul>-->
    </li>

    <li>
	<i class="fa fa-bars more"></i>
     <i class="fa fa-book"></i>
      <span>Complaint</span>
	 <ul class="menu">
        <li><i class="fa fa-book"></i><a href="register-complaint.php">Register Complaint</a></li>
        <li><i class="fa fa-book"></i><a href="complaint-open.php">Complaint Chat</a></li>
        <li><i class="fa fa-book"></i><a href="complaint-status.php">Complaint Status</a></li>
      </ul>
    </li>

    <li>
     <i class="fa fa-dollar"></i>
      <a href="payment-details.php">Payments</a>
    </li>
   
     <?php  $getNotices=$db->GetNotice(); if($getNotices[0] == null) { ?>
    <li>
     <i class="fa fa-edit"></i>
     <a href="add-notice.php">Add Notice</a>
    </li>

  <?php } else {  ?>

       <li>
     <i class="fa fa-edit"></i>
     <a href="notice-status.php">Notice Status</a>
    </li>

  <?php } ?>
	<!--
    <li>
      <i class="fa fa-list-alt"></i>
      <a href="todo.html">Move In Request</a>
    </li>
	-->
    <li>
      <i class="fa fa-user"></i>
      <a href="edit-profile.php">Edit profile</a>
    </li>
     <li>
      <i class="fa fa-user"></i>
       <a href="change-password.php">Change Password</a>
    </li>

  </ul>
</div>