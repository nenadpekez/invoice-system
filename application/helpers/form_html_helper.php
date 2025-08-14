<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generateFormUser'))
{
    /**
     * method generate form for users_view.php
     * @data array of user Object
     * return String html
     */
	function generateFormUser($data=null)
	{
		$ci = &get_instance();

        $res = '<form method="POST" action="'. base_url() . 'users/update" id="userUpdate" class="needs-validation" novalidate="">';
		//file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($data,1), FILE_APPEND);
    
        $tr_class = '';
        $action = '<a href="'.base_url() . 'users/edit/' . $data->user_uid. '" bclass="btn btn-sm btn-outline-primary" title="Podešavanje korisničkih parametara"><i class="fas fa-cog"></i></a>';

        switch((int)$data->status){
                case 
                    0: $status = 'Neaktivan';
                    $status_class = 'text-danger';
                break;
                case
                    1: $status = 'Aktivan';
                    $status_class = 'text-success';
                break;
                default: 
                    $status = 'NOVO';
                    $status_class = 'text-default';
                    $tr_class = 'font-weight-bold text-danger';
                break;
        }
        
        $res .= '<input type="hidden" name="user_uid" value="'.md5($data->user_uid).'">';

        $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="firstname">Ime</label>
            <div class="col-sm-8">
                <input id="firstname" type="text"
                    class="form-control form-control-sm" name="firstname" tabindex="1" placeholder="Unesite ime" required autofocus value="'.$data->firstname.'">
                <div class="invalid-feedback">Please fill in your firstname</div>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="lastname">Prezime</label>
            <div class="col-sm-8">
                <input id="lastname" type="text"
                    class="form-control form-control-sm" name="lastname" tabindex="1" placeholder="Unesite prezime" required autofocus value="'.$data->lastname.'">
                <div class="invalid-feedback">Please fill in your lastname</div>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="email">E-mail</label>
            <div class="col-sm-8">
                <input id="email" type="email"
                    class="form-control form-control-sm" name="email" tabindex="1" placeholder="Unesite e-mail" required autofocus value="'.$data->email.'">
                <div class="invalid-feedback">Please fill in your email</div>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="username">Korisničko ime</label>
            <div class="col-sm-8">
                <input id="username" type="text"
                    class="form-control form-control-sm" name="username" tabindex="1" placeholder="Unesite korisnicko ime" required autofocus value="'.$data->username.'">
                <div class="invalid-feedback">Please fill in your username</div>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="password">Lozinka</label>
            <div class="col-sm-8">
                <input id="password" type="password"
                    class="form-control form-control-sm" name="password"
                    tabindex="2" placeholder="Lozinka" >
                <div class="invalid-feedback">Please fill in your password</div>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="title">Titula</label>
            <div class="col-sm-8">
                <input id="title" type="text"
                    class="form-control form-control-sm" name="title" tabindex="1" placeholder="Unesite titulu" autofocus value="'.$data->title.'">
                <div class="invalid-feedback">Please fill in your title</div>
            </div>
        </div>
        ';


        if($ci->session->userdata('level') < 2) {
            $res .= '
            <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="level">Nivo pristupa</label>
            <div class="col-sm-8">
                <select class="custom-select" id="level" name="level">
                    ';
                    if($ci->session->userdata('level') == 0) {
                        $res .= '<option value="0" '.(($data->level==0)?'selected="selected"':'').'>Bog</option>';
                    }
                    $res .= '<option value="1" '.(($data->level==1)?'selected="selected"':'').'>Administrator</option>
                    <option value="2" '.(($data->level==2)?'selected="selected"':'').'>Korisnik</option>
                </select>
            </div>
        </div>
        ';

            $res .= '
        <div class="form-group row">
            <label class="col-sm-4 col-form-label control-label"
                for="status">Status naloga</label>
            <div class="col-sm-8">
                <select class="custom-select" id="status" name="status">
                <option value="0" '.(($data->status==0)?'selected="selected"':'').'>Neaktivno</option>
                    <option value="1" '.(($data->status==1)?'selected="selected"':'').'>Aktivno</option>
                </select>
            </div>
        </div>
        ';
        }

    $res .= '<div class="form-group">
        <button type="submit" id="btnSubmit" class="btn btn-block btn-outline-primary" tabindex="3">SAČUVAJ PODATKE</button>
    </div>';
    $res .= '</form>';

    //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($res,1), FILE_APPEND);
    return $res;
    }
}

if ( ! function_exists('generateForm'))
{
    /**
     * method generate form for given data
     * @data array{
     *   form => form params object
     *   fields => form fields data array of objects
     *   options => option data for field array of objects
     *   value => value for fields object
     * }
     * return String html
     */
	function generateForm($data=false)
	{
        if(!$data) return false;

		$ci = &get_instance();
        $controller = $ci->router->fetch_class();
        $method = $ci->router->fetch_method();
        file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n data for process\n".print_r($data,1), FILE_APPEND);

        $form = $data['form'];
        $fields = $data['fields'];
        $options = $data['options'];
        $values = $data['values'];

        $html ='';        

        $INPUTS_HTML = inputTag($fields, $options, $values);
        $FORM_HTML = formTag($form, $INPUTS_HTML, count($fields));

        $html = $FORM_HTML;
        
        return $html;

    }

}

/**
 * method generate form tag
 * @data object
 * @INPUTS_HTML string for replace
 * return html string
 */
function formTag($data, $INPUTS_HTML, $pos) {
    $str = '<form action="##ACTION##" method="##METHOD##" id="##FORM_ID##" class="##CLASS##">##INPUTS##'."\n".'##SUBMIT##'."\n".'</form>'."\n\t";
    $r = array(
        "##ACTION##"
        ,"##METHOD##"
        ,"##FORM_ID##"
        ,"##CLASS##"
        ,"##INPUTS##"
        ,"##SUBMIT##"
    );
    $rr = array(
        $data->form_action
        ,$data->form_method
        ,$data->form_id
        ,$data->form_class
        ,$INPUTS_HTML
        ,'<div class="form-group">
        <button type="submit" id="btnSubmit" class="btn btn-block btn-outline-primary" tabindex="'.$pos.'" onclick="return confirm(\'Da li ste sigurni?\');">SAČUVAJ PODATKE</button>
    </div>'
    );
    $ret = str_replace($r, $rr, $str);
    return $ret;
}

/**
 * method generate input tag
 * @fields array of objects
 * @options array of objects
 * @values object
 * return html string
 */
function inputTag($fields, $options, $values) {
    $ret = '';
    $html_options = '';
    foreach ($fields as $key => $val) {
        switch($val->field_type) {
            case 'option':
                $str = '
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label control-label"
                        for="##FIELD_NAME##">##FIELD_LABEL##</label>
                    <div class="col-sm-8">
                            <select id="##FIELD_ID##" 
                                type="##FIELD_TYPE##" 
                                class="##FIELD_CLASS##" 
                                name="##FIELD_NAME##" 
                                tabindex="##POSITION##" 
                            >
                            ##OPTIONS##
                            </select>
                        ##INVALID_FEEDBACK##
                    </div>
                </div>
                ';
                break;
            default:
                $str = '
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label control-label"
                        for="##FIELD_NAME##">##FIELD_LABEL##</label>
                    <div class="col-sm-8">
                        <input  id="##FIELD_ID##" 
                                type="##FIELD_TYPE##" 
                                class="##FIELD_CLASS##" 
                                name="##FIELD_NAME##" 
                                tabindex="##POSITION##" 
                                placeholder="##FIELD_LABEL##" 
                                ##FIELD_REQUIRED## 
                                value="##FIELD_VALUE##"
                                autofocus >
                        ##INVALID_FEEDBACK##
                    </div>
                </div>
                ';
                break;
        }
 
        $r = array(
            "##FIELD_NAME##"
            ,"##FIELD_LABEL##"
            ,"##FIELD_ID##"
            ,"##FIELD_TYPE##"
            ,"##FIELD_CLASS##"
            ,"##POSITION##"
            ,"##FIELD_REQUIRED##"
            ,"##FIELD_VALUE##"
            ,"##OPTIONS##"
            ,"##INVALID_FEEDBACK##"
        );

        $fname = $val->field_name;
        $html_options = '';
        if($options[$key]) {
            //add first option not selected
            $html_options .= '<option value="0">Nije izabrano</option>';
            ////add all other options
            foreach ($options[$key] as $opt_obj) {
                $html_options .= '<option value="'.$opt_obj->value.'" '.(($values->$fname==$opt_obj->value)?'selected="selected"':'').'>'.$opt_obj->name.'</option>';
            }
        }
        
        $rr = array(
            $fname
            ,$val->field_label
            ,$val->field_id
            ,$val->field_type
            ,$val->field_class
            ,$val->position
            ,$val->field_required
            ,((strpos($fname, '_uid')) ? md5($values->$fname) : $values->$fname)
            ,(($html_options!='') ? $html_options : '')
            ,'<div class="invalid-feedback">'.$val->invalid_feedback.'</div>'
        );
        $new_str = str_replace($r, $rr, $str);
        $ret .= $new_str;
    }
    return $ret;
}