<?php if(!defined("BASEPATH")) exit("Hack Attempt");
	class Event extends Ext_Controller{
		function __construct(){

			parent::__construct(true);
			$this->load->model('Event_model');

			}
		
		
		function index(){
			$data['events'] = $this->Event_model->getAllEvents();
			$this->load->view('event', $data);
		}

		function doAdd(){
			$tbx_eventName = $this->input->post('tbx_eventName');
			$tbx_eventId = $this->input->post('tbx_eventId');
			$tbx_date = $this->input->post('tbx_date');
			$session_data = $this->session->userdata('dc_event_session');
		    $username = $session_data['userName'];

		    if($tbx_eventId) {
				$data = array(
					'eventId'=>$tbx_eventId,
					'eventName'=>$tbx_eventName,
					'eventDate'=>date("Y-m-d",strtotime($tbx_date)),
					'createdDate'=>date("Y-m-d h:i:s"),
					'functionId'=>1,
					'createdBy'=>$username
				);

				if($this->Event_model->editEvent($data)) {
					$this->session->set_flashdata('success','Edited.');
					redirect('Event');
				}
				else {
					$this->session->set_flashdata('error','Failed.');
					redirect('Event');
				}

		    }
		    else {
			    $data = array(
					'eventName'=>$tbx_eventName,
					'eventDate'=>date("Y-m-d",strtotime($tbx_date)),
					'createdDate'=>date("Y-m-d h:i:s"),
					'functionId'=>1,
					'createdBy'=>$username
				);

				if($this->Event_model->addEvent($data)) {
					$this->session->set_flashdata('success','Saved.');
					redirect('Event');
				}
				else {
					$this->session->set_flashdata('error','Failed.');
					redirect('Event');
				}
		    }
		}

		function doDelete($id)
		{
			$data = array(
				'eventId'=>$id
			);

			if($this->Event_model->deleteEvent($data)) {
				$this->session->set_flashdata('success','Deleted.');
				redirect('Event');
			}
			else {
				$this->session->set_flashdata('error','Failed.');
				redirect('Event');			
			}
		}

		function participant($id){
			$data['participants'] = $this->Event_model->getParticipantFromEvent($id);
			$data['id'] = $id;
			$this->load->view('eventparticipant', $data);
		}

		
	}