<?php

class Potato_Controller extends Base_Controller {

    public function action_index() {
        $ages = DB::table('users')
	    ->take(10)
	    ->order_by('age','desc')
	    ->get();
		
        $topTen = array();
		
	foreach ($ages as $age) {
	    $topTen[] = strval($age->username) . ", age " . strval($age->age);
	}
		
        $data = array(
            'totalUsers' => $count = DB::table('users')->count(),
	        'topAges' => $topTen
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
        $id = Input::get("_id");
        DB::table('users')
            ->where('id', '=', $id)
            ->update(array('age' => $age));
        return Response::make('Age set', 200);
    }

    public function action_dbgetevent() {
        $name = Input::get("_name");
        $eventNum = DB::table('events')->count();
	srand();
	$event = DB::table('events')
	    ->where('id', '=', rand(1, $eventNum))
	    ->get();
	return Response::json(array('event' => $event));
    }

    public function action_dbLoadChoices() {
        $ones = DB::table('choices')
	    ->where('type', '=', 1);
	    ->get();
	$twos = DB::table('choices')
	    ->where('type', '=', 2);
	    ->get();
	$threes = DB::table('choices')
	    ->where('type', '=', 3);
	    ->get();

	return Response::json(array('ones' => $ones, 'twos' => $twos, 'threes' => $threes));

    }

}
