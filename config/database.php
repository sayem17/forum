<?php 

return [
	
	'default' => 'mysql',

	'mysql' => [

		'driver' => 'App\Database\MySql',

		'host' => 'localhost',

		'port' => '3306',

		'database' => 'jp',

		'username' => 'root',

		'password' => '4093',

		'charset' => 'utf8',
            
        'collation' => 'utf8_unicode_ci',
	],

];
