<?php
require_once("../config.php");
require_once("../Classes/user.php");

$jsonInput = json_decode(file_get_contents('php://input'));

$user =  User::fromID($jsonInput->id);
$result = $user->checkPassword($jsonInput->password);

if ($result){
    $json=array();
    $json[]=array(
        "response"=> "true"
    );
    echo json_encode($json);
}else{
    $json=array();
    $json[]=array(
        "response"=> "false"
    );
    echo json_encode($json);
}