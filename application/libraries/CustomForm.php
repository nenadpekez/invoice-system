<?php

/**
 * class CustomForm is a class for create custom forms inside controler based on data from DB
 * author   : Nenad Pekez
 * date     : 22.10.2019
 */

Class CustomForm {

	# attribute names for request data
	public $id 				= 'id';
	public $title			= 'title';
	public $class 			= 'class';
	public $name 			= 'name';
	public $method 			= 'method';
	public $action 			= 'action';
	public $target 			= 'target';
	public $autocomplete 	= 'autocomlete';
	public $type			= 'type';
	public $onclick			= 'onclick';
	public $href			= 'href';
	public $readonly		= 'readonly';
	public $disabled		= 'disabled';
	public $additional		= array();
	
	public $label			= false;
	public $label_icon		= '';
	public $label_align		= '';
	public $label_class		= 'class';
	public $label_id		= 'id';
	public $label_for		= 'for';
	public $label_text		= '';
	
	public $put_inside_div	= true;
	public $div_id			= 'id';
	public $div_class		= 'class';

	public $value			= '';
	public $buttonData		= '';

	# attribute values for request data
	public $aId 			= '';
	public $aTitle			= '';
	public $aClass 			= '';
	public $aName 			= 'Form';
	public $aMethod 		= '';
	public $aAction 		= '';
	public $aTarget 		= '';
	public $aAutocomplete 	= '';
	public $aType			= 'action_of_input';
	public $aOnclick		= 'method_of_input';
	public $aHref			= 'href_of_input';
	public $aReadonly		= false;
	public $aDisabled		= false;
	public $aAdditional		= '';
	
	public $aLabel			= false;
	public $aLabel_ico		= '';
	public $aLabel_align	= 'left';
	public $aLabel_class	= '';
	public $aLabel_id		= '';
	public $aLabel_for		= '';
	public $aLabel_text		= '';
	
	public $aPut_inside_div	= true;
	public $aDiv_id			= '';
	public $aDiv_class		= '';

	public $aValue			= '';
	public $aButtonData		= '';

	public function __construct()
	{
	}

	public function getData()
	{
		return $this;
	}

	public function setData($tmp)
	{
		if(array_key_exists("title", $tmp))          	$this->aTitle           = $tmp["title"];
		if(array_key_exists("name", $tmp))          	$this->aName            = $tmp["name"];
		if(array_key_exists("id", $tmp))            	$this->aId              = $tmp["id"];
		if(array_key_exists("class", $tmp))         	$this->aClass           = $tmp["class"];
		if(array_key_exists("method", $tmp))        	$this->aMethod          = $tmp["method"];
		if(array_key_exists("action", $tmp))      		$this->aAction          = $tmp["action"];
		if(array_key_exists("target", $tmp))      		$this->aTarget          = $tmp["target"];
		if(array_key_exists("autocomplete", $tmp))		$this->aAutocomplete    = $tmp["autocomplete"];
		if(array_key_exists("type", $tmp))				$this->aType		    = $tmp["type"];
		if(array_key_exists("onclick", $tmp))			$this->aOnclick    		= $tmp["onclick"];
		if(array_key_exists("href", $tmp))    			$this->aHref    		= $tmp["href"];
		if(array_key_exists("readonly", $tmp))    		$this->aReadonly    	= $tmp["readonly"];
		if(array_key_exists("disabled", $tmp))    		$this->aDisabled    	= $tmp["disabled"];
		if(array_key_exists("additional", $tmp))    	$this->aAdditional    	= $tmp["additional"];
		
		if(array_key_exists("label", $tmp))    			$this->aLabel    		= $tmp["label"];
		if(array_key_exists("label_icon", $tmp))    	$this->aLabel_icon    	= $tmp["label_icon"];
		if(array_key_exists("label_align", $tmp)) 		$this->aLabel_align    	= $tmp["label_align"];
		if(array_key_exists("label_class", $tmp)) 		$this->aLabel_class    	= $tmp["label_class"];
		if(array_key_exists("label_id", $tmp)) 			$this->aLabel_id	    = $tmp["label_id"];
		if(array_key_exists("label_for", $tmp)) 		$this->aLabel_for    	= $tmp["label_for"];
		if(array_key_exists("label_text", $tmp)) 		$this->aLabel_text    	= $tmp["label_text"];

		if(array_key_exists("put_inside_div", $tmp))	$this->aPut_inside_div	= $tmp["put_inside_div"];
		if(array_key_exists("div_id", $tmp))            $this->aDiv_id          = $tmp["div_id"];
		if(array_key_exists("div_class", $tmp))         $this->aDiv_class       = $tmp["div_class"];

		if(array_key_exists("value", $tmp))         	$this->aValue			= $tmp["value"];
		if(array_key_exists("buttonData", $tmp))		$this->aButtonData		= $tmp["buttonData"];
	}

	public function CustomFormOpen($data = null)
	{
		if(($data) || (is_array($data)))
		{
			$this->setData($data);
			$result  = "\n";
			$result .= str_repeat("\t",1);
			$result .= ($this->aTitle)?"<h4>".$this->aTitle."</h4>":"";
			$result .= "\n";
			$result .= str_repeat("\t",1)."<form ";
			$result .= ($this->aName)?$this->name."=\"".$this->aName."\" ":"";
			$result .= ($this->aId)?$this->id."=\"".$this->aId."\" ":"";
			$result .= ($this->aClass)?$this->class."=\"".$this->aClass."\" ":"";
			$result .= ($this->aMethod)?$this->method."=\"".$this->aMethod."\" ":"";
			$result .= ($this->aAction)?$this->action."=\"".$this->aAction."\" ":"";
			$result .= ($this->aTarget)?$this->target."=\"".$this->aTarget."\" ":"";
			$result .= ($this->aAutocomplete)?$this->autocomplete:"";
			$result .= ">\n";

			echo $result;
		} else {
			die('You must send data as array to call this function!');
		}
	}

	public function CustomFormClose()
	{
		echo str_repeat("\t",1)."</form>"."\n";
	}

	public function CustomInputType($data = null)
	{
		if(($data) || (is_array($data)))
		{
			$this->setData($data);

			switch($this->aLabel_align)
			{
				case 'right':
					$result  = $this->CustomInputField();
					$result .= $this->CustomLabel();
				break;
				
				case 'left':
				default:
					$result  = $this->CustomLabel();
					$result .= $this->CustomInputField();
				break;
			}

			if($this->aPut_inside_div)
				$result = $this->CustomPutInsideDiv($result);

			echo $result;
		} else {
			die('You must send data as array to call this function!');
		}
	}

	public function CustomPutInsideDiv($data)
	{
		$result  = str_repeat("\t",2)."<div ";
		$result .= ($this->aDiv_id)?$this->div_id."=\"".$this->aDiv_id."\" ":"";
		$result .= ($this->aDiv_class)?$this->div_class."=\"".$this->aDiv_class."\" ":"";
		$result .= ">"."\n";
		$result .= $data;
		$result .= str_repeat("\t",2)."</div>"."\n";
		
		return $result;
	}

	public function CustomLabel()
	{
		$result  = str_repeat("\t",3)."<label ";
		$result .= ($this->aLabel_id)?$this->label_id."=\"".$this->aLabel_id."\" ":"";
		$result .= ($this->aLabel_class)?$this->label_class."=\"".$this->aLabel_class."\" ":"";
		$result .= ($this->aLabel_for)?$this->label_for."=\"".$this->aLabel_for."\" ":"";
		$result .= ">\n";
		$result .= str_repeat("\t",4);
		$result .= ($this->aLabel_text)?$this->aLabel_text:"";
		$result .= "\n";
		$result .= str_repeat("\t",3)."</label>\n";

		return $result;
	}

	public function CustomInputField()
	{
		$result  = str_repeat("\t",3)."<input ";
		$result .= ($this->aType)?$this->type."=\"".$this->aType."\" ":"";
		$result .= ($this->aReadonly)?$this->readonly." ":"";
		$result .= ($this->aDisabled)?$this->disabled." ":"";
		$result .= ($this->aName)?$this->name."=\"".$this->aName."\" ":"";
		$result .= ($this->aId)?$this->id."=\"".$this->aId."\" ":"";
		$result .= ($this->aClass)?$this->class."=\"".$this->aClass."\" ":"";
		$result .= ($this->aAdditional)?$this->customAdditional($this->aAdditional):"";
		$result .= ">\n";

		return $result;
	}

	public function CustomAdditional($data)
	{
		$result = '';
		foreach($data as $key=>$val)
		{
			$result .= " ".$key."=\"".$val."\"";
		}

		return $result;
	}

	public function CustomButton($data = null)
	{
		if(($data) || (is_array($data)))
		{
			$this->setData($data);
			$result  = str_repeat("\t",3)."<button ";
			$result .= ($this->aType)?$this->type."=\"".$this->aType."\" ":"";
			$result .= ($this->aName)?$this->name."=\"".$this->aName."\" ":"";
			$result .= ($this->aId)?$this->id."=\"".$this->aId."\" ":"";
			$result .= ($this->aClass)?$this->class."=\"".$this->aClass."\" ":"";
			$result .= ($this->aTitle)?$this->title."=\"".$this->aTitle."\" ":"";
			$result .= ($this->aOnclick)?$this->onclick."=\"".$this->aOnclick."\" ":"";
			$result .= ($this->aButtonData)?$this->customButtonData($this->aButtonData):"";
			$result .= ">";
			$result .= ($this->aValue)?$this->aValue:"";
			$result .= "</button>\n";

			echo $result;
		} else {
			die('You must send data as array to call this function!');
		}
	}

	public function customButtonData($data)
	{
		$result = '';
		foreach($data as $key=>$val)
		{
			$result .= " data-".$key."=\"".$val."\"";
		}

		return $result;
	}
}

?>