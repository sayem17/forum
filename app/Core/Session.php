<?php

namespace App\Core;

class Session{

	public $time = "1 month";

	public function __set($name, $value) {
		$_SESSION[$name] = $value;
	}

	public function __get($name) {
		return $_SESSION[$name];
	}

	public function __isset($name){
  		return isset($_SESSION[$name]);
	}

	public function sec_key(){
		$rand = rand(1,20);
		//return md5($rand);
		return $rand;
	}

	public static function check(){
		if(isset($_SESSION['logged']) && $_SESSION['logged'])
			return true;

		return false;
	}

	public static function start(){

		if(session_start()){
			session_regenerate_id(true);

			if(!isset($_SESSION['_token'])){
				$token = uniqid();

				$_SESSION['_token'] = $token;
			}

			return true;

		}else{

			return false;
		}
	}


	public static function removeTemp(){
		unset($_SESSION['error']);
		unset($_SESSION['post']);
	}


}