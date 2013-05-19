<?php

class MTA_Controller extends Base_Controller {

    public function action_index() {
        $data = array(
            'totalUsers' => $count = DB::table('users')->count()
        );

        return View::make('mta.index')->with('data', $data);
    }

}