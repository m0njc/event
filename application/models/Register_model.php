<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Register_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function register($data)
{
	$result = $this->db->insert('msUser', $data);
	return $result;
}

}

