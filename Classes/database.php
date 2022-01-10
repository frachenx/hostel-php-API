<?php

class database{
    public function connect(){
        $conn = mysqli_connect("localhost","root","","hostel2");
        return $conn;
    }
}