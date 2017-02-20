<?php

namespace App\Core;

class Validator{

	protected $d = array();

	public function sanitizePost($post=array()){
		foreach($post as $k=>&$v) 
			if(!is_array($v))
				$v = filter_var(trim($v), FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
		return $post;
	}

	public static function validate($post, $filters){

		$instance = new static;

		$error = false;
		$instance->d['error'] = false;
		$instance->d['post'] = $post;
		foreach($post as $k=>$v){
			if(isset($filters[$k])){
				$f = $filters[$k];
				$instance->validateField($k, $v,$f);
			}
		}

		return $instance->d;
	}

	public function validateField($k, $v, $filter){
		$f = explode('|', $filter);
		$fu = "validate_{$f[0]}";
		return $this->$fu($k, $v, $filter);
	}

	public function validate_text($k, $v, $filter){
		$v = trim($v);

		$flt = explode('|', $filter);

		if(isset($flt['1'])) parse_str($flt[1], $f);

		if(isset($f['min']) && strlen($v)<=$f['min']){

			return $this->error($k, "Must be {$f['min']} characters or long");

		}elseif(isset($f['max']) && strlen($v)>$f['max']){

			return $this->error($k, "Maximum {$f['max']} characters are allowed");

		}else if(strlen($v)<=1){

			return $this->error($k, ucfirst($k) . " is too short");

		}
		
		return true;
	}

	public function error($k, $msg)
	{
		$this->d['error'] = true;
		$this->d['validation_errors'][$k] = $msg;

		return false;		
	
	}

	public function validate_name($k, $v, $filter){
		$v = trim($v);

		if(!isset($v) || empty($v)):
			return $this->error($k, 'Name is required');
		endif;

		if(strlen($v)<1){

			return $this->error($k, 'Invalid name');

		}elseif(preg_match('/[^\w\s\-\.]/i', $v)){

			return $this->error($k, 'Invalid name');
		}

		return true;
	}

	public function validate_email($k, $v, $filter){
		$v = trim($v);

		if(!isset($v) || empty($v)):
			return $this->error($k, 'Email is Required');
		endif;
		
		if(!filter_var($v, FILTER_VALIDATE_EMAIL)){
			return $this->error($k, 'Invalid Email Address');
		}

		return true;
	}

	public function validate_password($k, $v, $filter){

		if(!isset($v) || empty($v)):
			return $this->error($k, 'Password field is required');
		endif;

		if(strlen($v)<6){
			return $this->error($k, 'Password is too short');
			return false;
		}elseif(strlen($v)>100){
			return $this->error($k, 'Password is too long');
		}
		return true;
	}

	public function validate_confirm_password($k, $v, $filter){
		$pass = $this->d['post']['password'];
		if($v!=$pass){
			return $this->error($k, "Password do not match");
		}

		return true;
	}

	public function validate_password_match($k, $v, $filter){
		//echo $filter;
		$e = explode('|', $filter);
		$pass = trim($e[1]);
		$pass1 = $this->d['post'][$pass];
		if($v!=$pass1){
			$this->d['error'] = true;
			$this->d[$k.'_error'] = true;
			$this->d[$k.'_msg'] = gs::$l[103];
			return false;
		}

		return true;
	}
}
?>