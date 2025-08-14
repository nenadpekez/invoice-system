<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrgJed extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->site_title = 'DZ-RFZO';
        $this->page_title = 'Organizaciona jedinica';
    }

    public function load_template_start($page_title)
	{ 
        $this->page_title = $page_title;
        $this->load->view('template/html_start');
        $this->load->view('template/head_start', $this->data);
        $this->load->view('template/nav');
    }

    public function load_template_end()
	{ 
        $this->load->view('template/js');
        $this->load->view('template/head_end');
        $this->load->view('template/html_end');
    }

    public function index()
	{ 
        $this->items();
    }

    public function items() {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_template_start('Spisak');
            $this->data['url'] = base_url() . 'orgJed/items';
            $this->load->model('orgJed_model', 'model');  
            $this->data['data'] = $this->model->get_items();
            $this->load->view('items_view', $this->data);
            $this->load_template_end();
        } else {
            redirect(base_url());  
        }
    }

    public function activate($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load->model('orgJed_model', 'model');  
            $this->model->activate_item($id);
            redirect(base_url('orgJed/items')); 
        } else {
            redirect(base_url());  
        }
    }

    public function edit($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_template_start('Izmena');
            $this->data['url'] = base_url() . 'orgJed/item_validation';
            $this->load->model('orgJed_model', 'model');  
            $this->data['data'] = $this->model->get_item($id);
            $this->load->view('edit_view', $this->data);
            $this->load_template_end();
        } else {
            redirect(base_url());  
        }
    }

    public function delete($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_template_start('Brisanje');
            $this->data['url'] = base_url() . 'orgJed/delete_item';
            $this->load->model('orgJed_model', 'model');  
            $this->data['data'] = $this->model->get_item($id);
            $this->load->view('delete_view', $this->data);
            $this->load_template_end();
        } else {
            redirect(base_url());  
        }
    }

    public function delete_item($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load->model('orgJed_model', 'model');  
            $this->model->delete_item($id); 
            redirect(base_url() . 'orgJed/items'); 
        } else {
            redirect(base_url());  
        }
    }

    public function insert() {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_template_start('Novi unos');
            $this->data['url'] = base_url() . 'orgJed/item_validation';            
            $this->load->view('insert_view', $this->data);
            $this->load_template_end();
        } else {
            redirect(base_url());  
        }
    }

    public function item_validation($id) {

        $this->form_validation->set_rules('idOj', 'ID OJ', 'required|trim');  
        
        $this->form_validation->set_rules('naziv', 'Naziv', 'required|trim');  

        $this->form_validation->set_message('required', 'This field is required');  
  
        if ($this->form_validation->run()) {
            $this->load->model('orgJed_model', 'model');  
            if($id==0) {
                $this->model->insert_item(); 
            } else {
                $this->model->update_item($id); 
            }
            redirect(base_url() . 'orgJed/items');  
        } else {
            redirect(base_url() . 'orgJed/items'); 
        }  
    }  
  
    public function validation()  
    {  
        $this->load->model('orgJed_model', 'model');  
  
        if ($this->model->log_in_correctly()) {
            return true;  
        } else {
            //get error messages
            if($this->input->post('username') == ''){
                $message = "This field is required!";
            }
            else if($this->input->post('password') == ''){
                    $message = "";
            } else {
                $message = $this->users->check_login();
            }
            $this->form_validation->set_message('validation', $message);  
            return false;  
        }  
    }  
 
}
