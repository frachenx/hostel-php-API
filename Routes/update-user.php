<?php
require_once("../config.php");
require_once("../Classes/user.php");
$jsonInput = json_decode(file_get_contents("php://input"));

$user =  new User();
// public $id, $regNum, $fName, $mName, $lName, $gender, $contactNum, $email, $pwd;

$user->id = $jsonInput->id;
$user->regNum = $jsonInput->regNum;
$user->fName = $jsonInput->firstName;
$user->mName = $jsonInput->middleName;
$user->lName = $jsonInput->lastName;
$user->gender = $jsonInput->gender;
$user->contactNum = $jsonInput->contactNum;
$user->email = $jsonInput->email;
$user->pwd = $jsonInput->password;

if ($user->updateUser()){
    $json=array();
    $json[]=array(
        "response" => "true"
    );
    echo json_encode($json);
}else{
    $json=array();
    $json[]=array(
        "response" => "false"
    );
    echo json_encode($json);
}
