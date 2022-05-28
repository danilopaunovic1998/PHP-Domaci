<?php

    class Type{

        public $typeid;
        public $name;

        public function __construct($typeid = null, $name = null){
            $this->$typeid = $typeid;
            $this->$name = $name;
        }

        public static function getAll(mysqli $conn){

            $query = "SELECT * FROM type ORDER BY name DESC"; //mozda ne bude radilo ovde! zbog rezervisanih reci
            return $conn->query($query);

        }

        public static function getById(mysqli $conn, $id){
            $query = "SELECT * FROM type WHERE typeid = $id";
            $myObj = array();
            if($msqlObj = $conn->query($query))
            {
                while($red = $msqlObj->fetch_array(1))
                {
                   $myObj[]=$red;         
                }
            }

            return $myObj;
        }
    }

?>