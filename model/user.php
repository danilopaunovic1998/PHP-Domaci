<?php

    class User {
        public $id;
        public $username;
        public $password;
        public $email;

        public function __construct($id=null,$username=null,$password=null,$email=null)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public static function logInUser($usr, mysqli $conn)
        {
            $query = "SELECT * from user where email = '$usr->email' and password='$usr->password'";
            
            return $conn->query($query);
        }
    }

?>