<?php

class MTA_Controller extends Base_Controller {

    public function action_index() {
        $mta = file_get_contents('http://datamine.mta.info/mta_esi.php?key=7073cdec69d4429e24d25b6bbc3e91bc');

        File::put('public/data/mta.txt', $mta);

         // protoc -I tmp/ tmp/nyct-subway.proto --decode=transit_realtime.FeedMessage > tmp/decodedmtafeed2

        $parsedMta = shell_exec('cat public/data/mta.txt | protoc -I public/data/mapping public/data/mapping/nyct-subway.proto --decode=transit_realtime.FeedMessage');
        echo getcwd() . "\n";
        echo $parsedMta;

        File::put('public/data/mtaparsed.txt', $parsedMta);

        return View::make('mta.index');
    }

}