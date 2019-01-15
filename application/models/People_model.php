<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class People_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function addPeople($data,$id)
	{
		$result = $this->db->insert('msPeople', $data);
		$insert_id = $this->db->insert_id();
		$dataEvent = array(
				'eventId'=>$id,
				'peopleId'=>$insert_id,
				'logTime'=>date('Y-m-d h:i:s')
			);
		$result = $this->db->insert('trEventParticipant', $dataEvent);
		return $result;
	}

	function comingPeople($email, $phone, $id)
	{

		$sql = "select * from msPeople where 1=0";
		if($email) $sql.= " or email like '".esc($email)."' ";
		if($phone) $sql .= " or phone1 like '".esc($phone)."' or phone2 like '".esc($phone)."'";
		$selectResult = $this->fetch_single_row($sql);

		$dataEvent = array(
				'eventId'=>$id,
				'peopleId'=>$selectResult['peopleId'],
				'logTime'=>date('Y-m-d h:i:s')
			);
		$result = $this->db->insert('trEventParticipant', $dataEvent);
		return $result;
	}


}