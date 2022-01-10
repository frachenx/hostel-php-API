<?php
require_once("../config.php");
require_once("../Classes/student.php");

$jsonInput = json_decode(file_get_contents("php://input"));

$student = Student::fromData(
    $jsonInput->room,
    $jsonInput->food,
    $jsonInput->stayFrom,
    $jsonInput->duration,
    $jsonInput->course,
    $jsonInput->regNum,
    $jsonInput->fName,
    $jsonInput->mName,
    $jsonInput->lName,
    $jsonInput->gender,
    $jsonInput->contact,
    $jsonInput->email,
    $jsonInput->emContact,
    $jsonInput->guardName,
    $jsonInput->guardRel,
    $jsonInput->guardContact,
    $jsonInput->corrAddress,
    $jsonInput->corrCity,
    $jsonInput->corrState,
    $jsonInput->corrPin,
    $jsonInput->permAddress,
    $jsonInput->permCity,
    $jsonInput->permState,
    $jsonInput->permPin
);
$result = $student->add();

if($result){
    $json=array();
    $json[]=array(
        "response"=>"true"
    );
    echo json_encode($json);
}else{
    $json=array();
    $json[]=array(
        "response"=>"false"
    );
    echo json_encode($json);
}