<?php
include_once("DBAccess.php");

Class AdminManager extends DBAccess
{
	/* ADMIN SITE FUNCTIONS */
	function tenantlogin($username,$password)
	{
		$this->connectToDB();
		$sql="select *  from ".DB_PREFIX."tanents WHERE `fld_number`='".$username."' OR `fld_whatsapp_no`='".$username."'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		// print_r($result[0]['fld_is_current_tanent']);
		// 		die;
		if($result[0])
		{
			if($result[0] && ifish_validatePassword($password, $result[0]['fld_password']))
			{

				if($result[0]['fld_is_current_tanent'] == 1)
				{
					return $result[0];
				}
				else
				{
					return $result[0]['fld_is_current_tanent'] = 'blocked'; 
				}
			}	
			else
			{
				return array();
			}		
		}
	}
	function save_last_login($id)
	{
		$this->connectToDB();
		$sql="update ".DB_PREFIX."tanents set fld_last_login ='".time()."' where fld_id='".$id."'";
		//echo $sql;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

   
	function getAllUsersLocations()
	{
		$this->connectToDB();
		$sql="select * from tbl_admin where fld_status='1' and fld_type='1'";
		//echo $sql;
		$result = $this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

	// Admin Login via Common Login 

		function adminLogin($username,$password)
	{
		$this->connectToDB();
	/*	$sql="select fld_id, fld_name, fld_email, fld_last_login, fld_password,fld_type, fld_status  
		from ".DB_PREFIX."admin WHERE fld_email='".$username."'";*/

		$sql="select tbl_admin.fld_id, tbl_admin.fld_name, tbl_admin.fld_email, tbl_admin.fld_last_login, tbl_admin.fld_password,tbl_admin.fld_type, tbl_admin.fld_status ,`tbl_roles`.`fld_role` AS role
		from ".DB_PREFIX."admin INNER JOIN `tbl_role_assign` ON `tbl_admin`.`fld_id`=`tbl_role_assign`.`fld_admin_id` INNER JOIN `tbl_roles` ON `tbl_role_assign`.`fld_role`=`tbl_roles`.`fld_id` WHERE fld_email='".$username."'";

		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		if($result[0])
		{
			if($result[0] && ifish_validatePassword($password, $result[0]['fld_password']))
			{
			
				return $result[0];
			}	
			else
			{
				return array();
			}		
		}
	}
	
}