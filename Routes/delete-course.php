<?php
require_once("../config.php");
require_once("../Classes/course.php");

$id = $_GET['id'];

$result = Course::delete($id);

$json = array();
if ($result){
    $json[]=array(
        "response"=>"true"
    );
}else{
    $json[]=array(
        "response"=>"false"
    );
}

echo json_encode($json);