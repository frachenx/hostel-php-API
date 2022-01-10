<?php
require_once("../config.php");
require_once("../Classes/course.php");

$jsonInput = json_decode(file_get_contents("php://input"));

$course = Course::addCourse($jsonInput->code,$jsonInput->shortName,$jsonInput->fullName);
if (!$course){
    $json = array();
    $json[]=array(
        "response" => "false"
    );
    echo json_encode($json);
}else{
    $json = array();
    $json[]=array(
        "response" => "true"
    );
    echo json_encode($json);
}