<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generateTableUsers'))
{
    /**
     * method generate table for users_view.php
     * @data array of user Object
     * return String html
     */
	function generateTableUsers($data)
	{
		$ci = &get_instance();

        $res = '<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">RB</th>
                <th class="th-sm">Korisničko ime</th>
                <th class="th-sm">Korisnik</th>
                <th class="th-sm">Status</th>
                <th class="th-sm text-center">Akcija</th>
            </tr>
        </thead>
        <tbody>
        ';
		//file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($data,1), FILE_APPEND);
        $rb=0;
        
        foreach ($data as $val) {

            $tr_class = '';
            $action_class = 'btn disabled';
            $href = '#';
            $title = 'Nemate autorizaciju za ovog korisnika!';
            if($ci->session->userdata('level') < $val->level || $ci->session->userdata('user_id') == $val->user_id) {
                $href = base_url() . 'users/edit/' . $val->user_uid;
                $title = 'Podešavanje korisničkih parametara';
                $action_class = 'btn btn-sm btn-outline-primary';
            }
            $action = '<a href="'.$href.'" class="'.$action_class.'" title="'.$title.'"><i class="fas fa-cog"></i></a>';
            
            $rb++;
            switch((int)$val->status){
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
            $res .= '<tr class="'.$status_class.'">
            <td>'.$rb.'.</td>
            <td>'.$val->username.'</td>
            <td>'.$val->user.'</td>
            <td class="'.$tr_class.'">'.$status.'</td>
            <td class="text-center">'.$action.'</td>
        </tr>';
        }
        $res .= '</tbody>
        </table>
        ';

        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($res,1), FILE_APPEND);
		return $res;
	}
}


if ( ! function_exists('generateTableInstitution'))
{
    /**
     * method generate table for institution_view.php
     * @data array of institution Object
     * return String html
     */
	function generateTableInstitution($data)
	{
		$ci = &get_instance();

        $res = '<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">RB</th>
                <th class="th-sm">Naziv ustanove</th>
                <th class="th-sm">PIB</th>
                <th class="th-sm">Matični broj</th>
                <th class="th-sm text-center">Akcija</th>
            </tr>
        </thead>
        <tbody>
        ';
		//file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($data,1), FILE_APPEND);
        $rb=0;

        if($ci->session->userdata('level') < 2) {
            $href = base_url() . 'institution/insert/';
            $title = 'Novi unos';
            $action_class = 'btn btn-sm btn-outline-primary';
        }
        
        if(count($data) == 0) {
            //nema podataka, daj dugme za insert
            $res = '<a href="'.$href.'" class="btn btn-primary" title="'.$title.'"><i class="fas fa-plus"></i></a>';
        }
        foreach ($data as $val) {

            $tr_class = '';
            $status_class = '';
            $action_class = 'btn disabled';
            $href = '#';
            $title = 'Nemate autorizaciju za ovu akciju!';
            if($ci->session->userdata('level') < 2) {
                $href = base_url() . 'institution/edit/' . $val->institution_id;
                $title = 'Izmena podataka za ustanovu';
                $action_class = 'btn btn-sm btn-outline-primary';
            }
            $action = '<a href="'.$href.'" class="'.$action_class.'" title="'.$title.'"><i class="fas fa-cog"></i></a>';
            
            $rb++;
            switch((int)$val->status){
                case 
                    0: $status = 'Neaktivan';
                break;
                case
                    1: $status = 'Aktivan';
                break;
                default: 
                    $status = '';
                break;
            }
            $res .= '<tr class="'.$status_class.'">
            <td>'.$rb.'.</td>
            <td>'.$val->name.'</td>
            <td>'.$val->taxnum.'</td>
            <td>'.$val->matical.'</td>
            <!-- <td class="'.$tr_class.'">'.$status.'</td> -->
            <td class="text-center">'.$action.'</td>
        </tr>';
        }
        $res .= '</tbody>
        </table>
        ';

        //file_put_contents(FCPATH . "debug.log", "--- file ".__FILE__." | function ".__FUNCTION__." ln ".__LINE__." ---\n result from helper\n".print_r($res,1), FILE_APPEND);
		return $res;
	}
}