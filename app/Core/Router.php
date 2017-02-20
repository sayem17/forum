<?php 

namespace App\Core;

class Router
{
	protected $routes;
	
	public function define($routes)
	{
	
		$this->routes = $routes;
	
	}

	public function direct($uri)
	{

		if(array_key_exists($uri, $this->routes))
			return $this->routes[$uri];

		
		throw new Exception('Invalid path');

	}

	public static function __callStatic($mthod, $args){
		if(empty($args) && array_key_exists($method, static::$data))
    		return static::$data[$method];

        else if(count($args)>0)
           return static::$data[$method] = $args[0];
       
        else
            return null;
	}
}