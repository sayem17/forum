<?php 

namespace App\Controllers;

abstract class Controller{

	public function validate($rules, $redirect)
	{
	
		$validate = \App\Core\Validator::validate($_POST, $rules);

		if($validate['error']):
			validation_error($validate, $redirect);
			return redirect($redirect);
		endif;

		return $validate;
	
	}
	
}
