<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Parish_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function getAllParish() {
		$sql = "select * from msParish order by parishName asc";
		return $this->fetch_multi_row($sql);
	}

	function getParishById($id) {
		$sql = "select * from msParish where parishId=$id";
		return $this->fetch_single_row($sql);
	}

	function getParishByKey($key) {
        $this->db->like("parishName", $key);
        return $this->db->get('msParish')->result_array();
	}

	function addParish($data)
	{
		$result = $this->db->insert('msParish', $data);
		return $result;
	}


}