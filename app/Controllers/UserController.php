<?php 

namespace App\Controllers;

use App\User;

use App\Database\Db;

use App\Thread;

class UserController extends Controller{

	protected $sort = 'newest';

	public function __construct()
	{
	
		$this->sort = get_string('sort', 'newest');
	
	}

	public function index()
	{
	
		$id = get_int('id', false)?:die('Invalid user');

		$user = User::find($id);

		if(!$user->id) die('Invalid user');


		$cond = Db::whereLike('u.id', $id);

		Thread::setOrder($cond, $this->sort, 't1');

		$threads = Db::query(
			"select u.name as username,t1.*, 
			tp1.name as topic_name, tp2.name as parent_topic_name,IFNULL(t1.title, t2.title) as tt from users u 

			inner join threads t1 on u.id=t1.user_id  

			left join threads t2 on t1.parent_id=t2.id 

			left join topics tp1 on t1.topic_id=tp1.id 
			
			left join topics tp2 on t2.topic_id=tp2.id " . 

			$cond->getCondition() . ' ' . 

			$cond->getOrder(), 

			$cond->getValues()

		)->get();

		$sort = $this->sort;

		return view('user.index', compact('threads', 'sort', 'user'));

	
	}
}
