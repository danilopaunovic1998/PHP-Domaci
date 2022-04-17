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

        public static function getById($id, mysqli $conn)
        {
            $query = "SELECT * FROM product WHERE id = $id";
            $myObj = array();
            if($msqlObj = $conn->query($query))
            {
                while($red = $msqlObj->fetch_array(1))
                {
                   $myObj=$red;         
                }
            }
        }

        public static function add(Product $product, mysqli $conn)
        {
            $query = "INSERT INTO product(title, description, price) VALUES('$product->title', '$product->description', '$product->price')";
            return $conn->query($query);
        }

        public function deleteById(mysqli $conn)
        {
            $query = "DELETE FROM product WHERE id = $this->id";
            return $conn->query($query);
        }
        
        public function update($id, mysqli $conn)
        {
            $query = "UPDATE product SET title = $this->title, description = $this->description, price = $this->price WHERE id = $id";
            return $conn->query($query);
        }
    }

?>