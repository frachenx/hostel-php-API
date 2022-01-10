<?php
require_once('../config.php');
require_once('../Classes/room.php');

$room = Room::newFromID($_GET['id']);

$json=array();

if(!$room){
    $json[]=array(
        "response"=>"false"
    );
}else{
    $json[0] = $room;
}

echo json_encode($json[0]);