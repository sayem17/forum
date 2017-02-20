<?php 

namespace App\Controllers;

use App\User;

class AuthController extends Controller{

	public function __construct()
	{
	
	
	}

	public function logout()
	{

		if(is_logged()){
			unset($_SESSION['user_id']);
			unset($_SESSION['logged']);
		}

		return redirect();
	
	}

	public function login()
	{
		// redirect user if already logged in

		if(is_logged())
			return redirect();

		if(isset($_POST['email']))
			return $this->authenticateUser();
	
		return view('auth.login');
	
	}

	public function authenticateUser()
	{

		// validate input, if error send back to login page
	
		$validate = $this->validate([

			'email' => 'email',

			'password' => 'password'

		], '/login');


		// validation ok, now check if email and password matches

		$data = $validate['post'];

		$user = User::where('email', $data['email'])->row();

		// match user data and password, if error send back

		$this->checkPassword($user, $validate);

		// user authenticated, put user to session

		$this->addUserToSession($user);

		// redirect user

		return redirect();
	
	}

	public function checkPassword($user, $validate)
	{
	
		if($user->password && password_verify($validate['post']['password'], $user->password))
			return true;

		$validate['error'] = true;

		$validate['validation_errors']['mismatch'] = 'Invalid Email or Password';

		validation_error($validate);

		return redirect('/login');
	
	}

	public function register()
	{
		// redirect user if already logged in

		if(is_logged())
			return redirect();

		//dd($_SESSION);

		if(isset($_POST['email']))
			return $this->registerUser();
	
		return view('auth.register');
	
	}

	public function registerUser()
	{

		// get fillables
	
		// validate form, chekc if everything is filled properly

		$validate = $this->validate([

			'name' => 'name',

			'email' => 'email',

			'password' => 'password',

			'confirm_password' => 'confirm_password'
		], '/register');

		//get sanitized data
		$data = $validate['post'];

		// check duplicate email, if email in db user already registered

		$this->checkIfUserAlreadyRegistered($validate);


		// encrypt password
		$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

		// store user to database and get user instance

		$user = User::create($data);

		// put data to session

		$this->addUserToSession($user);

		// redirect

		return redirect();
	
	}

	public function addUserToSession($user)
	{
	
		$_SESSION['logged'] = true;

		$_SESSION['user'] = $user;
	
	}

	public function checkIfUserAlreadyRegistered($validate)
	{

		$email = $validate['post']['email'];
	
		$user = User::where('email', $email)->row();

		if($user->id):

			$validate['error'] = true;

			$validate['validation_errors']['email'] = 'Email is already registered';

			validation_error($validate, '/register');

			return redirect('/register');

		endif;

		return false;
	
	}

}
