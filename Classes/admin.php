<?php
require_once("database.php");
class Admin extends database
{

    public static function Login($username, $pwd)
    {
        $instance = new self();
        $loggedIn = $instance->LoginAdmin($username, $pwd);
        if (!$loggedIn) {
            return false;
        } else {
            return $instance;
        }
    }

    private function LoginAdmin($username, $pwd)
    {
        $SQL = "SELECT * FROM ADMIN WHERE admin_username=?";
        $conn = $this->connect();
        $stmt = $conn->prepare($SQL);
        if (!$stmt) {
            return false;
        } else {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_array();
            if (password_verify($pwd, $row['admin_password'])) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
}
