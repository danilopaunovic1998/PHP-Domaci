<?php

    require "../dbBroker.php";
    require "../model/product.php";

    if(isset($_POST['title']) && isset($_POST['description']) 
    && isset($_POST['price'])) 
    {
        $product = new Product(null, $_POST['title'], $_POST['description'], $_POST['price'], null);
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