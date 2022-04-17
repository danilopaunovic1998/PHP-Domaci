<?php

    class Product {

        public $productid;
        public $title;
        public $description;
        public $image;
        public $price;

        public function __construct($productid = null, $title = null, $description = null, $price = null, $image = null)
        {
            $this->productid = $productid;
            $this->title = $title;
            $this->description = $description;
            $this->image = $image;
            $this->price = $price;
        }

        public static function getAll(mysqli $conn)
        {
            $query = "SELECT * FROM product ORDER BY title DESC";
            return $conn->query($query);
        }
    }

?>