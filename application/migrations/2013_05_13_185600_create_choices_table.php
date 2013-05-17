<?php

class Create_Choices_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('choices', function($table)
                {
                    $table->create();
                    $table->increments('id');
                    $table->primary('id');
                    $table->text('choice_text');
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