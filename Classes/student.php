<?php
require_once("database.php");
class Student extends database{
    public $id,$room,$food,$stayFrom,$duration,$course,$regNum,$fName,$mName,$lName,$gender,$contact,$email,$emContact,$guardName,$guardRel,$guardContact,$corrAddress,$corrCity,$corrState,$corrPin,$permAddress,$permCity,$permState,$permPin,$room_name,$room_seater,$course_name,$room_fee;

    public static function fromData($room,$food,$stayFrom,$duration,$course,$regNum,$fName,$mName,$lName,   $gender,$contact,$email,$emContact,$guardName,$guardRel,$guardContact,$corrAddress,$corrCity,$corrState,$corrPin,$permAddress,$permCity,$permState,$permPin){
        $instance = new self();
        $instance->room = $room;
        $instance->food = $food;
        $instance->stayFrom = $stayFrom;
        $instance->duration = $duration;
        $instance->course = $course;
        $instance->regNum = $regNum;
        $instance->fName = $fName;
        $instance->mName = $mName;
        $instance->lName = $lName;
        $instance->gender = $gender;
        $instance->contact = $contact;
        $instance->email = $email;
        $instance->emContact = $emContact;
        $instance->guardName = $guardName;
        $instance->guardRel = $guardRel;
        $instance->guardContact = $guardContact;
        $instance->corrAddress = $corrAddress;
        $instance->corrCity = $corrCity;
        $instance->corrState = $corrState;
        $instance->corrPin = $corrPin;
        $instance->permAddress = $permAddress;
        $instance->permCity = $permCity;
        $instance->permState = $permState;
        $instance->permPin = $permPin;
        return $instance;
    }

    public function add(){
        $conn = $this->connect();
        $SQL = "INSERT INTO STUDENTS (
            room_id,
            student_food,
            student_stay_from,
            student_duration,
            course_id,
            student_reg_num,
            student_fname,
            student_mname,
            student_lname,
            student_gender,
            student_contact,
            student_email,
            student_emergency_contact,
            student_guardian_name,
            student_guardian_relation,
            student_guardian_contact_num,
            student_corr_address,
            student_corr_city,
            student_corr_state,
            student_corr_pin,
            student_perm_address,
            student_perm_city,
            student_perm_state,
            student_perm_pin) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
        $stmt = $conn->prepare($SQL);
        if (!$stmt){
            // echo 'QueryFailed' . $conn->error;
            return false;
        }else{
            $stmt->bind_param("ssssssssssssssssssssssss",$this->room,$this->food,$this->stayFrom,$this->duration,$this->course,$this->regNum,$this->fName,$this->mName,$this->lName,$this->gender,$this->contact,$this->email,$this->emContact,$this->guardName,$this->guardRel,$this->guardContact,$this->corrAddress,$this->corrCity,$this->corrState,$this->corrPin,$this->permAddress,$this->permCity,$this->permState,$this->permPin);
            if (!$stmt->execute()){
                // echo 'QueryFailed' . $conn->error;
                return false;
            }else{
                return true;
            }
        }

    }

    public static function delete($id){
        $instance =  new self();
        $conn =  $instance->connect();
        $SQL = "DELETE FROM STUDENTS WHERE student_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        $queryResult = $stmt->execute();
        if(!$queryResult){
            return false;
        }else{
            return true;
        }
    }

    public static function getStudents(){
        $instance = new self();
        $conn =  $instance->connect();
        $SQL = "SELECT students.*, room_num,room_seater FROM STUDENTS, ROOMS WHERE ROOMS.room_id= STUDENTS.room_id";
        $result = $conn->query($SQL);
        if ($result){
            $json=array();
            while($row = $result->fetch_array()){
                $json[] = array(
                    "id"=>$row['student_id'],
                    "fName"=>$row['student_fname'],
                    "mName"=>$row['student_mname'],
                    "lName"=>$row['student_lname'],
                    "regNum"=>$row['student_reg_num'],
                    "contact"=>$row['student_contact'],
                    "room_name"=>$row['room_num'],
                    "room_seater"=>$row['room_seater'],
                    "stayFrom"=>$row['student_stay_from'],
                );
            }
            echo json_encode($json);
        }
    }

    public static function fromID($id){
        $instance =  new self();
        $conn = $instance->connect();
        $SQL = "SELECT students.*, room_num,room_seater,room_fee,course_name_full FROM STUDENTS, ROOMS,courses WHERE ROOMS.room_id= STUDENTS.room_id AND courses.course_id = students.course_id AND student_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        $instance->id = $row['student_id'];
        $instance->room = $row['room_id'];
        $instance->food = $row['student_food'];
        $instance->stayFrom = $row['student_stay_from'];
        $instance->duration = $row['student_duration'];
        $instance->course = $row['course_id'];
        $instance->regNum = $row['student_reg_num'];
        $instance->fName = $row['student_fname'];
        $instance->mName = $row['student_lname'];
        $instance->lName = $row['student_mname'];
        $instance->gender = $row['student_gender'];
        $instance->contact = $row['student_contact'];
        $instance->email = $row['student_email'];
        $instance->emContact = $row['student_emergency_contact'];
        $instance->guardName = $row['student_guardian_name'];
        $instance->guardRel = $row['student_guardian_relation'];
        $instance->guardContact = $row['student_guardian_contact_num'];
        $instance->corrAddress = $row['student_corr_address'];
        $instance->corrCity = $row['student_corr_city'];
        $instance->corrState = $row['student_corr_state'];
        $instance->corrPin = $row['student_corr_pin'];
        $instance->permAddress = $row['student_perm_address'];
        $instance->permCity = $row['student_perm_city'];
        $instance->permState = $row['student_perm_state'];
        $instance->permPin = $row['student_perm_pin'];
        $instance->room_name = $row['room_num'];
        $instance->room_seater = $row['room_seater'];
        $instance->room_fee = $row['room_fee'];
        $instance->course_name = $row['course_name_full'];

        return $instance;

    }

    public static function idFromRegNum($regNum){
        $instance =  new self();
        $SQL = "SELECT * FROM STUDENTS WHERE student_reg_num=?";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$regNum);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows ==0){
            return 0;
        }else{
            $row= $result->fetch_array();
            return $row['student_id'];
        }
    }
}