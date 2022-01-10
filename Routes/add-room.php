<?php
require_once("../config.php");
require_once("../Classes/room.php");

$jsonInput = json_decode(file_get_contents("php://input"));

$room = Room::addRoom($jsonInput->roomNumber,$jsonInput->seater,$jsonInput->fee);

if (!$room){
    $json = array();
    $json[] = array(
        "response"=> "false"
    );
}else{
    $json = array();
    $json[] = array(
        "response"=> "true"
    );
}

echo json_encode($json);