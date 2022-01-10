<?php
require_once("database.php");
class User extends database{
    public $id, $regNum, $fName, $mName, $lName, $gender, $contactNum, $email, $pwd;
    
    public static function Login($userEmail,$userPassword){
        $instance =  new self();
        $loggedIn = $instance->UserLogin($userEmail,$userPassword);
        if (!$loggedIn){
            return false;
        }else{
            return $instance;
        }
    }

    private function UserLogin($userEmail,$userPassword){
        $SQL = "SELECT * FROM USERS WHERE user_email= ? ";
        $conn = $this->connect();
        if ($conn){
            $stmt = $conn->prepare($SQL);
            if ($stmt){
                $stmt->bind_param("s",$userEmail);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_array();
                $hPwd = $row['user_password'];
                if (password_verify($userPassword,$hPwd)){
                    //logged in
                    $this->id = $row['user_id'];
                    $this->fName = $row['user_fname'];
                    $this->mName = $row['user_mname'];
                    $this->lName = $row['user_lname'];
                    $this->gender = $row['user_gender'];
                    $this->contactNum = $row['user_contact_num'];
                    $this->email = $row['user_email'];
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function fromID($id){
        $instance = new self();
        $SQL ="SELECT * FROM USERS WHERE user_id=?";
        $conn = $instance->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_array();
        $instance->id=$row['user_id'];
        $instance->regNum=$row['user_reg_num'];
        $instance->fName=$row['user_fname'];
        $instance->mName=$row['user_mname'];
        $instance->lName=$row['user_lname'];
        $instance->gender=$row['user_gender'];
        $instance->contactNum=$row['user_contact_num'];
        $instance->email=$row['user_email'];
        $instance->pwd=$row['user_password'];
        return $instance;
    }

    public function updateUser(){
        $SQL = "UPDATE USERS SET user_reg_num=?,user_fname=?,user_mname=?,user_lname=?,user_gender=?,user_contact_num=?,user_email=?,user_password=? WHERE user_id=?";
        $conn =  $this->connect();
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("sssssssss",$this->regNum,$this->fName,$this->mName,$this->lName,$this->gender,$this->contactNum,$this->email,$this->pwd,$this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function checkPassword($password){
        $conn = $this->connect();
        $SQL = "SELECT user_password FROM USERS where user_id=?";
        $stmt = $conn->prepare($SQL);
        $stmt->bind_param("s",$this->id);
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows>0){
                $row = $result->fetch_array();
                $oldPassword = $row['user_password'];
                return password_verify($password,$oldPassword);
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}