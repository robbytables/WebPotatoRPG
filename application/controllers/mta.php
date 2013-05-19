<?php

class MTA_Controller extends Base_Controller {

    public function action_index() {
        $mta = file_get_contents('http://datamine.mta.info/mta_esi.php?key=7073cdec69d4429e24d25b6bbc3e91bc');
        File::put('public/data/mta.txt', $mta);

        return View::make('mta.index');
    }

}