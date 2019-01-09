<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Home extends Ext_Controller{
		function __construct(){

			parent::__construct(true);
			}
		
		
		function index(){
			$this->load->view('home');
			return;
		}

		function Register($id){
			$this->load->view('home');
			return;
		}		
	}