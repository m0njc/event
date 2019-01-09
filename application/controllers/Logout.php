<?php if(!defined("BASEPATH")) exit("Hack Attempt");

class Logout extends Ext_Controller {
	function __construct(){
		parent::__construct();
		 $this->load->helper('cookie');
		
	}
	function index(){
                $sess_user = array(
                    'loggedIn' => true,
                    'userId' => '',
                    'userName' => ''
                );

		$this->session->unset_userdata('dc_event_session',$sess_user);
		delete_cookie('event');
		redirect('Login', 'refresh');
	}
}