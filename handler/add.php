<?php

    require "../dbBroker.php";
    require "../model/product.php";

    if(isset($_POST['title']) && isset($_POST['description']) 
    && isset($_POST['price']) && isset($_POST['category'])) 
    {
        $product = new Product(null, $_POST['title'], $_POST['description'], $_POST['price'], null, $_POST['category']);
        $status = Product::add($product, $conn);

        if($status)
        {
            echo 'Success';
            
        }else{

            echo $status;
            echo "Failed";

        }

    }

?>