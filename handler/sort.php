<?php
  require "../dbBroker.php";
  require "../model/product.php";

  session_start();

  if(isset($_POST['param'])){
    $myArray = Product::sortByName($_POST['param'], $conn);
    //ne radi ovde vrvt
    $_SESSION["proizvodi"] = $myArray;
    echo json_encode($_SESSION["proizvodi"]);
    }   

?>