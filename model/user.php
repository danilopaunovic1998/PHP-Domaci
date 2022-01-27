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

        public static function logInUser($email, $password, mysqli $conn)
        {
            $query = "SELECT * from user where `email` = $email and `password` = $password";
            //konekcija sa bazom
            return $conn->query($query);
        }
    }

?>