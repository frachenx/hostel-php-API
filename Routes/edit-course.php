<?php
require_once("../config.php");
require_once("../Classes/course.php");
$id = $_GET['id'];
$course = Course::courseFromID($id);
$json = array();
$json[] =  array(
    "id" => $course->id,
    "code" => $course->code,
    "shortName" => $course->shortName,
    "fullName" => $course->fullName,
    "createdDate" => $course->createdDate,
);

echo json_encode($json);