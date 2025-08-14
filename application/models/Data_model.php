<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {
    
    public  $ret = array();     # @ret is to return collected data from db to controler

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
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
        $sql = sprintf("SELECT * FROM forms WHERE form_name=%s LIMIT 1"
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
        $sql = sprintf("SELECT * FROM form_fields WHERE form_id=%d ORDER BY position"
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
            $sql = sprintf("SELECT * FROM field_options WHERE field_id=%d"
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
        if($id && in_array($form, array(0=>'institution'))) {
            $values = new stdClass();
            foreach ($ret['fields'] as /*$vkey =>*/ $vobj) {
                $sql = sprintf("SELECT %s FROM %s WHERE %s_id=%s"
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

        //GET EXTRA PARAMS
        foreach ($ret['fields'] as $vkey => $vobj) {
            $ff = (String)$vobj->field_name;
            $obj_option = null;
            if($vobj->params) {
                /**
                 * excpected array of objects
                 * obj->table  -- from wich table
                 * obj->field_id  -- what is field id value
                 * obj->field_name -- option label
                 */
                $params = json_decode($vobj->params);
                
                $sql = sprintf("SELECT * FROM %s ORDER BY %s"
                        ,$params->table
                        ,$params->field_id
                    );
                $res = $this->db->query($sql);
                if(is_array($res) && isset($res['code']) && $res['code'] != 0) {
                    file_put_contents(FCPATH . "debug.log", "\n\nREPORTING DB ERROR\n --- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res,1)."\n\n", FILE_APPEND);
                    return false;
                }
                //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n".print_r($res->row(),1), FILE_APPEND);
                //$field_value = $res->row();
                
                $res_options = $res->result();
                foreach ($res_options as $oval) {
                    $pn = $params->field_name;
                    $pv = $params->field_id;
                    $obj_option = new stdClass();
                    $obj_option->name =$oval->$pn;
                    $obj_option->value =$oval->$pv;
                    $ret['options'][$vkey][]=$obj_option;
                }
            }
            
        }


        return $ret;
    }


    
    
    function getNavigationData()
    {
		if($this->checkTableName('main_menu')) {
			$this->db->where('active', true);
			$this->db->where('id_parent', '0');
			$query = $this->db->get('main_menu');
			$data = $query->result_array();
			foreach( $data as $row){
				$this->db->where('active', true);
				$this->db->where('id_parent', $row['id']);
				$query = $this->db->get('main_menu');
				if($query->num_rows()>0){
					$item = $query->result_array();
					$row['child'] = $item;
				}
				$ret[$row['align']][] = $row;
			}
			return $ret;
		}
		return false;

    }

    function getData($unique_form_name, $tables)
    {
        if(!is_array($unique_form_name)) $unique_form_name_array = array($unique_form_name);

        $field = 'form_name';
        foreach($unique_form_name_array as $form)
        {
            foreach($tables as $table_name)
            {
                #check if table exists in db
                if($this->checkTableName($table_name))
                    #if exist then try to get data
                    $this->ret[$form][$table_name] = $this->getFormData($table_name, $field, $form);
            }
        }
        return $this->ret;
    }

    function checkTableName($table_name)
    {
        $databasename = $this->db->database;
        $query = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_schema = '$databasename' AND table_name = '$table_name';");
        return ($query->num_rows() > 0)?true:false;

    }

    function getFormData($table_name, $field, $unique_form_name)
    {
        $fields = $this->getFieldAlias($table_name);

        $this->db->select($fields);
        $this->db->where($field, $unique_form_name);
        $this->db->where('active', true);
        $query = $this->db->get($table_name);

        return $query->result_array();
    }

    function getFieldAlias($table_name)
    {
        $this->db->where('table_name', $table_name);
        $query = $this->db->get('field_alias');
        
        $result = '';
        foreach($query->result_array() as $row)
        {
            $result .= $row['field'].' as '.$row['alias'].',';
        }

        return substr($result,0,-1);
    }

    

    

    function log_in_correctly() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('user_username', $username);
        $this->db->where('user_password', $password);

        $query = $this->db->get('users');
        
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
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