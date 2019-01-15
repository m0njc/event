<?php if(!defined('BASEPATH')) exit('Hack attemp?');

class Login_model extends Ext_Model{

	function __construct(){
		parent::__construct();
	}
	
	function login($username, $password) {
		$sql = "select * from msUser where userName = '".esc($username)."' and password = '".esc($password)."' and deleted <> 1";
		return $this->fetch_single_row($sql);
	}
	function checkCookieForLogin($username, $userid) {
		$sql = "select * from msUser where userName = '".esc($username)."' and password = '".esc($userid)."' and deleted <> 1";
		return $this->fetch_single_row($sql);
	}
	function updateLastLogin($userId) {
		$this->db->where('userId', $userId);
		$this->db->set('lastLogin', date('Y-m-d H:i:s'));
	    $result = $this->db->update('msUser');
	    return $result;
	}

}