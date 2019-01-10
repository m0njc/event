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


}