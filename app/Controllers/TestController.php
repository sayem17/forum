<?php 

namespace App\Controllers;

use App\Thread;

class TestController extends Controller{

	public function index()
	{
		
		$call = get_string('call', 'threads');

		$this->$call();
	
	}

	public function threads()
	{
	
		$rows = Thread::where('parent_id', null)->with('user')->get();

		dd($rows);
	
	}

	public function thread()
	{
	
		$row = Thread::where('id', 2)->with('user')->first();

		dd($row);
	
	}
}