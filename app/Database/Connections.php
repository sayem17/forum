<?php 

namespace App\Database;

/**
* Database Connection Container
*/
class Connections
{

	private static $connections = [];
	
	public static function make($connection = null)
	{
	
		if(!$connection)
			$connection = config('database.default');

		$config = config('database.' . $connection);

		return static::$connections[$connection] = (new $config['driver']($config))->connect();
	
	}

	public static function get($connection = null)
	{
	
		if($connection && array_key_exists($connection, static::$connections))
			return static::$connections[$connection];

		return static::make();
	
	}
}