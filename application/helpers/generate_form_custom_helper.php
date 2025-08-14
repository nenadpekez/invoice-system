<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getData'))
{
	function getData($req)
	{
		$ci = &get_instance();

		#return data for component template as array
		switch($req){
			case 'input_field':
				$array = array(
					'input_type' => 'text',
					'input_id' => 'input_id',
					'input_placeholder' => 'Input some text...',
					'input_value' => $ci->customform->getData()->aName,
				);
			break;

			case 'label':
				$array = array(
                	'label_for' => 'input_id',
                	'label_value' => 'Value : ',
				);
			break;

			case 'button':
				$array = array(
					'button_id' => 'button_id',
					'button_value' => 'button value',
					'button_class' => 'btn btn-success',
				);
			break;

			default:
			$array =  'ERROR';
		}

		return $array;
	}
}

if ( ! function_exists('getComponentTemplate'))
{
	function getComponentTemplate($req){
		$ci =& get_instance();
		#load component template and get data for it
		#return as a string
		return $ci->parser->parse_string($ci->load->view('components/'.$req,'',TRUE), getData($req),TRUE); 
	}
}

if ( ! function_exists('getDivGroupTemplate'))
{
	function getDivGroupTemplate($req, $template=FALSE){
		$ci =& get_instance();
		#load component template and get data for it
		#return as a string
		if(!$template){
		return $ci->parser->parse_string($ci->load->view('components/'.$req,'',TRUE), getData($req),TRUE); 
		} else {
			return $ci->parser->parse_string($ci->load->view('components/'.$req,'',TRUE), $template,TRUE); 
		}
	}
}