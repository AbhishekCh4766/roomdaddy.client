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

		function getAllTanent()
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` WHERE `fld_is_current_tanent`=1";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

		function getTanentEntryDate($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tenent_history` WHERE `fld_tenent_id`=$id AND fld_type=0 ORDER BY fld_id ASC LIMIT 1";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}

		function getTanentDocumentsById($id)
	{
		$this->connectToDB();
		$sql="SELECT `tbl_tanents`.`fld_actual_name`, `tbl_sub_tanents`.* from `tbl_tanents` 
        LEFT JOIN `tbl_sub_tanents` ON `tbl_tanents`.`fld_id` = `tbl_sub_tanents`.`fld_tanent_id`
		WHERE `tbl_tanents`.`fld_id`='$id'";
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

	function GetNotice()
	{
		$tid=$_SESSION[ADMIN_SESSION_NAME]['tanentid'];
		$this->connectToDB();
		$sql="SELECT * from `tbl_notice`
        LEFT JOIN `tbl_tanents` ON `tbl_tanents`.`fld_id`=`tbl_notice`.`tenent_id`
		 WHERE `tenent_id`='$tid' ORDER BY id DESC LIMIT 1 ";
		//echo $sql; exit;
		$result=$this->CustomQuery($sql); 
		//print_r($result); die;
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

		function GetLastDepositByTanent($id)
	{
		$this->connectToDB();
		$sql="SELECT * FROM `tbl_deposit_in` WHERE `fld_tanent_id` = '$id' ORDER BY `fld_id` DESC";
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
	function UpdateTanent($id,$name,$email,$number,$whatsapp,$nationality,$profilepicture,$sex,$date)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_actual_name`='$name',
		`fld_email`='$email',
		`fld_number_client`='$number',
		`fld_whatsapp_no`='$whatsapp',
		`fld_nationality`='$nationality',
		`fld_sex`='$sex',
		`fld_profile_picture`='$profilepicture',
		`fld_is_setup_done`='1',
		`fld_tanent_move_date`=$date
		where fld_id=$id";
		echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}



    function EditTanent($id,$name,$email,$number,$whatsapp,$sex,$profilepicture)
	{

		$this->connectToDB();
		$sql="update `tbl_tanents` set `fld_name`='$name',
		`fld_email`='$email',
		`fld_number`='$number',
		`fld_whatsapp_no`='$whatsapp',
		`fld_sex`='$sex',
		`fld_profile_picture`='$profilepicture'
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
			WHERE `tbl_complaints`.`fld_tenant_id`='$id' AND `tbl_sub_complaints`.`is_closed` = 0";
			//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
		function GetSubComplaintByTenantopen($id)
	{
		$this->connectToDB();
		// SELECT `tbl_sub_complaints`.*, `tbl_complaints`.`fld_tenant_id` AS tenent_id, `tbl_admin`.`fld_name` AS AdminName FROM `tbl_sub_complaints` INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`=`tbl_sub_complaints`.`fld_id` INNER JOIN `tbl_admin` ON `tbl_sub_complaints`.`assigned_to`=`tbl_admin`.`fld_id` WHERE `tbl_complaints`.`fld_tenant_id`=191 AND `tbl_sub_complaints`.`is_closed` = 0 

		// $sql="SELECT `tbl_sub_complaints`., `tbl_complaints`.`fld_tenant_id` AS tenent_id 
		// FROM `tbl_sub_complaints` 
		// INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`=`tbl_sub_complaints`.`fld_id`  
		// WHERE `tbl_complaints`.`fld_tenant_id`=$id AND `tbl_sub_complaints`.`is_closed` = 0 ";


		$sql = "SELECT `tbl_sub_complaints`.*, `tbl_complaints`.`fld_complaint_description` As Description  from `tbl_sub_complaints`  
                INNER JOIN `tbl_complaints` ON `tbl_sub_complaints`.`fld_complaint_id`= `tbl_complaints`.`fld_id`
		        WHERE `tbl_sub_complaints`.`is_closed` = 0 AND `tbl_complaints`.`fld_tenant_id`= $id ";
			//echo $sql;exit;
		$result=$this->CustomQuery($sql); 
		$this->DBDisconnect();
		return $result;
	}
		function CloseComplaint($id)
	{  
        
		$this->connectToDB();
		$sql="update `tbl_sub_complaints` set 
		`is_closed`='1'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
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
		$sql="SELECT * from `tbl_admin` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function addComment($subcomplain,$sender,$senderid,$message)
	{
		$this->connectToDB();
		$table = "tbl_chats";
		$insert = "`fld_sub_complain_id`, `fld_sender`, `fld_sender_id`, `fld_message`";
		$values = "'$subcomplain','$sender','$senderid','$message'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function AddSubTanents($tenantid,$name,$email,$number,$whatsapp,$nationality,$sex,$profilepicture,$passportpic,$visapage,$emiratesfront,$emiratesback)
	{
		//tbl_sub_tanents
		$this->connectToDB();
		$table = "tbl_sub_tanents";
		$insert = "`fld_tanent_id`, `fld_name`, `fld_email`, `fld_number`, `fld_whatsapp`, `fld_nationality`, `fld_sex`, `fld_profile_picture`, `fld_passport_pic`, `fld_visa_page`, `fld_emirates_front`, `fld_emirates_back`";
		$values = "'$tenantid','$name','$email','$number','$whatsapp','$nationality','$sex','$profilepicture','$passportpic','$visapage','$emiratesfront','$emiratesback'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);
		$this->DBDisconnect();
		return $result;
	}
	function DeleteSubtanentsByTanentid($id)
	{
		$this->connectToDB();
		$sql="delete from `tbl_sub_tanents` where `fld_tanent_id`=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetSubtanentsByTanentId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_sub_tanents` WHERE `fld_tanent_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}

		function GetTanentsPassbyId($id)
	{
		$this->connectToDB();
		$sql="SELECT * from `tbl_tanents` WHERE `fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomQuery($sql);
		$this->DBDisconnect();
		return $result;
	}
	function SetupDone($id)
	{
		$this->connectToDB();
		$sql="update `tbl_tanents` set 
		`fld_setup_done`='1'
		where fld_id=$id";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
	function GetTanentsbyId($id)
	{
		$this->connectToDB();
		$sql="SELECT 
		`tbl_tanents`.`fld_actual_name` AS 'name',
		`tbl_rooms`.`fld_custom_room_name` AS 'room_name',
		`tbl_rooms`.`fld_room` AS 'room_id',
		`tbl_building`.`fld_building` AS 'building_name',
		`tbl_building`.`fld_apt_no` AS 'apt'
		from `tbl_tanents` 
		INNER JOIN `tbl_bedspace` ON `tbl_bedspace`.`fld_id`=`tbl_tanents`.`fld_bedspace_id`
		INNER JOIN `tbl_rooms` ON `tbl_rooms`.`fld_id`=`tbl_bedspace`.`fld_room`
		INNER JOIN `tbl_building` ON `tbl_building`.`fld_id`=`tbl_rooms`.`fld_building_id`
		WHERE `tbl_tanents`.`fld_id`='$id'";
		//echo $sql;exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}

	function addnotice(){     
		// print_r($_REQUEST);
		// die;
		$this->connectToDB();
		$table = "tbl_notice";
		$insert = "`move_out_reason`, `rating`, `tenent_id`, `move_out_date`";
		$values = "'".$_REQUEST['reason']."','".$_REQUEST['rate']."','".$_REQUEST['tenent_id']."','".$_REQUEST['move_out_date']."'";
		//echo " INSERT INTO ".$table." (".$insert.") VALUES (".$values.")";exit;
		$result = $this->InsertRecord($table,$insert,$values);		$this->DBDisconnect();
		return $result;
	}
		function editnotice(){     
		
	    $this->connectToDB();
		$sql="update `tbl_notice` set 
		`move_out_reason`='".$_REQUEST['reason']."',
		`status`= '0',
		`move_out_date`='".$_REQUEST['move_out_date']."'
		where tenent_id='".$_REQUEST['tenent_id']."'";
		$result=$this->CustomModify($sql);
		//echo $sql;exit;
		$this->DBDisconnect();
		return $result;
	}
		function addfeedback(){  
		
		$this->connectToDB();
		$sql="update `tbl_notice` set 
		`feedback`='".$_REQUEST['help_us']."',
		`rating`='".$_REQUEST['rate']."'
		where id='".$_REQUEST['id']."'";
		$result=$this->CustomModify($sql);
		//echo $sql;exit;
		$this->DBDisconnect();
		return $result;
	}

		function changePassword($id,$pass)
	{
		
		$this->connectToDB();
		$sql="update ".DB_PREFIX."tanents set fld_password=$pass where fld_id=$id ";
		//echo $sql; exit;
		$result=$this->CustomModify($sql);
		$this->DBDisconnect();
		return $result;
	}
}
?>