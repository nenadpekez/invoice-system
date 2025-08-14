<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
	if(!ENVIRONMENT === 'development'){
	//Here goes debug view content page
			echo "<pre>";
			if($this->data['param'])
				print_r($this->data['param']);
			if(isset($this->data['forms']))
				print_r($this->data['forms']);
			echo "</pre>";
		}
	?>
<br>
	

