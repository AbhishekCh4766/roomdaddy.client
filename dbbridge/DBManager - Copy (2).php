<?php
@session_start();
include_once("DBAccess.php");

//include_once("AdminManager.php");

Class DBManager extends DBAccess
{
	
	function getTanentById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` WHERE `fld_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetBedspaceByTanent($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_bedspace` WHERE `fld_tanent_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetRoomsById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_rooms` WHERE `fld_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetBuildingById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_building` WHERE `fld_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositInSumByTanent($id)
	{
		$this->connectToDB();
		$sql="SELECT SUM(fld_deposit) AS 'deposit' from `tbl_deposit_in` WHERE `fld_tanent_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetDepositOutSumByTanent($id)
	{
		$this->connectToDB();
		$sql="SELECT SUM(fld_deposit) AS 'deposit' from `tbl_deposit_out` WHERE `fld_tanent_id`='$id'";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetLastPaymentByTanent($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_tanent_id` = '$id' ORDER BY `fld_id` DESC";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetPaymentHistroy($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_rent_status` WHERE `fld_tanent_id` = '$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetAllComplaintType()
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_complaint_type`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function RegisterComplaint($tanent_id,$complaint_description,$prefer_time,$prefer_date,$attachmentone,$attachmenttwo,$attachmentthree)
	{
		$this->connectToDB();
		$table = "tbl_complaints";
		$insert = "`fld_tenant_id`, `fld_complaint_description`, `fld_prefer_time`, `fld_prefer_date`, `fld_attachment_one`, `fld_attachment_two`, `fld_attachment_three`";
		$values = "'$tanent_id','$complaint_description','$prefer_time','$prefer_date','$attachmentone','$attachmenttwo','$attachmentthree'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function AddSubComplaint($complaint_id,$compaint_type)
	{
		$this->connectToDB();
		$table = "tbl_sub_complaints";
		$insert = "`fld_complaint_id`, `fld_complaint_type`, `fld_is_read`, `fld_priority`, `fld_is_resolved_by`, `fld_reopen_status`";
		$values = "'$complaint_id','$compaint_type','0','0','0','0'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function UpdateTanent($id,$name,$email,$number,$whatsapp,$nationality,$profilepicture,$sex)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_name`='$name',
		`fld_email`='$email',
		`fld_number`='$number',
		`fld_whatsapp_number`='$whatsapp',
		`fld_nationality`='$nationality',
		`fld_sex`='$sex',
		`fld_profile_picture`='$profilepicture',
		`fld_setup_done`='1'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function getnationalities()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_nationalities`";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetComplaintByTenant($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_complaints` WHERE `fld_tenant_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetSubComplaintByTenant($id)
	{
		$this->connectToDB();
		$sql="SELECT 
			`tbl_sub_complaints`.`fld_complaint_type` AS 'complaint_type',
			`tbl_sub_complaints`.`fld_id` AS 'id'
			FROM `tbl_sub_complaints` 
			INNER JOIN `tbl_complaints` ON `tbl_complaints`.`fld_id`=`tbl_sub_complaints`.`fld_complaint_id`
			WHERE `tbl_complaints`.`fld_tenant_id`='$id'";
			//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetChatBySubComplaint($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_chats` WHERE `fld_sub_complain_id`='$id'";
		// echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetComplaintbyId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_complaints` WHERE `fld_id`='$id'";
		// echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	function GetSubComplaintById($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_sub_complaints` WHERE `fld_id`='$id'";
		// echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
	
	function getChatByComplaint($complaintId)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_chats` WHERE `fld_sub_complain_id`='$complaintId'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function getAdminNamebyId($id)
	{
		$this->connectToDB();
		$sql="SELECT `fld_name` from `tbl_admin` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
}
?>