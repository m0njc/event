<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Parish extends Ext_Controller{
		function __construct(){

			parent::__construct(true);
			$this->load->model('Parish_model');

			}
		
		
		function getParish(){
			$key = $this->input->get('parish');
			$data = $this->Parish_model->getParishByKey($key);
			echo json_encode($data);
		}

		

		
	}