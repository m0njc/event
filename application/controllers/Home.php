<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Home extends Ext_Controller{
		function __construct(){

		parent::__construct(true);
			$this->load->model('People_model');

		}
		
		
		function index($id){
			$data['id'] = $id;
			$this->load->view('home', $data);
			return;
		}

		function Register($id){
			$data['id'] = $id;
			$this->load->view('home', $data);
			return;
		}

		function doRegister($id){
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');

			$data = array(
				'firstName'=>$fname,
				'lastName'=>$lname,
				'email'=>$email,
				'phone1'=>$phone
			);

			$result = $this->People_model->addPeople($data, $id);
			if($result) {
				$res = array(
					'success'=>true,
					'message'=>'Data is saved! Welcome!',
					'result'=>$result
				);
			}
			else {
				$res = array(
					'success'=>false,
					'message'=>'Failed to save data! Try again!',
					'result'=>$result					
				);
			}

			echo json_encode($res);

		}		
	}