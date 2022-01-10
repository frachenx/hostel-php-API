<?php
require_once('../config.php');
require_once('../Classes/room.php');

$jsonInput =  json_decode(file_get_contents('php://input'));

$room =  new Room();

// $id,$roomNumber,$seater,$fee,$postingDate;

$room->id = $jsonInput->id;
$room->roomNumber = $jsonInput->roomNumber;
$room->seater = $jsonInput->seater;
$room->fee = $jsonInput->fee;
$room->postingDate = $jsonInput->postingDate;

$json = array();
if($room->update()){
    $json[]=array(
        "response"=>"true"
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}

echo json_encode($json[0]);
