<?php 
$am = new AdminManager();

print_r($_REQUEST);
 $log = $_REQUEST['log'];
if(is_numeric ($log))
{
	$type = 'C';
}
else {
	$type = 'A';
}

// echo $log;
// echo $type;
// die;
      if ($type== 'C') {
      		
$error_msg = "";
if($_REQUEST['log'] =="")
{
	$error_msg = '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Please Enter Login Detail</span></div>';
}
if($_REQUEST['pwd'] =="")
{
	$error_msg = '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Please Enter Login Detail</span></div>';
}
if($error_msg == "")
{
	$chklogin=	$am->tenantlogin($_REQUEST['log'], $_REQUEST['pwd']);




	//print_r($chklogin);
	if($chklogin == 'blocked')
	{
		echo '<center><div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Your Account is blocked</span></div></center>';
	}
	else
	{
		if(!empty($chklogin))
		{
			if($chklogin['fld_is_setup_done']=="0")
			{
				$_SESSION[ADMIN_SESSION_NAME]['tanentid']	 =	$chklogin['fld_id'];
				?>
				<script>
					window.location.href="update-profile.php";
				</script>
				<?php
			}
			else
			{	
				//$_SESSION['SEMTEGRA']['userid']=true;
				$_SESSION[ADMIN_SESSION_NAME]['tanentid']	 =	$chklogin['fld_id'];
				$_SESSION[ADMIN_SESSION_NAME]['tenantname']   =	$chklogin['fld_name'];
				$_SESSION[ADMIN_SESSION_NAME]['tenantemail']	  =	$chklogin['fld_email'];
				$_SESSION[ADMIN_SESSION_NAME]['last_login'] =	$chklogin['fld_last_login'];
				//$_SESSION[ADMIN_SESSION_NAME]['type']	   =	$chklogin['fld_type'];
				echo "Login Successfull Redirecting ...";
				?>
				<script>
					window.location.href="index.php";
				</script>
				<?php
				
				exit;
			}
		}
		else
		{
			$error_msg = '<center><div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Incorrect username or password!</span></div></center>';
		}
	}	 
}	

echo $error_msg;
      	}	
      	else 
      	{
           $error_msg = "";

if($_REQUEST['log'] =="")
{
	$error_msg = '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Please Enter Login Detail</span></div>';
}

if($_REQUEST['pwd'] =="")
{
	$error_msg = '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Please Enter Login Detail</span></div>';
}

if($error_msg == "")
{
	$chklogin =	$am->adminLogin($_REQUEST['log'], $_REQUEST['pwd']);
	//print_r($chklogin);
	if($chklogin == 'blocked')
	{
		echo '<div id="fail" class="info_div" style="width:96%;"><span class="ico_cancel" id="error_msg">Your Account is blocked</span></div>';
	}
	else
	{
		if(!empty($chklogin))
		{ 
			//$_SESSION['SEMTEGRA']['userid']=true;
			$_SESSION[ADMIN_SESSION_NAME]['userid']	 =	$chklogin['fld_id'];
			$_SESSION[ADMIN_SESSION_NAME]['username']   =	$chklogin['fld_name'];
			$_SESSION[ADMIN_SESSION_NAME]['email']	  =	$chklogin['fld_email'];
			$_SESSION[ADMIN_SESSION_NAME]['last_login'] =	$chklogin['fld_last_login'];
			$_SESSION[ADMIN_SESSION_NAME]['type']	   =	$chklogin['fld_type'];
			$_SESSION[ADMIN_SESSION_NAME]['role_id'] = "0";
			$_SESSION[ADMIN_SESSION_NAME]['role'] = $chklogin['role'];
			echo "Login Successfull Redirecting ...";
			?>
			<script>
				window.location.href="admin/index.php";
			</script>
			<?php
			exit;
		}
		else
		{
			$error_msg = '<div id="fail" class="info_div"><span class="ico_cancel" id="error_msg">Incorrect username or password!</span></div>';
		}
	}	 
}	

echo $error_msg;
      	}

?>