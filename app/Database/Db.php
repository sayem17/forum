<?php 

namespace App\Database;

class Db{

	public static function __callStatic($method, $args)
	{

		return call_user_func_array([new QueryBuilder, $method], $args);
	}

}