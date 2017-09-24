<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {

public function my_custom_rule($str){
		$this->set_message('my_custom_rule', 'fan_name can only contain alphbates and spaces!');
		return ( ! preg_match("/^[A-Za-z- ]*$/", $str)) ? FALSE : TRUE;
	}
}