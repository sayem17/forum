<?php 

return [

	'' => 'ThreadsController@index',

	'threads' => 'ThreadsController@index',

	// threads reply controller

	'thread/reply' => 'ThreadsController@reply',

	'thread/edit' => 'ThreadsController@edit',

	'thread/save' => 'ThreadsController@save',

	'thread/new' => 'ThreadsController@add',

	'thread/create' => 'ThreadsController@create',

	'thread/remove' => 'ThreadsController@remove',

	//authentication

	'register' => 'AuthController@register',

	'login' => 'AuthController@login',

	'logout' => 'AuthController@logout',

	// Search

	'search' => 'SearchController@index',

	// Users

	'user' => 'UserController@index',

	// Test

	'test' => 'TestController@index',
];
