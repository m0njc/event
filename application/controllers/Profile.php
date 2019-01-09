<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Profile extends Ext_Controller{
		function __construct(){

			parent::__construct(true);
			// $sess = $this->session->userdata('krpd_session');
			// $logged_in = $sess['logged_in'];
			// if ($logged_in == false) {
			// 	redirect('Login');
			// }

			// $this->load->model('login_model');
			}
		
		
		function index(){
			// $sess = $this->session->userdata('krpd_session');
			// $logged_in = $sess['logged_in'];
 		// 	if ($logged_in==false) {
			// 	$data['errLogin'] = NULL;
			// 	$this->load->view('login', $data);
			// 	return;
			// }

			$this->load->view('profile');
			return;
		}

		
	}