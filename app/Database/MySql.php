<?php 

namespace App\Database;

class MySql{
	protected $config;

	public function __construct($config)
	{
	
		$this->config = $config;
	
	}

	public function connect()
	{
	
		try {

			$dsn = 'mysql:host=' . $this->config['host'] . 
			';dbname=' . $this->config['database'] .
			';charset=' . $this->config['charset'];

			$pdo = new \PDO(
				$dsn, 

				$this->config['username'], 

				$this->config['password']
			);

			//$pdo->setAttribute(\PDO::ATTR_ERRMODE, 
            //                \PDO::ERRMODE_EXCEPTION);

			return $pdo;
			
		} catch (\PDOException $e) {
			cout($e->getMessage());
		}
	
	}
}
