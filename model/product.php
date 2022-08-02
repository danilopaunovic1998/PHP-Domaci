<?php

class Product
{

    public $productid;
    public $title;
    public $description;
    public $image;
    public $price;
    public $typeid;

    public function __construct($productid = null, $title = null, $description = null, $price = null, $image = null, $typeid = null)
    {
        $this->productid = $productid;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->typeid = $typeid;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM product ORDER BY title DESC";
        return $conn->query($query);
    }

    public static function sortByName($parm, mysqli $conn)
    {
        $query = "SELECT * FROM product WHERE title LIKE '$parm%'";
        $myObj = array();
        if ($msqlObj = $conn->query($query)) {
            while ($red = $msqlObj->fetch_array(1)) {
                $myObj[] = $red;
            }
        }
       
        return $myObj;
    }
    
    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM product WHERE productid = $id";
        $myObj = array();
        if ($msqlObj = $conn->query($query)) {
            while ($red = $msqlObj->fetch_array(1)) {
                $myObj[] = $red;
            }
        }

        return $myObj;
    }

    public static function add(Product $product, mysqli $conn)
    {
        $query = "INSERT INTO product(title, description, price, typeid) VALUES('$product->title', '$product->description', '$product->price', '$product->typeid')";
        return $conn->query($query);
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM product WHERE productid = $this->productid";
        return $conn->query($query);
    }

    public function update($id, mysqli $conn)
    {
        $query = "UPDATE product SET title = '$this->title', description = '$this->description', price = '$this->price', typeid = '$this->typeid' WHERE productid = '$id'";
        return $conn->query($query);
    }
}
