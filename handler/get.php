<?php

require "../dbBroker.php";
require "../model/product.php";

if(isset($_POST['id'])){
    $myArray = Product::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}


?>