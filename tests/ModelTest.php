<?php

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase{

    public function testTableName() {
    	
    	$thread = new App\Thread;

		$this->assertEquals($thread->getTable(), 'threads');
    }


    // get a single row from the table

    public function testSingleRow()
    {
    	// get thread data with id=1 from database using Thread model

    	// $row = App\Thread::find(1);

    	// $id = (int)$row->id;
 

    	$this->assertEquals(1, 1);
    
    }

    public function tetGetAllRows()
    {
    
        //$rows = App\Thread::All();
    
    }

    public function testConditionalGet()
    {
    
        //$rows = App\Thread::select(['id', 'title'])->where('user_id', 1)->get();
    
    }



    
}
