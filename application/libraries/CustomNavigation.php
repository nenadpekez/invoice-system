<?php

use PhpParser\Node\Stmt\Foreach_;

/**
 * class CustomNavigation is a class for create custom menu navigation inside controler based on data from DB
 * author                   : Nenad Pekez
 * date                     : 22.10.2019
 * first implementation     : null
 */

Class CustomNavigation {

	# attribute names for request data
    public $id; //unique id in table
    public $eid; //id of element
    public $value; //text of link
    public $title; //title attribute
	public $class; //class
    public $name; //name of element
    public $controler; //name of controler
    public $method; //method in controler
    public $href; //href if needed default=#
    public $parent_id; //if > 0 then element have children
    public $align; //0 = home, 1 = left. 2 = right
    public $active; //maybe is deactivated
    public $order_by; // order to appear

    private $ci;
    private $data; //data from db
    private $ret = array('home', 'left', 'right'); //data to return
	

    public function __construct()
	{
        #reference codeigniter instance
        $this->ci =& get_instance();
        //get all data from db table main_menu
        $this->ci->load->model('data_model', 'data_model');  
        $this->data = $this->ci->data_model->getNavigationData();
	}

	public function getData()
	{
        //return $this;
		if(!$this->data) {
			return array('error'=>true, 'error_message' => 'No table main_menu in db!');
		}
        foreach($this->data as $data)
        {
            //$this->ret[$data['align']][] = $data;
        }
        /*
        echo "<pre>";
        print_r($this->data);
        echo "</pre>";
        */
        foreach($this->data as $key => $data)
        {
            switch($key){
                case 0:
                $this->ret['home'] = $this->generateHomeLink($data);
                break;

                case 1:
                $this->ret['left'][] = $this->generateItemLink($data);
                break;

                case 2:
                $this->ret['right'][] = $this->generateItemLink($data);
                break;
            }
        }

        return $this->ret;
    }
    
    public function generateHomeLink($tmp = null)
    {
        return '<a class="navbar-brand" href="'.base_url().$tmp[0]['href'].'" title="'.$tmp[0]['title'].'">'.$tmp[0]['value'].'</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>';
    }

    public function generateItemLink($tmp = null)
    {
        $str = '';
        foreach($tmp as $key=>$data)
        {
            if(!array_key_exists('child',$data))
            {
                $str .= '<li class="nav-item">';
                $str .= '<a class="nav-link '.$data['class'].'" id="'.$data['eid'].'" href="'.base_url().$data['href'].'" title="'.$data['title'].'">'.$data['icon'].' '.$data['value'].'</a>';
                $str .= '</li>';
            } else {
                $str .= '<li class="nav-item dropdown">';
                $str .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" title="'.$data['title'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $str .= $data['value'];
                $str .= '</a>';
                $str .= '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                foreach($data['child'] as $child)
                {
                    $str .= '<a class="dropdown-item" href="'.base_url().$child['href'].'" title="'.$child['title'].'">'.$child['value'].'</a>';
                }
                $str .= '</div>';
                $str .= '</li>';
            }
        }
        return $str;
    }

	public function setData($tmp)
	{
		if(array_key_exists("title", $tmp))          	$this->aTitle           = $tmp["title"];
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