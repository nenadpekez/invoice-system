<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public $site_title = '';
	public $page_title = '';
	public $app_title = '';
	public $logo_url = '';
	public $data = '';
	public $session;
	public $load;

    function __construct() {

        parent::__construct();
        $this->site_title 	= SITE_TITLE;
        $this->page_title 	= MAIN_TITLE;
        $this->app_title 	= APP_TITLE;
        $this->logo_url 	= base_url() . LOGO_URL;

		$this->data['start_tpl'] = $this->load_template_start();
		$this->data['end_tpl'] = $this->load_template_end();
		$this->data['user'] = $this->session->userdata('user');
	}
	
	public function load_template_debug()
	{
		return $this->load->view('template/debug_view', $this->data, TRUE);
	}

    public function load_template_start($page_title = 'HOME')
	{ 
        $this->page_title = $page_title;
        return	$this->load->view('template/html_start', '', TRUE)
        		.$this->load->view('template/head_start', '', TRUE)
        		.$this->load->view('template/nav', '', TRUE);
        
    }

    public function load_template_end()
	{ 
        return 	$this->load->view('template/footer', '', TRUE)
        		.$this->load->view('template/js', $this->data, TRUE)
				.$this->load->view('template/head_end', '', TRUE)
				.$this->load->view('template/html_end', '', TRUE);
	}

	public function load_form_data($tmp){
		#get data for form
		$this->load->model('data_model', 'data_model');  
		#function getData(@formname, array of elements) retrive all data for form from db
		return $this->data_model->getData($tmp, array('forms', 'inputs', 'buttons'));
	}

	public function index()
	{
		if ($this->session->userdata('user_logged_in'))
		{
            $this->load->view('main_view', $this->data);
        } else {
            redirect(base_url('login'));
        }
	}

	public function load($page = '')
	{
		if ($this->session->userdata('user_logged_in'))
		{
			//file_put_contents(FCPATH . "debug.log", "--- DATA ---\n", FILE_APPEND);
			$param = $_GET;
			if(isset($param['form_name'])){
				$this->data['param'] = $param;
				$this->data['forms'] = $this->load_form_data($this->data['param']['form_name']);
			} else {
				$this->data['param'] = FALSE;
			}

			$this->data['page'] = $page;
			$this->data['debug_tpl'] = $this->load_template_debug();
			$this->data['user'] = $this->session->userdata('user');

			switch($page)
			{
				case 'main':
				$this->main_view();   
				break;

				case 'help':
				$this->help_view();   
				break;

				case 'test':
				$this->test_view();
				break;

				default:
				$this->main_view();
			}
        } else {
            redirect(base_url('login'));
        }
        
	}
	
    public function main_view()
	{
        if ($this->session->userdata('user_logged_in')) {
            $this->load->view('main_view', $this->data);
        } else {
            redirect(base_url('login'));
        }
        
	}
	
	public function help_view()
	{
        if ($this->session->userdata('user_logged_in')) {
            $this->load->view('help_view', $this->data);
        } else {
            redirect(base_url('login'));
        }
        
    }

	public function profile($uid)
	{
        if ($this->session->userdata('user_logged_in') && $uid) {
			$this->load->model('users_model', 'users');  
			$this->data['user_data'] = $this->users->get_user($uid);
            $this->load->view('profile_view', $this->data);
        } else {
            redirect(base_url('login'));
        }
        
    }

	public function test_view()
	{
		
        if ($this->session->userdata('user_logged_in')) {
            $this->load->view('test_view', $this->data);
        } else {
            redirect(base_url('login'));
        }
        
    }

}