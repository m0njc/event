<?php
if (!defined("BASEPATH"))
    exit("Hack Attempt");
class Login extends Ext_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->helper('cookie');
        if($this->input->cookie('event',true)!=null){
            $this->validateLoginByCookie(explode('|', $this->input->cookie('event',true))[0],explode('|', $this->input->cookie('event',true))[1]);
        }else{
        if ($this->session->userdata('dc_event_session', 'admin_logged_in') == true)
            redirect('Event');
        }        

    }
    
    function index()
    {
        $this->load->view('login');
    }
    
    function doLogin()	
    {
        $username = $this->input->post('tbx_username');
        $password = md5($this->input->post('tbx_password'));
        if (!$username || !$password) {
            $this->session->set_flashdata('login_error', 'Username atau password salah.');
           delete_cookie('event');
           redirect('Login');
        } else {
           $this->validateLogin($username,$password);
        }
   
    }
    function setCookie($email,$userId)
	 {
      $cookie= array(
          'name'   => 'event',
          'value'  => $email."|".$userId,
          'path' => '/',
          'expire' => '2592000'
      );
      //save cookie 30 days
      $this->input->set_cookie($cookie);

	 }

	

    function validateLogin($username,$password)
    {
    	 $login = $this->login_model->login($username, $password);
            if ($login != NULL) {
                $sess_user = array(
                    'loggedIn' => true,
                    'userId' => $login['userId'],
                    'userName' => $login['userName']                );
                $this->session->set_userdata('dc_event_session', $sess_user);
                //                    redirect('Dashboard', 'refresh');
                
                
                $session_data = $this->session->userdata('dc_event_session');  
                $userId = $login['userId'];          

                 $this->login_model->updateLastLogin($userId);

               
                redirect('Event', $this->data);
                
            } else {
                $this->session->set_flashdata('login_error', 'Username atau password salah.');
                delete_cookie('event');
                redirect('Login');
            }
    }

    function validateLoginByCookie($email,$userId)
    {
            $login = $this->login_model->checkCookieForLogin($email, $userId);
            if ($login != NULL) {
                 $sess_user2 = array(
                    'loggedIn' => true,
                    'userId' => '',
                    'email' => '',
                    'fullName' => '',
                    'name' => '',
                    'parishId' => '',
                    'dioceseId' => ''
                );
                $this->session->unset_userdata('dc_event_session',$sess_user2);
                $sess_user = array(
                    'loggedIn' => true,
                    'userId' => $login['userId'],
                    'email' => $login['email'],
                    'fullName' => $login['fullName'],
                    'name' => $login['name'],
                    'parishId' => $login['parishId'],
                    'dioceseId' => $login['dioceseId']
                );
               
                $this->session->set_userdata('dc_event_session', $sess_user);
                $session_data = $this->session->userdata('dc_event_session');
                $this->login_model->updateLastLogin($userId);
                //remember me
                
                delete_cookie('event');
                $this->setCookie($email,$cordisianID);

                redirect('Dashboard', $this->data);
                
            } else {
                $this->session->set_flashdata('login_error', 'Invalid Email or Password');
                $logdata = array(
                    'LogDate' => date('Y-m-d h:i:s'),
                    'LogActivity' => 'Login : failed | email : ' . $email
                );
                // $this->log_model->insert_log($logdata);
                delete_cookie('event');
                redirect('Login');
            }
    }
}