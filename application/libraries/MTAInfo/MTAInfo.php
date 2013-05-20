<?php

include_once("library/DrSlump/Protobuf.php");
include_once("library/DrSlump/Protobuf/Message.php");
include_once("library/DrSlump/Protobuf/Registry.php");
include_once("library/DrSlump/Protobuf/Descriptor.php");
include_once("library/DrSlump/Protobuf/Field.php");
include_once("library/DrSlump/Protobuf/Enum.php");
include_once("library/DrSlump/Protobuf/Unknown.php");

include_once("library/DrSlump/Protobuf/Compiler/protos/gtfs-realtime.php");
include_once("library/DrSlump/Protobuf/Compiler/protos/nyct-subway.php");
include_once("library/DrSlump/Protobuf/CodecInterface.php");
include_once("library/DrSlump/Protobuf/Codec/PhpArray.php");
include_once("library/DrSlump/Protobuf/Codec/Json.php");
include_once("library/DrSlump/Protobuf/Codec/Binary.php");
include_once("library/DrSlump/Protobuf/Codec/Binary/Reader.php");
include_once("library/DrSlump/Protobuf/Codec/Binary/Unknown.php");

// library\DrSlump\Protobuf\Compiler\protos\gtfs-realtime.php
class MTAInfo {

    public static function trainSearch($array, $key, $value) {
        $results = array();

        if (is_array($array)) {
            // This will find all trains that match the $value
            if (isset($array[$key]) && $value != preg_match("/$value/i", $array[$key]))
                    $results[] = $array;

            foreach ($array as $subarray)
                $results = array_merge($results, MTAInfo::trainSearch($subarray, $key, $value));
        }

        return $results;
    }

    public static function decode($mtaEncoded) {
        $decoded = DrSlump\Protobuf::decode('transit_realtime\FeedMessage', $mtaEncoded);
        $array = new DrSlump\Protobuf\Codec\PhpArray();
        $newVar = $array->encode($decoded);
        echo count($newVar['entity']);

        $train1 = MTAInfo::trainSearch($newVar, 'trip_id', '_1');
        // var_dump($newVar['entity']);
        var_dump($train1);


        $time = $newVar['header']['timestamp'];

        $car = $newVar['entity'][0]['trip_update']['trip']['trip_id'];
        // $time = $decoded->getHeader()->getTimestamp();
        // echo count($decoded);
        var_dump($car);
        //echo 'wat';
        // $entity = $decoded->getEntity(0)->getTripUpdate()->getTrip()->getTripId();
        //->getVehicle()->getTrip()->getTripId();
        // echo $entity;
        return $time;
    }

// var_dump($fm);
//$codec = new DrSlump\Protobuf\Codec\Json();
//echo $codec->encode($fm);
}

?>
