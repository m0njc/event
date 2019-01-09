<?php if(!defined('BASEPATH')) exit("Hack attempt?");

class Ext_Controller extends Controller{

	protected $data = array();	
	
	function __construct($isFrontend = false){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		session_start();
		$this->load_default();
		$this->load->library('session');
		$this->load->helper('date');
		$this->load->library('form_validation');
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'templates/ckeditor/';

/*		if ($isFrontend){
			//$this->load->helper('captcha');
			$this->load->plugin('captcha');
			$this->load->library('email');
			$this->get_captcha();
		}
		*/

		$sess = $this->session->userdata('dc_passport_session');
			$logged_in = $sess['admin_logged_in'];
			if ($logged_in == false) {
				redirect('Login');
			}
	}
	
	private function load_default(){
		$this->config->load('url',TRUE);		
		$this->data['url'] = $this->config->item('url');
		//$this->load->model('contact_model');
		//$this->data['contactCategory'] = $this->contact_model->get_all_contact_category();
		//$this->data['contactDescription'] = $this->contact_model->get_contact_description();
		//$this->get_captcha();
	}

	private function get_captcha(){
		$captcha = $this->CreateCaptcha();
		$this->data['captchaData'] = $captcha;
	}

	private function CreateCaptcha(){
		//////// Begin Captcha Region \\\\\\\\\
		$CaptchaConfig = array(
			'img_path' => 'userdata/temp/captcha/'
			, 'img_url' => base_url() . 'userdata/temp/captcha/'
			, 'img_width' => 300
			, 'img_height' => 34
			, 'font_path'  =>  base_url() . './templates/theme/font/BonvenoCF-Light-webfont.TTF'
			);

		$cap = create_captcha($CaptchaConfig);

		$dataCaptcha = array(
			'captcha_time' => $cap['time']
			, 'ip_address' => $this->input->ip_address()
			, 'word' => $cap['word']
			);

		$this->load->model('captcha_model');
		$result = $this->captcha_model->InsertCaptcha($dataCaptcha);

		if ($result){
			return $cap;
		}

		return null;
		///////////////////////////////////////
	}

	public function sendEmail(){
		$this->load->model('others_model');


		$this->form_validation->set_rules('tbx_name', 'Name', 'required');
		$this->form_validation->set_rules('tbx_email', 'Email', 'required');
		$this->form_validation->set_rules('tbx_phone', 'Phone', 'required');
		$this->form_validation->set_rules('tbx_subject', 'Subject', 'required');
		$this->form_validation->set_rules('tbx_message', 'Message', 'required');
		$this->form_validation->set_rules('tbx_captcha', 'Security Code', 'required');
		$redirect = $this->input->post('hdn_redirect');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errorSendEmail', validation_errors());
			redirect($redirect."#messagebox", 'refresh');
		}
		else{



			$this->load->model('captcha_model');

			// Delete old captcha
			$this->captcha_model->DeleteOldCaptcha();

			// Validate
			$isCaptchaValid = $this->captcha_model->ValidateCaptcha(
				$this->input->post('tbx_captcha')
			);

			if (!$isCaptchaValid){
				$this->session->set_flashdata(
					'errorSendEmail'
					, 'Wrong Captcha');
				redirect($redirect."#messagebox", 'refresh');
			}

			//insert to db region
			$data = array(
				'name'=>$this->input->post('tbx_name'),
				'phone'=>$this->input->post('tbx_phone'),
				'email'=>$this->input->post('tbx_email'),
				'subject'=>$this->input->post('tbx_subject'),
				'message'=>$this->input->post('tbx_message'),
				'datein'=>date("Y-m-d H:i:s"),
				'userin'=>'Contact Form'
			);

			if($this->others_model->add_message($data))
			{
			}
			else
			{
				$this->session->set_flashdata('errorSendEmail', 'System errors. Please try again later.');
				redirect($redirect."#messagebox", 'refresh');
			}
			//end of insert to db region

			$config['charset'] = 'iso-8859-1';
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from(
				$this->input->post('tbx_email'),
				$this->input->post('tbx_name')
			);
			$this->email->to(
				'marketing@wintec.co.id'
			);
			$this->email->subject(
				$this->input->post('tbx_subject')
			);
			$this->email->message(
				"Dear Wintec Administrator,<br /><br />
				You have received an inquiry email via the Wintec website, please find the details below:<br /><br />
				Sender Name: ".$this->input->post('tbx_name')."<br /><br />
				Email Address: ".$this->input->post('tbx_email')."<br /><br />
				Phone Number: ".$this->input->post('tbx_phone')."<br /><br />
				Subject: ".$this->input->post('tbx_subject')."<br /><br />
				Message: <br />".$this->input->post('tbx_message')
			);


			$resultSend = $this->email->send();

			if (!$resultSend){
				// Error message
				$msg = $this->email->print_debugger();
				$this->session->set_flashdata('errorSendEmail', $msg);
				redirect($redirect."#messagebox", 'refresh');
			}
			else{
				// Success
				$msg = 'Success send email.';
				$this->session->set_flashdata('msgSendEmail', $msg);
				redirect($redirect."#messagebox", 'refresh');
			}
		}
	}
}
?>