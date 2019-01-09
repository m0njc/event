<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Register extends Ext_Controller{
		function __construct(){

			parent::__construct(true);
			// $sess = $this->session->userdata('krpd_session');
			// $logged_in = $sess['logged_in'];
			// if ($logged_in == false) {
			// 	redirect('Login');
			// }

			$this->load->model('Others_model');
			$this->load->model('Register_model');
			}
		
		
		function index() {
			// $sess = $this->session->userdata('krpd_session');
			// $logged_in = $sess['logged_in'];
 		// 	if ($logged_in==false) {
			// 	$data['errLogin'] = NULL;
			// 	$this->load->view('login', $data);
			// 	return;
			// }

			$data['dioceses'] = $this->Others_model->getAllDiocese();
			$this->load->view('register', $data);
			return;
		}
		function katekis() {
			// $sess = $this->session->userdata('krpd_session');
			// $logged_in = $sess['logged_in'];
 		// 	if ($logged_in==false) {
			// 	$data['errLogin'] = NULL;
			// 	$this->load->view('login', $data);
			// 	return;
			// }
			$data['dioceses'] = $this->Others_model->getAllDiocese();
			$this->load->view('registerKatekis', $data);
			return;
		}
		function doRegisterKatekis() {
			$fname = $this->input->post('tbx_fname');
			$lname = $this->input->post('tbx_lname');
			$email = $this->input->post('tbx_email');
			$phone = $this->input->post('tbx_phone');
			$diocese = $this->input->post('slct_diocese');
			$parish = $this->input->post('slct_parish');
			$address = $this->input->post('tbx_address');
			$postcode = $this->input->post('tbx_postcode');
			$newpwd = md5($this->input->post('tbx_pwd'));
			$vrfpwd = md5($this->input->post('tbx_pwd_vrf'));

			if($newpwd!=$vrfpwd) {
				$this->session->set_flashdata('register_error','Password tidak sama.');
				redirect('Register/Katekis');
			}
			else {

				$now = date("Y-m-d H:i:s");
				$data = array(
					'email'=>$email,
					'password'=>$newpwd,
					'fullName'=>$fname.' '.$lname,
					'name'=>$fname,
					'address'=>$address,
					'mobilePhone'=>$phone,
					'dioceseId'=>$diocese,
					'parishId'=>$parish,
					'createdBy'=>'0',
					'createdDate'=>$now,
				);
				if($this->Register_model->register($data)) {
					$this->session->set_flashdata('login_success','User Anda sudah terbuat. Silakan login.');
					redirect('Login');

				}
			}


		}
		function getParishByDiocese($dioceseID) {
			$res = $this->Others_model->getParishByDiocese($dioceseID);	
			echo json_encode($res);
		}

		
	}