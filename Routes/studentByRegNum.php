<?php
require_once("../config.php");
require_once("../Classes/student.php");

$id = Student::idFromRegNum($_GET['regNum']);

$json=array();

if ($id==0){
    $json[] = array(
        "id" => "0"
    );
    echo json_encode($json[0]);
     
}else{
    $student = Student::fromID($id);
    echo json_encode($student);
}