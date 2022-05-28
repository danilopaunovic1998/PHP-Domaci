<?php

    require "../dbBroker.php";
    require "../model/product.php";

    if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['description']) 
    && isset($_POST['price'])) 
    {
        $product = new Product($_POST['id'], $_POST['title'], $_POST['description'], $_POST['price'], null);
        $status = $product->update($product->productid ,$conn);

        if($status > 0)
        {
            echo 'Success';
            
        }else{

            echo "Failed";

        }

    }

?>