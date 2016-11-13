<?php

use Illuminate\Database\Capsule\Manager as DB;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Setup the test case data persistance layer.
     */
    public function setUp()
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    /**
     * Setup the in-memory database.
     */
    protected function setUpDatabase()
    {
        $database = new DB;

        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    /**
     * Run any migrations to setup the schema for the database.
     */
    public function migrateTables()
    {
        DB::schema()->create('pages', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }
}
