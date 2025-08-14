<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->site_title 	= SITE_TITLE;
        $this->page_title 	= REGISTER_TITLE;
        $this->app_title 	= APP_TITLE;
        $this->logo_url 	= base_url() . LOGO_URL;
    }

    public function load_template_start($page_title=false)
	{ 
        if ($page_title) $this->page_title = $page_title;
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
        $this->register();
    }

    public function register() {
        if (!$this->session->userdata('user_logged_in')) {
            $this->load_template_start('');
            $this->url = base_url() . get_class($this) . '/register/success/1';
            $this->load->view('register_view');
            $this->load_template_end();
        } else {
            redirect(base_url('main'));  
        }
    }
    
    public function register_validation() {  

        $this->load->library('form_validation');  

        $this->form_validation->set_rules('firstname', 'Firstname', 'required|trim');  

        $this->form_validation->set_rules('lastname', 'Lastname', 'required|trim');  

        $this->form_validation->set_rules('email', 'E-mail', 'required|trim');  
  
        $this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|is_unique[users.user_username]');
  
        $this->form_validation->set_rules('password', 'Password', 'required|trim');  
  
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');  

        $this->form_validation->set_message('required', 'Ovaj podatak je obavezan!');  
  
        $this->form_validation->set_message('is_unique', 'This username already exists');  
        
        $this->form_validation->set_message('matches', 'Passwords not match!');  
  
        if ($this->form_validation->run()) {
            echo "You are been register. Wait to administrator aprove your account!";  
            $this->load->model('users_model', 'users'); 
            if($this->users->insert_user($_POST)) {
                //send email na user mail with activation link
                redirect(base_url('register/success/1')); 
            } else {
                //echo "You are been register. Wait to administrator aprove your account!";  
                redirect(base_url('register/error/1'));
            }
         } else {
            $this->load_template_start('');
            //$this->url = base_url() . get_class($this) . '/register_validation';
            $this->url = base_url() . get_class($this) . '/register';
            $this->load->view('register_view', $this);
            $this->load_template_end();
        }
    } 
    
    public function success($success) {
        if($success) {
            $this->load_template_start('');
            $this->url = base_url() . get_class($this) . '/register/success/1';
            $this->load->view('register_success_view');
            $this->load_template_end();
        }
    }

    public function error($error) {
        if($error) {
            $this->load_template_start('');
            $this->url = base_url() . get_class($this) . '/register/error/1';
            $this->load->view('register_error_view');
            $this->load_template_end();
        }
    }

    public function logout()  
    {  
        $this->session->sess_destroy();  
        redirect(base_url());  
    } 
}