<!DOCTYPE html>
<html lang="en" class="no-js">
  
<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:38:49 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/register.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
    <link rel="stylesheet" type="text/css" href="css/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="css/cs-skin-boxes.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
  
  <!----->
  <script src='dropdown/jquery-3.2.1.min.js' type='text/javascript'></script>
    <script src='dropdown/select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='dropdown/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  <!----->
  <style>
  .select2-container .select2-selection--single
  {
    height:45px;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered
  {
    margin:8px;
  }
  </style>
    <script src="js/modernizr.custom.js">
  
  </script>
  <?php
  
    include "dbbridge/top.php";
    $db= new DBManager();
    $tanent_id          = $_SESSION[ADMIN_SESSION_NAME]['tanentid'];
    $tanent_name        = "";
    $tanent_email       = "";
    $tanent_mobile        = "";
    $tanent_whatsapp      = "";
    $national         = "";
    $gender           = "";
    $getTanent          = $db->getTanentById($tanent_id);
    // foreach($getTanent as $tanent)
    // {
      // $tanent_name       = $tanent['fld_name'];
      // $tanent_email        = $tanent['fld_email'];
      // $tanent_mobile       = $tanent['fld_number'];
      // $tanent_whatsapp     = $tanent['fld_whatsapp_number'];
      // $national        = $tanent['fld_nationality'];
      // $gender            = $tanent['fld_sex'];
    // }
  include_once("common/security.php");
  ?>
  </head>
  <body class="decor-primary">
    <div class="container">

      <div class="fs-form-wrap" id="fs-form-wrap">
        <div class="fs-title">
          <div class="codrops-top">
            <a href="index.php"><i class="fa fa-arrow-left"></i>Back</a>
          </div>
        </div>
        <form id="tanent_frm" class="fs-form fs-form-full" autocomplete="off"  method="post" enctype="multipart/form-data" action="process/update-tanent-info.php">
          <ol class="fs-fields">
      <?php
      for($i=1;$i<=$getTanent[0]['fld_num_of_occupants'];$i++)
      { 
      ?>
            <li>
              <label class="fs-field-label fs-anim-upper" for="user-name">Name of Occupant <?=$i?> ?</label>
              <input class="fs-anim-lower" id="user-name<?=$i?>" name="user-name<?=$i?>" type="text" value="<?=$tanent_name?>" placeholder="Dean Moriarty" required/>
        <input type="hidden" name="tanentid" value="<?=$tanent_id?>" id="tanentid" />
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="email" data-info="We won't send you spam, we promise...">Email of Occupant <?=$i?> ?</label>
              <input class="fs-anim-lower" id="email<?=$i?>" name="email<?=$i?>" type="email" value="<?=$tanent_email?>" placeholder="dean@road.us" required/>
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="number" data-info="We won't send you spam, we promise...">Mobile Number of Occupant <?=$i?> ?</label>
              <input class="fs-anim-lower" id="number<?=$i?>" name="number<?=$i?>" type="text" placeholder="+971500000000" value="<?=$tanent_mobile?>" required/>
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="whatsapp-number" data-info="We won't send you spam, we promise...">Whatsapp Number of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="whatsapp-number<?=$i?>" name="whatsapp-number<?=$i?>" type="text" placeholder="+971500000000" value="<?=$tanent_whatsapp?>" required/>
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="nationality" data-info="We won't send you spam, we promise...">Nationality of Occupant <?=$i?></label>
              <!--<input class="fs-anim-lower" id="nationality" name="nationality" type="text" placeholder="UAE" value="<?=$nationality?>" required/>-->
         <select id='nationality<?=$i?>' name="nationality<?=$i?>" class="fs-anim-lower" required />
          <option>        
          </option>        
          <?php
            $getNationalities=$db->getnationalities();
            foreach($getNationalities as $nationality)
            {
              ?>
              <option value="<?=$nationality['fld_nationality']?>" <?php if($national==$nationality['fld_nationality']){ echo "Selected";}?>><?=$nationality['fld_nationality']?></option>
              <?php
            }
          ?>
        </select> 
         <script>
          $(document).ready(function(){

            $("#nationality<?=$i?>").select2();

          });
        </script>
        <div id='result'></div>
            </li>
       <li data-input-trigger>
              <label class="fs-field-label fs-anim-upper"  data-info="This will help us know what kind of service you need">Gender of <?=$i?></label>
              <div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
                <span><input id="male<?=$i?>" name="gender<?=$i?>" type="radio" value="m" /><label for="male<?=$i?>" class="radio-male">Male</label></span>
                <span><input id="female<?=$i?>" name="gender<?=$i?>" type="radio" value="f" /><label for="female<?=$i?>" class="radio-female">Female</label></span>
              </div>
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="pic_occupant<?=$i?>" data-info="We won't send you spam, we promise...">Picture of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="pic_occupant<?=$i?>" name="pic_occupant<?=$i?>" type="file" placeholder="" />
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="passport<?=$i?>" data-info="We won't send you spam, we promise...">Passport Page of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="passport<?=$i?>" name="passport<?=$i?>" type="file" placeholder="" required />
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for=""visa<?=$i?>" data-info="We won't send you spam, we promise...">Visa Page of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="visa<?=$i?>" name="visa<?=$i?>" type="file" placeholder="" />
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="emiratefront<?=$i?>" data-info="We won't send you spam, we promise...">Emirates ID Front of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="emiratefront<?=$i?>" name="emiratefront<?=$i?>" type="file" placeholder="" />
            </li>
            <li>
              <label class="fs-field-label fs-anim-upper" for="emirateback<?=$i?>" data-info="We won't send you spam, we promise...">Emirates ID Back of Occupant <?=$i?></label>
              <input class="fs-anim-lower" id="emirateback<?=$i?>" name="emirateback<?=$i?>" type="file" placeholder="" />
            </li>
           
      <?php
      }
      ?>
      <li>
              <label class="fs-field-label fs-anim-upper" for="q2" data-info="We won't send you spam, we promise...">Move In Date</label>
       <select class="fs-anim-lower" name="move-in-date">
        
          <?php
              for($i=1;$i<=31;$i++)
              {
                if($i<=9)
                {
                  $i="0".$i;
                }
                ?>
                <option value="<?=$i?>"><?=$i?></option>
                <?php
              }
              ?>
        
      </select>
      <select class="fs-anim-lower" name="move-in-month">
              <option value="01">January</option>
              <option value="02">February</option>
              <option value="03">March</option>
              <option value="04">April</option>
              <option value="05">May</option>
              <option value="06">June</option>
              <option value="07">July</option>
              <option value="08">August</option>
              <option value="09">September</option>
              <option value="10">October</option>
              <option value="11">November</option>
              <option value="12">December</option>
      </select>
      <select class="fs-anim-lower" name="move-in-year">
        <?php
                for($i=2015;$i<=date("Y");$i++)
                {
                  ?>
                  <option value="<?=$i?>"><?=$i?></option>
                  <?php
                }
              ?>
       </select>
    <!--      <input type="text" class="fs-anim-lower" name="date" value="<?php echo $getTanent[0]['fld_move_in_date']; ?>" readonly> -->
            </li>
          </ol><!-- /fs-fields -->
          
      <button class="fs-submit" type="submit">Update Information</button>
        </form><!-- /fs-form -->
    
      </div><!-- /fs-form-wrap -->

    </div><!-- /container -->
     
    <!--<script src="js/jquery.js"></script>-->
    <script src="js/classie.js"></script>
    <script src="js/selectFxRegister.js"></script>
    <script src="js/fullscreenForm.js"></script>
    <script>
      (function() {
        var formWrap = document.getElementById( 'fs-form-wrap' );

        [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
          new SelectFx( el, {
            stickyPlaceholder: false,
            onChange: function(val){
              document.querySelector('span.cs-placeholder').style.backgroundColor = val;
            }
          });
        } );

        new FForm( formWrap, {
          onReview : function() {
            classie.add( document.body, 'overview' ); // for demo purposes only
          }
        } );
      })();

      if($(window).width() < 841){
        $(".fs-continue").text("");
      }
      else{
        $(".fs-continue").text("Continue");
      }

      $(window).resize(function(){
        if($(window).width() < 841){
        $(".fs-continue").text("");
        }
        else{
          $(".fs-continue").text("Continue");
        }
      });
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  </body>

<!-- Mirrored from 91.234.35.26/iwiki-admin/v1.2.1/admin/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Mar 2018 13:38:54 GMT -->
</html>
