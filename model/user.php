<?php

    class User {
        public $id;
        public $username;
        public $password;
        public $email;

        public function __construct($id=null, $username=null, $email=null, $password=null)
        {
            $this->id = $id;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public function __toString() {
            return "{$this->id} ,{$this->username},{$this->email}  ";
          }

        public static function logInUser($email, $password, mysqli $conn)
        {
            $query = "SELECT * from user where email = '$email' and password='$password'";
            
            return $conn->query($query);
        }
    }

?>