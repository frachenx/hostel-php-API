<?php
require_once("../config.php");
require_once("../Classes/user.php");

$user = User::fromID($_GET['id']);
// echo json_encode($user);

$json = array();
$json[] = array(
    "id" => $user->id,
    "regNum"=> $user->regNum,
    "firstName" => $user->fName,
    "middleName" => $user->mName,
    "lastName" => $user->lName,
    "gender" => $user->gender,
    "contactNum" => $user->contactNum,
    "email" => $user->email,
    "password" => $user->pwd
);
$jsonString = $json[0];

echo json_encode($jsonString);
