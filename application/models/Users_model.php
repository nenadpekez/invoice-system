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
    
    function get_users()
    {
        $sql = sprintf("SELECT 
                u.user_id as user_id
                ,u.user_uid as user_uid
                ,u.user_username as username
                ,u.user_level as level
                ,u.time_created as time_created
                ,u.time_changed as time_changed
                ,u.user_status as status
                ,ud.user_data_id as user_data_id
                ,ud.title as title
                ,ud.firstname as firstname
                ,ud.lastname as lastname
                ,ud.email as email
                ,ud.faksimil as faksimil
                ,ud.job as job
                ,ud.department_id as department_id
                ,department_name as department_name
                ,d.title as department_title
                ,d.location as department_location
                ,CONCAT(ud.firstname, ' ', ud.lastname) as user
            FROM idr_users u
            LEFT JOIN idr_users_data ud ON ud.user_id = u.user_id
            LEFT JOIN idr_departments d ON d.department_id = ud.department_id"
        );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result\n".print_r($res->result(),1), FILE_APPEND);
        return $res->result();
    }

    function get_user($id=0)
    {
        //$this->db->where('user_id', $id);
        //$query = $this->db->get('users');
        $sql = sprintf("SELECT 
                    u.user_id as user_id
                    ,u.user_uid as user_uid
                    ,u.user_username as username
                    ,u.user_level as `level`
                    ,u.time_created as time_created
                    ,u.time_changed as time_changed
                    ,u.user_status as status
                    ,ud.user_data_id as user_data_id
                    ,IFNULL(ud.title, '') as title
                    ,ud.firstname as firstname
                    ,ud.lastname as lastname
                    ,ud.email as email
                    ,ud.faksimil as faksimil
                    ,ud.job as job
                    ,ud.department_id as department_id
                    ,department_name as department_name
                    ,d.title as department_title
                    ,d.location as department_location
                    ,CONCAT(ud.firstname, ' ', ud.lastname) as user
                FROM idr_users u
                LEFT JOIN idr_users_data ud ON ud.user_id = u.user_id
                LEFT JOIN idr_departments d ON d.department_id = ud.department_id
                WHERE u.user_uid=%s"
                ,$this->db->escape($id)
            );
        file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1)."\n\n", FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
        return $res->row();
    }

    function _get_user($id=0)
    {
        //$this->db->where('user_id', $id);
        //$query = $this->db->get('users');
        $sql = sprintf("SELECT 
                    u.user_id as user_id
                    ,u.user_uid as user_uid
                    ,u.user_username as user_username
                    ,'' as user_password
                    ,u.user_level as `user_level`
                    ,u.time_created as time_created
                    ,u.time_changed as time_changed
                    ,u.user_status as user_status
                    ,ud.user_data_id as user_data_id
                    ,IFNULL(ud.title, '') as title
                    ,ud.firstname as firstname
                    ,ud.lastname as lastname
                    ,ud.email as email
                    ,ud.faksimil as faksimil
                    ,ud.job as job
                    ,ud.department_id as department_id
                    ,department_name as department_name
                    ,d.title as department_title
                    ,d.location as department_location
                    ,CONCAT(ud.firstname, ' ', ud.lastname) as user
                FROM idr_users u
                LEFT JOIN idr_users_data ud ON ud.user_id = u.user_id
                LEFT JOIN idr_departments d ON d.department_id = ud.department_id
                WHERE u.user_uid=%s"
                ,$this->db->escape($id)
            );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
        return $res->row();
    }

    function get_user_id_by_uid($uid=0)
    {
        $sql = sprintf("SELECT 
                    user_id as user_id
                FROM idr_users
                WHERE MD5(user_uid)=%s"
                ,$this->db->escape($uid)
            );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
        $row = $res->row();
        if ($res->num_rows() == 0) {
            return false;
        }
        
        return $row->user_id;
    }

    function update_user($user)
    {
        /*
        if (!$this->check_login()) {
            file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n"."check_login return true", FILE_APPEND);
            return false;
        }
        */
        $user_id = $this->get_user_id_by_uid($user['user_uid']);
        if(!$user_id) {
            file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n"."check user uid returned FALSE", FILE_APPEND);
            return false;
        }
        //update user
        $sql = sprintf("UPDATE idr_users SET
                    user_username=%s
                    ,user_level=%s
                    ,time_changed=%s
                    ,user_status=%d
                WHERE user_id=%d"
            ,$this->db->escape($user['user_username'])
            ,$this->db->escape($user['user_level'])
            ,$this->db->escape(date('Y-m-d H:i:s'))
            ,$user['user_status']
            ,$user['user_id']
        );
        file_put_contents(FCPATH . "debug.log", "\n\nSQL\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1)."\n\n", FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        if(isset($user['user_password']) && $user['user_password'] != '') {
            $sql = sprintf("UPDATE idr_users SET
                        user_password=%s
                    WHERE user_id=%d"
                ,$this->db->escape(md5($user['user_password']))
                ,$user_id
            );
            $res = $this->db->query($sql);
        }

        $sql = sprintf("UPDATE idr_users_data SET
                    title=%s
                    ,firstname=%s
                    ,lastname=%s
                    ,email=%s
                    ,faksimil=%s
                    ,job=%s
                    ,department_id=%d
                WHERE user_id=%d"
            ,$this->db->escape($user['title'])
            ,$this->db->escape($user['firstname'])
            ,$this->db->escape($user['lastname'])
            ,$this->db->escape($user['email'])
            ,$this->db->escape($user['faksimil'])
            ,$this->db->escape($user['job'])
            ,$user['department_id']
            ,$user['user_id']
        );
        //file_put_contents(FCPATH . "debug.log", "\n\nSQL\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1)."\n\n", FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            //file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
        return true;
    }

    function insert_user($user)
    {
        //$this->db->where('user_id', $id);
        //$query = $this->db->get('users');
        $sql = sprintf("INSERT INTO idr_users 
                    (user_uid
                    ,user_username
                    ,user_password
                    ,user_level
                    ,user_status)
                VALUES (%s,%s,%s,%d,2)"
            ,$this->db->escape(md5($user['username'] . '|' . $user['password'] . DB_SALT . time()))
            ,$this->db->escape($user['username'])
            ,$this->db->escape(md5($user['password']))
            ,($user['level']) ? $user['level'] : 0
        );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($this->db->error(),1), FILE_APPEND);
            return false;
        }
        $last_id = $this->db->insert_id(); 

        $sql = sprintf("INSERT INTO idr_users_data
                    (user_id
                    ,title
                    ,firstname
                    ,lastname
                    ,email)
                VALUES (%d,%s,%s,%s,%s)"
            ,$last_id
            ,($user['title']) ? $this->db->escape($user['title']) : 'null'
            ,$this->db->escape($user['firstname'])
            ,$this->db->escape($user['lastname'])
            ,$this->db->escape($user['email'])
        );
        //file_put_contents(FCPATH . "debug.log", "\n\nsql\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($sql,1), FILE_APPEND);
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        
        return true;
    }

    function log_in_correctly() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('user_username', $username);
        $this->db->where('user_password', md5($password));

        $res = $this->db->get('idr_users');
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            //file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        if ($res->num_rows() == 1) {
            $tmp = $res->row();
            //file_put_contents(FCPATH . "debug.log", "--- USERS tmp ---\n".print_r($tmp,1), FILE_APPEND);
            //return true;
            return $this->get_user($tmp->user_uid);
        } else {
            return false;
        }

    }

    function check_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('user_username', $username);
        $this->db->where('user_password', md5($password));

        $res = $this->db->get('idr_users');
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        if ($res->num_rows() == 1) {
            return true;
        } else {
            return "Podaci koje ste uneli nisu korektni!";
        }

    }


    /**
     * method check if username exist in db, for inserting a new user
     */
    function check_username() {
        $username = $this->input->post('username');
        $this->db->where('user_username', $username);
        $res = $this->db->get('idr_users');     
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        if ($res->num_rows() > 0) {
            return false;
        } else {
            return true;
        }

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