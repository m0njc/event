<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Home extends Ext_Controller{
		function __construct(){

		parent::__construct(true);
			$this->load->model('People_model');
			$this->load->model('Parish_model');

		}
		
		
		function index($id){
			$data['id'] = $id;
			$this->load->view('home', $data);

			return;
		}

		function Register($id){
			$data['id'] = $id;
			$data['parishes']  = $this->Parish_model->getAllParish();
			$this->load->view('home', $data);
			return;
		}

		function doLogin($id) {
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');


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

		function doRegister($id){
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$dateOfBirth = $this->input->post('dateOfBirth');
			$parish = $this->input->post('parish');
			$otherParish = $this->input->post('otherParish');
			$occupation = $this->input->post('occupation');

			$data = array(
				'firstName'=>$fname,
				'lastName'=>$lname,
				'email'=>$email,
				'phone1'=>$phone,
				'dateOfBirth'=>date("Y-m-d",strtotime($dateOfBirth)),
				'parishId'=>$parish==999 ? $otherParish : $parish,
				'occupation'=>$occupation
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