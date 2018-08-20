<?php
include "heading.php";

  $tanent_id  = $_SESSION[ADMIN_SESSION_NAME]['tanentid'];
?>


  <div class="content container-fluid">



      <div class="row row-broken">
          <div class="col-md-12">
            <h3>Change Password</h3>
             <?php// print_r($getTanent); ?> 
              <div class="row grids form_client">
          <?php   ?>
               <form class="form-horizontal" id="yourFormId" method="post" enctype="multipart/form-data" action="process/change-password-process.php">

          </div>
        </div>
    

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Change Password</h4>
        </div>
        <div class="panel-body">
             <input type="hidden" name="id" value="<?php echo $tanent_id; ?>">
            <div class="form-group">
            <label class="col-sm-3 control-label">Old Password :</label>
            <div class="col-sm-7">
              <input type="Password" class="form-control" name="old_pass" placeholder="Enter your current Password" required/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">New Password :</label>
            <div class="col-sm-7">
              <input type="Password" class="form-control" name="password" id="password" type="password" placeholder="Enter New Password" required/>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-3 control-label">Confirm Password :</label> 
            <div class="col-sm-7">
              <input type="Password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" onkeyup='check();' required>
            </div>
              <span id='message'></span>
              
          </div>

         

         
            <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <button type="submit" id="enter" class="btn btn-primary submitBtn" disabled="true">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

              </div>
          </div>
      </div>

      <script>
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';

    $("#enter").prop('disabled',false)
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';

  }
}
</script>
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

</html>

