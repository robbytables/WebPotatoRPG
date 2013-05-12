<?php

class Potato_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index()
	{
		return View::make('potato.potato');
	}

        public function action_test()
	{
		return "Hello Potato Person Latvia whatever!";
	}


	public function action_dbtest()
	{
		$user = DB::table('users')->first();
		echo var_dump($user);
	}

	public function action_dbwrite()
	{
                $input = Input::get('_name');
                $input2 = Input::json();
                echo "$input TEST TEST ";
                echo "$input2 TEST TEST ";
		$id = DB::table('users')->insert_get_id(array('username' => $input));
		echo "$input inserted as the $id record";
                return Response::json(Input::get('_name'));
	}

}