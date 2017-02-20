<?php 

namespace App;

use App\Database\Db;

use App\Database\QueryBuilder;

abstract class Model{

	// default primary key
	protected $primary_key = 'id';

	// fields that can inserted to db

	protected $fillable;

	// holds data, mainly data returned from database query etc.
	protected $attributes = [];

	//table name of the model, default plural of the model name
	protected $table;

	function __construct()
	{		
		
	}

	public function __get($key){

		return $this->getAttribute($key);
	}

	public function __set($key, $value)
	{
	
		$this->setAttribute($key, $value);
	
	}

     public static function create($fields, $row=false)
    {

        $instance = new static;
    
        $fillables = $instance->getFillable($fields);

        $values = $instance->setInsertAttributes($fillables);

        $id = Db::table($instance->getTable())->create($values);
    
        return static::find($id);        
    
    }

    public static function update($fields, $cond)
    {
    
        $instance = new static;
    
        $fillables = $instance->getFillable($fields);

        $values = $instance->setInsertAttributes($fillables);

        $db = Db::table($instance->getTable());

        foreach($cond as $k=>$v)
            $db->where($k, $v);

        return $db->update($values, $cond);
    }

    protected function setInsertAttributes($attributes)
    {

        $values = [];
    
        foreach($attributes as $key => $value) {

            $method = 'set' . ucfirst($key) . 'Insert';

            if(method_exists($this, $method))

                $value = $this->$method($value);
  

            $values[$key] = $value;

        }

        return $values;
    }

    public function primaryKey()
    {
    
        return $this->primary_key;
    
    }
    

	public function getTable()
	{
	
        if (isset($this->table)) {
            return $this->table;
        }

        

        $namespace = get_called_class();

        $parts = explode('\\', $namespace);

        $class = end($parts);

        $this->table = strtolower( $class ) . 's';

        return $this->table;
	
	}

    public function getFillable($fields)
    {

        return array_intersect_key($fields, array_flip($this->fillable));
    
    }


    public function setAttributes(array $attributes)
    {
    	dd($attributes);
    
    	$this->attributes = (array) $attributes;

    }

        public function setAttribute($key, $val)
    {
    
        $this->attributes[$key] = $val;
    
    }


    public function hasCustomAttribute($key, $value)
    {
    
        $method = 'get' . format_class_name($key) . 'Attribute';

        if(method_exists($this, $method))
            return $this->$method($value);
        else
            return $value;
    
    }

    public function getAttribute($key)
    {
        if(array_key_exists($key, $this->attributes)){
    
           $value = $this->attributes[$key];

           return $this->hasCustomAttribute($key, $value);

        }

        return $this->hasCustomAttribute($key, null);
    
    }

    public function getAttributes()
    {
        return $this->attributes;
        
    
    }

    public static function __callStatic($method, $args){
        $instance = new static;

        $db = new QueryBuilder;

        $db->model($instance)->table($instance->getTable());
        
       	$result = call_user_func_array([$db, $method], $args);

       	return $result;
	}



}
