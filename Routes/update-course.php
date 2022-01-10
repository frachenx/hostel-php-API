<?php
require_once("../config.php");
require_once("../Classes/course.php");

$jsonInput = json_decode(file_get_contents("php://input"));

$course =  new Course();
$course->id = $jsonInput->id;
$course->code = $jsonInput->code;
$course->shortName = $jsonInput->shortName;
$course->fullName = $jsonInput->fullName;
$course->createdDate = $jsonInput->createdDate;

$result = $course->update();
$json =  array();
if ($result ){
    $json[] = array(
        "response"=>"true"
    );
}else{
    $json[] = array(
        "response"=>"false"
    );
}


echo json_encode($json);