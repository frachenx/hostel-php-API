<?php
require_once("../config.php");
require_once("../Classes/user.php");
$jsonInput = json_decode(file_get_contents('php://input'));

$user =  User::fromID($jsonInput->id);
$user->pwd = password_hash($jsonInput->password,PASSWORD_BCRYPT);
if($user->updateUser()){
    $json = array();
    $json[]=array(
        "response"=> "true"
    );
    echo json_encode($json);
}else{
    $json = array();
    $json[]=array(
        "response"=> "false"
    );
    echo json_encode($json);
}
