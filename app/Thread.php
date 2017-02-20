<?php 

namespace App;

use App\Database\Db;

class Thread extends Model{
	protected $fillable = ['parent_id', 'user_id', 'title', 'body', 'replies', 'topic_id'];

	public function excerpt()
	{
	
		return strlen($this->body)>120 ? substr($this->body, 0, 120) . '..' : $this->body;
	
	}

	public function updateTotalReplies($id)
	{
	
		Db::query("
			update threads t1 INNER JOIN (select count(id) as total from threads where parent_id=:parent) as t2 set t1.replies=t2.total where t1.id=:id;
		", ['parent' => $id, 'id' => $id]);

		return true;
	
	}

	public static function sortOptions()
	{
	
		return [

			'newest' => 'Newest',

			'oldest' => 'Oldest',

			'title' => 'Title'
		];
	
	}

	public static function setOrder($query, $sort, $prefix=null){
		$prefix = $prefix ? $prefix . '.' : '';
		if($sort=='oldest')
			$query->orderBy($prefix.'created_at', 'asc');
		elseif($sort=='title')
			$query->orderBy($prefix.'title', 'asc');
		else
			$query->orderBy($prefix.'created_at', 'desc');

		return $query;
	}
}
