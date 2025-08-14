<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    /*
    var $title   = '';
    var $content = '';
    var $date    = '';
    */

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_data($id=false)
    {
        $where_sql = '';
        if($id) $where_sql = "WHERE settings_id=".$id;
        $sql = sprintf("SELECT * FROM settings %s"
                ,$where_sql
            );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->result(),1), FILE_APPEND);
        
        return $res->result();
    }

    function update($data)
    {
        $sql = sprintf("UPDATE settings SET
                    `key`=%s
                    ,value=%s
                    ,time_changed=%s
                    ,status=%d
                WHERE setting_id=%d"
            ,$this->db->escape($data['key'])
            ,$this->db->escape($data['value'])
            ,$this->db->escape(date('Y-m-d H:i:s'))
            ,$data['status']
            ,$data['setting_id']
        );
        //file_put_contents(FCPATH . "debug.log", "\n\nSQL\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1)."\n\n", FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
    }

    function insert($data)
    {
        $sql = sprintf("INSERT INTO settings (`key`, value)
                VALUES (%s,%s)"
            ,$this->db->escape($user['key'])
            ,$this->db->escape($user['value'])
        );
        //file_put_contents(FCPATH . "debug.log", "\n\nsql\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1), FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        
        return true;
    }



    function insert_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}