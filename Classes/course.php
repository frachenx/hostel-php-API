<?php
require_once("database.php");

class Course extends database{
    public $id,$code,$shortName,$fullName,$createdDate;

    public function __construct(){
    }
    
    public static Function addCourse($code_,$shortName_,$fullName_){
        $instance =  new self();
        $date = date("Y-m-d h:i:s");
        $SQL = "INSERT INTO COURSES (course_code,course_name_short,course_name_full,course_created_date) VALUES(?,?,?,?)";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        if ($stmt){
            $stmt->bind_param("ssss",$code_,$shortName_,$fullName_,$date);
            $result = $stmt->execute();
            // $result = $stmt->get_result();
            if($result){
                $instance->code = $code_;
                $instance->shortName = $shortName_;
                $instance->fullName = $fullName_;
                $instance->createdDate = date("Y-m-d h:i:s");
                return $instance;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getCourses(){
        $instance =  new self();
        $SQL = "SELECT * FROM COURSES";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result){
            $json=array();
            while($row = $result->fetch_array()){
                $json[] = array(
                    "id"=>$row['course_id'],
                    "code"=>$row['course_code'],
                    "shortName"=>$row['course_name_short'],
                    "fullName"=>$row['course_name_full'],
                    "createdDate"=>$row['course_created_date'],

                );
            }
            echo json_encode($json);
        }
    }

    public static function courseFromID($id){
        $instance =  new self();
        $SQL = "SELECT * FROM COURSES WHERE course_id=?";
        $conn = $instance->connect();
        $stmt =  $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if ($result){
                $row = $result->fetch_array();
                if($row){
                    $instance->id=$row['course_id'];
                    $instance->code=$row['course_code']; 
                    $instance->shortName=$row['course_name_short'];
                    $instance->fullName=$row['course_name_full'];
                    $instance->createdDate=$row['course_created_date'];
                    return $instance;
                }
            }
        }
        return false;
    }

    public function update(){
        $SQL = "UPDATE COURSES SET course_code=?, course_name_short=?, course_name_full=? WHERE course_id=?";
        $conn = $this->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("ssss",$this->code,$this->shortName,$this->fullName,$this->id);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public static function delete($id){
        $instance =  new self();
        $SQL = "DELETE FROM COURSES WHERE course_id=?";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
