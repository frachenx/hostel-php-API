<?php
require_once("../config.php");
require_once("../Classes/user.php");

$jsonInput = json_decode(file_get_contents("php://input"));

$username = $jsonInput->username;
$password = $jsonInput->password;

$user= User::Login($username,$password);

if (!$user){
    //Failed to login
    $json=array();
    $json[]=array(
        "id" =>0,
        "response"=>"false"
    );
    echo json_encode($json);
}else{
    //Succesfully logged in
    $json=array();
    $json[]=array(
        "id" => $user->id, 
        "response"=>"true"
    );
    echo json_encode($json);
}

