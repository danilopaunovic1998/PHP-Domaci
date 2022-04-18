<?php

    require "../dbBroker.php";
    require "../model/product.php";

    if(isset($_POST['id'])){
        $obj = new Product($_POST['id']);
        $status = $obj->deleteById($conn);
        if($status)
        {
            echo "Success";
        }
        else{
            echo "Failed";
        }
    }

?>