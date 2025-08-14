<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public $usr;

    function __construct() {

        parent::__construct();
        $this->site_title 	= SITE_TITLE;
        $this->page_title 	= LOGIN_TITLE;
        $this->app_title 	= APP_TITLE;
        $this->logo_url 	= base_url() . LOGO_URL;
        $this->usr = null;
		//file_put_contents(FCPATH . "debug.log", "tttttest", FILE_APPEND);
    }

    public function load_template_start($page_title=false)
	{ 
        if($page_title) $this->page_title = $page_title;
        $this->load->view('template/html_start');
        $this->load->view('template/head_start');
        
    }

    public function load_template_end()
	{ 
        $this->load->view('template/js');
        $this->load->view('template/head_end');
        $this->load->view('template/html_end');
    }

    public function index()
	{ 
        $this->login();
    }

    public function login() {
        if (!$this->session->userdata('user_logged_in')) {
            $this->load_template_start();
            $this->url = base_url() . get_class($this) . '/login_validation';
            $this->load->view('login_view', $this);
            $this->load_template_end();
        } else {
            redirect(base_url('main'));  
        }
    }
    
    public function login_validation() {

        $this->form_validation->set_rules('username', 'username', 'required|trim|callback_validation');
        
        $this->form_validation->set_rules('password', 'password', 'required|trim|callback_validation');

        $this->form_validation->set_message('required', 'Ovaj podatak je obavezan!');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run()) {
            $data = array(  
                'username'          => $this->input->post('username'),  
                'user'              => $this->usr->user, 
                'title'             => $this->usr->title.' ', 
                'user_id'           => $this->usr->user_id, 
                'user_uid'          => $this->usr->user_uid,
                'level'             => $this->usr->level,
                'status'            => $this->usr->status,
                'user_logged_in'    => 1  
                );    
            //file_put_contents(FCPATH . "debug.log", print_r($data,1), FILE_APPEND);
            $this->session->set_userdata($data);  
            redirect(base_url() . 'main');  
        } else {
            //file_put_contents(FCPATH . "debug.log", print_r($this,1), FILE_APPEND);
            $this->load_template_start();
            $this->url = base_url() . get_class($this) . '/login_validation';
            $this->load->view('login_view', $this);
            $this->load_template_end();
        }  
    }  
  
    public function validation()  
    {  
        $this->load->model('users_model', 'users_model');  
  
        //if ($this->users->log_in_correctly()) {
        $this->usr = $this->users_model->log_in_correctly();
        file_put_contents(FCPATH . "debug.log", "--- USERS usr ---\n".print_r($this->usr,1), FILE_APPEND);
        if ($this->usr){
            //file_put_contents(FCPATH . "debug.log", "--- USERS usr ---\n".print_r($this->usr,1), FILE_APPEND);
            if ($this->usr->status == 1) {
                file_put_contents(FCPATH . "debug.log", "--- USERS usr OK ---\n", FILE_APPEND);
                return true;
            } else if ($this->usr->status == 0) {
                file_put_contents(FCPATH . "debug.log", "--- USERS usr NOT OK ---\n", FILE_APPEND);
                $this->form_validation->set_message('validation', 'Vas nalog nije aktivan!');
                return false;
            }
        } else {
            //get error messages
            if($this->input->post('username') == ''){
                $message = "Ovaj podatak je obavezan!";
            }
            else if($this->input->post('password') == ''){
                    $message = "Ovaj podatak je obavezan";
            } else {
                $message = $this->users_model->check_login();
            }
            $this->form_validation->set_message('validation', $message);  
            return false;  
        }  
    }  
  
    public function logout()  
    {  
        $this->session->sess_destroy();  
        redirect(base_url());  
    } 
}