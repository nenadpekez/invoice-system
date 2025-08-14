<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institution_model extends CI_Model {
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
    
    function get_data()
    {
        $sql = sprintf("SELECT * FROM idr_institution i"
        );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result\n".print_r($res->result(),1), FILE_APPEND);
        return $res->result();
    }

    /**
     * method get data for form 
     * @form = name of form (controler)
     * @id = id of row in db
     * return array(
     *   form => form params object
     *   fields => form fields data array of objects
     *   option => option data for field array of objects
     *   value => value for fields object
     * )
     */
    function get_form_data($form=false, $id=false)
    {
        //data to return
        $ret = array(
            'form' => null
            ,'fields' => null
            ,'options' => null
            ,'values' => null
        );
        
        //GET FORM
        $sql = sprintf("SELECT * FROM idr_forms WHERE form_name=%s LIMIT 1"
                ,$this->db->escape($form)
            );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
        if($res->num_rows()) $ret['form'] = $res->row();

        //GET FORM_FIELDS
        $sql = sprintf("SELECT * FROM idr_form_fields WHERE form_id=%d ORDER BY position"
                ,$ret['form']->id
            );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        $ret['fields'] = $res->result();
        //file_put_contents(FCPATH . "debug.log", "--- ret['fields'] \n file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($ret['fields'],1), FILE_APPEND);

        //GET FIELD OPTIONS
        foreach ($ret['fields'] as $key => $val) {
            $sql = sprintf("SELECT * FROM idr_field_options WHERE field_id=%d"
                    ,$val->id
                );
            $res = $this->db->query($sql);
            if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
                file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
                return false;
            }
            //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
            $ret['options'][] = $res->row();
        }

        //GET FIELD VALUES
        if($id) {
            $values = new stdClass();
            foreach ($ret['fields'] as /*$vkey =>*/ $vobj) {
                $sql = sprintf("SELECT %s FROM idr_%s WHERE %s_id=%s"
                        ,$vobj->field_name
                        ,$form
                        ,$form
                        ,$id
                    );
                $res = $this->db->query($sql);
                if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
                    file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
                    return false;
                }
                //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
                //$field_value = $res->row();
                $field_value = $res->result_array()[0];
                $ff = (String)$vobj->field_name;
                $values->$ff = $field_value[$vobj->field_name];
            }
            $ret['values'] = $values;
        }

        return $ret;
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
                    ,CONCAT(ud.firstname, ' ', ud.lastname) as user
                FROM idr_users u
                LEFT JOIN idr_users_data ud ON ud.user_id = u.user_id
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

    function get_id_by_uid($uid=0)
    {
        $sql = sprintf("SELECT 
                    institution_id as institution_id
                FROM idr_institution
                WHERE MD5(uid)=%s"
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
        
        return $row->institution_id;
    }

    function update($data)
    {
        
        $id = $this->get_id_by_uid($data['uid']);
        if(!$id) {
            file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n"."check user uid returned FALSE", FILE_APPEND);
            return false;
        }
        //update
        $sql = sprintf("UPDATE institution SET
                    `name`=%s
                    ,street=%s
                    ,city=%s
                    ,`state`=%s
                    ,taxnum=%s
                    ,matical=%s
                    ,phone=%s
                    ,email=%s
                    ,website=%s
                    ,fax=%s
                    ,time_changed=%s
                WHERE institution_id=%d"
            ,$this->db->escape($data['name'])
            ,$this->db->escape($data['street'])
            ,$this->db->escape($data['city'])
            ,$this->db->escape($data['state'])
            ,$this->db->escape($data['taxnum'])
            ,$this->db->escape($data['matical'])
            ,$this->db->escape($data['phone'])
            ,$this->db->escape($data['email'])
            ,$this->db->escape($data['website'])
            ,$this->db->escape($data['fax'])
            ,$this->db->escape(date('Y-m-d H:i:s'))
            ,$id
        );
        $res = $this->db->query($sql);
        if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
            file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
            return false;
        }
        
        return true;
    }

    function insert_user($user)
    {
        //$this->db->where('user_id', $id);
        //$query = $this->db->get('users');
        $sql = sprintf("INSERT INTO users 
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

        $sql = sprintf("INSERT INTO users_data
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