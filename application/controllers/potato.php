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

    public function action_index() {
        $data = array(
            'totalUsers' => $count = DB::table('users')->count()
        );

        return View::make('potato.potato')->with('data', $data);
    }

    public function action_dbtest() {
        $user = DB::table('users')->first();
    }

    public function action_dbwrite() {
        $username = Input::get('_name');
        $id = DB::table('users')->insert_get_id(array('username' => $username));
        return Response::json(array('username' => $username, 'id' => $id));
    }
	
	public function action_dbwriteAge() {
		$age = Input::get("_age");
		$name = Input::get("_name");
		$id = DB::table('users')
			->where('username', '=', $name)
			->update(array('age' => $age));
		return Response::make('Age set', 200, array());
	}

}