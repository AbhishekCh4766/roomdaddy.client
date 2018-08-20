<?php 
  include_once("dbbridge/top.php");
  $am=new AdminManager();
  $locations=$am-> getAllUsersLocations();
  if(isset($_SESSION[ADMIN_SESSION_NAME]['tanentid']) && !empty($_SESSION[ADMIN_SESSION_NAME]['tanentid']))
  {
?>
    <script language="javascript">
      window.location.href="index.php";
    </script>
<?php   
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/vendors/sweetalert.css">
  <link rel="stylesheet" href="css/vendors/loading.css">



<link rel="stylesheet" href="css/vendors/checkboxes.css">

<!--<script src="js/modernizr.custom.js"></script>-->

  <link rel="stylesheet" href="css/main.css">
  <!--<script src="js/modernizr.js"></script>-->
  <!--<script src="admin/js/ajaxfunctions.js"></script>-->
  <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
   <link href="build/css/custom.min.css" rel="stylesheet">
  <script type="text/javascript" src="admin/js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="admin/js/jquery.form.js"></script>
  <!--<script src="admin/js/ajaxfunctions.js"></script>-->
  
  <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.src.js"></script>
  <![endif]-->

  <script>
  function loginfunction()
  {
    var datastring=$("#loginform").serialize();
    $.ajax({
    type: "post",
    url: "request_process.php?calling=5",
    data: datastring,
    success: function(responseData, textStatus, jqXHR) {
      //alert(responseData);exit;
      $("#loginform")[0].reset();
      if(responseData.search('done')!='-1')
      {
         var arr=responseData.split('-');
         $("#success").html(arr[1]);
         $("#success").show();
         $("#fail").hide();
      }
      else
      {
        $("#fail").html(responseData);
        $("#success").hide();
        $("#fail").show();
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
    }
  })
  }
  </script>
</head>




<body class="decor-success loginpage">
 <a class="gohome" href="index.html"><i class="fa fa-home"></i> Go to Home Page</a>
  <div class="table-wrapper">
    <div class="table-row">
      <div class="table-cell">
             <h1 class="text-center form-title">Welcome</h1>
       <div id="success">
       
       </div>
       <div id="fail">
       
       </div>
              <div class="account-wall">
                <form class="form-login fs-form" method="post" id="loginform">
        <div class="onerow" id="error_div">
      
        </div>
                  <label class="fs-field-label" for="q1">What's your Number?</label>
                  <input class="fs-anim-lower" name="log" id="q1" name="q1" type="text" />
                  <label class="fs-field-label" for="q2">What's your password?</label>
                  <input class="fs-anim-lower" name="pwd" id="q2" name="q1" type="password" />

        <!--
                  <div class="ac-custom ac-checkbox ac-checkmark">
                    <span class="color-green">
                      <input id="cb2" name="cb2" type="checkbox">
                      <label for="cb2">Remember me</label>
                    </span>
                  </div>-->

                  <div class="text-right">
                    <!--<a class="text-light lostpass m-r-md" href="lostpassword.html">Forgot your password?</a>-->
                   
                  </div>
                </form>
         <button class="btn btn-lg btn-primary"  onClick="return loginfunction();" type="submit">
                      Log in
          </button>
              </div>

      </div>
    </div>
  </div>
    <!--<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/checkboxes.js"></script>-->

 </body>

</html>







