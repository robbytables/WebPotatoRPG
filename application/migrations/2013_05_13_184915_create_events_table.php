<?php

class Create_Events_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function($table)
                {
                    $table->create();
                    $table->increments('id');
                    $table->primary('id');
                    $table->text('event_text');
                    $table->integer('type');
                    $table->integer('suffer');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}