<?php
require_once("../config.php");
require_once("../Classes/student.php");

$student = Student::fromID($_GET['id']);
echo json_encode($student);
