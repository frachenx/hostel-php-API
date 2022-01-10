<?php
require_once("../config.php");
require_once("../Classes/admin.php");
$jsonInput = json_decode(file_get_contents("php://input"));
$username = $jsonInput->username;
$password = $jsonInput->password;

$admin = Admin::Login($username,$password);
if (!$admin){
    //failed to login
    $json = array();
    $json[]=array(
        "response"=>"false"
    );
    echo json_encode($json);
}else{
    //logged in correctly
    $json = array();
    $json[]=array(
        "response"=>"true"
    );
    echo json_encode($json);
}