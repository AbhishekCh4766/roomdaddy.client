<?php
include "header.php";
include_once("common/security.php");
$db=new DBManager();

  $tanent_id  = $_SESSION[ADMIN_SESSION_NAME]['tanentid'];
  $getTanent = $db->getTanentById($tanent_id); 
 // print_r($getTanent);

  // var_dump($getTanent[0]['fld_move_in_date']);
  // die;undefined
?>

  <div class="content container-fluid">



      <div class="row row-broken">
          <div class="col-md-12">
            <h3>Edit Profile</h3>
           <!--  <?php print_r($getTanent); ?> -->
              <div class="row grids form_client">
          <?php   ?>
               <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="process/edit-tanent-info.php">
        <div class="panel panel-default">
          <div class="panel-body text-center">
             <div class="image-upload">
                <label for="file-input">
                 <?php if($getTanent[0]['fld_profile_picture']!='') {?>            
                   <img src="Profile/Picture/<?=$getTanent[0]['fld_profile_picture']?>" alt="image" id="abhi" class="img-circle profile-avatar" />
                 <?php } 
                  else {

                                ?>

                                <img src="http://roomdaddy.ae/img/images.jpeg" alt="image" id="abhi" class="img-circle profile-avatar"  />
                         
                          <?php  } ?>

                             </label>

                <input id="file-input" type="file" name="pic_occupant" onchange="myfunction(this)" style="display: none;" />
                 </div>
          </div>
        </div>
      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">User info</h4>
        </div>
        <div class="panel-body">
         
          <div class="form-group">
            <label class="col-sm-3 control-label"> Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="name" value="<?php echo $getTanent[0]['fld_name']; ?>" required>
              <input type="hidden" name="tanentid" value="<?php echo $getTanent[0]['fld_id']; ?>" id="tanentid" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Official Name</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="name" value="<?php echo $getTanent[0]['fld_actual_name']; ?>"  readonly>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Gender</label>
            <div class="col-sm-7">
              <select class="form-control" name="gender">
                <option  >Select Gender</option> 
                <option <?php if($getTanent[0]['fld_sex'] == 'm' ){ echo 'selected'; } ?> value="m">Male</option>
                <option <?php if($getTanent[0]['fld_sex'] == 'f' ){ echo 'selected'; } ?> value="f">Female</option>
               
                 
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">Contact info</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
            <label class="col-sm-3 control-label">Mobile number</label>
            <div class="col-sm-7">
              <input type="tel" class="form-control" name="number" value="<?php echo $getTanent[0]['fld_number']; ?>" required/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">WhatsApp number</label>
            <div class="col-sm-7">
              <input type="tel" class="form-control" name="whatsapp_number" value="<?php echo $getTanent[0]['fld_whatsapp_no']; ?>" required/>
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-3 control-label">E-mail address</label>
            <div class="col-sm-7">
              <input type="email" class="form-control" name="email" type="email" value="<?php echo $getTanent[0]['fld_email']; ?>" required>
            </div>
          </div>
         
            <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

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
     

    <script>
      function myfunction(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#abhi')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
    <style>
      #abhi{
        width: 200px !important;
        height: 200px !important;
      }
    </style>
 </body>

</html>

