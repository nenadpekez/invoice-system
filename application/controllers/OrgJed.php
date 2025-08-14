<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OrgJed extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->site_title = 'DZ-RFZO'; //title
        $this->page_title = 'Organizaciona jedinica'; //title add
        $this->controler = get_class($this); //path for controler
        $this->menu = 'jobs'; //path for menu from database
        $this->url = base_url() . $this->controler; //path for forms or links
    }

    public function load_htmltemplate_start($page_title) { 
        $this->page_title = $page_title;
        $this->load->view('template/html_start');
        $this->load->view('template/head_start');
        $this->load->view('template/nav');
    }

    public function load_htmltemplate_end()
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
            $this->load_htmltemplate_start('Spisak');
            $this->load->model($this->controler . '_model', 'model');  
            $this->data['data'] = $this->model->get_items();
            //$this->load->view('items_view', $this);
            $this->ajax();
            $this->load_htmltemplate_end();
        } else {
            redirect(base_url());  
        }
    }

    public function ajax() {
        if ($this->session->userdata('user_logged_in')) {

            //$this->load_htmltemplate_start('Spisak');

            if(isset($_POST['page_num'])) {
                $this->pagination['page_num']=$_POST['page_num'];
            } else { $this->pagination['page_num']=1; }

            if(isset($_POST['search'])) {
                $this->pagination['search']=$_POST['search'];
            } else { $this->pagination['search']=''; }

            $this->load->model($this->controler . '_model', 'model');  

            $total=$this->model->get_all_items($this->pagination['search']);
            $this->pagination['total']=count($total);
            $this->pagination['data_per_page']=10;
            $this->pagination['last_page']=ceil($this->pagination['total']/$this->pagination['data_per_page']);

            $this->pagination['pagination'] = $this->load->view('pagination_view', NULL, True);
            $this->data['data'] = $this->model->search($this->pagination['search'], $this->pagination['page_num']);
            //$this->load->model('model_menu');
            //$this->pagination['side_menu'] = $this->model_menu->side_menu('sifarnici');
            //$this->pagination['sifarnici'] = $this->load->view('partials/sifarnici', $this->pagination['side_menu'], True);
            //$this->load->view('pages/s_placanja/data', $this->pagination);

            $this->load->view('data_view', $this);

            //$this->load_htmltemplate_end();
        } else {
            redirect(base_url());  
        }
    }

    
    
    

    

    public function activate($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load->model($this->controler . '_model', 'model');  
            $this->model->activate_item($id);
            redirect($this->url . '/items'); 
        } else {
            redirect(base_url());  
        }
    }

    public function edit($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_htmltemplate_start('Izmena');
            $this->data['url'] = $this->url . '/item_validation';
            $this->load->model($this->controler . '_model', 'model');  
            $this->data['data'] = $this->model->get_item($id);
            $this->load->view('edit_view', $this->data);
            $this->load_htmltemplate_end();
        } else {
            redirect(base_url());  
        }
    }

    public function delete($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_htmltemplate_start('Brisanje');
            $this->data['url'] = $this->url . '/delete_item';
            $this->load->model($this->controler . '_model', 'model');  
            $this->data['data'] = $this->model->get_item($id);
            $this->load->view('delete_view', $this->data);
            $this->load_htmltemplate_end();
        } else {
            redirect(base_url());  
        }
    }

    public function delete_item($id) {
        if ($this->session->userdata('user_logged_in')) {
            $this->load->model($this->controler . '_model', 'model');  
            $this->model->delete_item($id); 
            redirect(base_url() . $this->controler. '/items'); 
        } else {
            redirect(base_url());  
        }
    }

    public function insert() {
        if ($this->session->userdata('user_logged_in')) {
            $this->load_htmltemplate_start('Novi unos');
            $this->data['url'] = $this->url . '/item_validation';
            $this->load->model($this->controler . '_model', 'model');
            $this->load->view('insert_view', $this->data);
            $this->load_htmltemplate_end();
        } else {
            redirect(base_url());  
        }
    }

    public function item_validation($id) {

        $this->form_validation->set_rules('idOj', 'ID OJ', 'required|trim');  
        
        $this->form_validation->set_rules('naziv', 'Naziv', 'required|trim');  

        $this->form_validation->set_message('required', 'This field is required');  
  
        if ($this->form_validation->run()) {
            $this->load->model($this->controler . '_model', 'model');
            if($id==0) {
                $this->model->insert_item(); 
            } else {
                $this->model->update_item($id); 
            }
            redirect(base_url() . $this->controler . '/items');  
        } else {
            redirect(base_url() . $this->controler . '/items'); 
        }  
    }  
  
    public function validation()  
    {  
        $this->load->model($this->controler . '_model', 'model');
  
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
