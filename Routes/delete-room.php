<?php
require_once("../config.php");
require_once("../Classes/room.php");

$id = $_GET['id'];

$result = Room::delete($id);

if ($result){
    $json = array();
    $json[]=array(
        "response"=>"true"
    );
    echo json_encode($json);
}else{
    $json = array();
    $json[]=array(
        "response"=>"false"
    );
    echo json_encode($json);
}