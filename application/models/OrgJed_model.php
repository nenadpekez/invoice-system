<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrgJed_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_items()
    {
        $query = $this->db->get('orgjed');
        return $query->result();
    }

    function get_items_ajax()
    {
        $query = $this->db->get('orgjed');
        return $query->result();
    }

    public function search($search, $page_num) {
		
		if($search!='') { 
			$this-> db->like('naziv', $search, 'after' );
			$this-> db->or_like('idOj', $search, 'after' );
		}
		
		if($page_num>0) {
			$this->db->limit(10, ($page_num-1)*10);
		}

		$this-> db->select('*');
		$this-> db->from('orgjed');
		
		$this-> db->order_by('naziv');
		$query = $this->db->get();

		if($query){
			return $result = $query->result();
		} else {
			return false;
		}
	}

    function get_all_items($search)
    {
        if($search!='') { 
            $this-> db->like('naziv', $search, 'after' );
            $this-> db->or_like('idOj', $search, 'after' );
		}
        $query = $this->db->get('orgjed');
        return $query->result();
    }

    function get_item($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('orgjed');
        
        return $query->result();
    }

    function insert_item() {
        $this->idOj     = $this->input->post('idOj');
        $this->naziv    = $this->input->post('naziv');

        $this->db->insert('orgjed', $this);
    }

    function update_item($id) {
        $this->idOj     = $this->input->post('idOj');
        $this->naziv    = $this->input->post('naziv');

        $this->db->update('orgjed', $this, array('id' => $id ));
    }

    function activate_item($id) {
        $this->db->set('active', 'ABS((active MOD 2) - 1)', FALSE);
        $this->db->where('id', $id);
        $this->db->update('orgjed');
        //echo $this->db->last_query();
    }

    function delete_item($id) {
        
        $this->db->delete('orgjed', array('id' => $id ));
    }

}