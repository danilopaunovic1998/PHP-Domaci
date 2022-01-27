<?php
$host = "localhost";
$db = "phpdomaci";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,$db);

if($conn -> connect_errno)
{
    exit("Neuspesna konekcija sa bazom ". $conn->connect_error);
}
?>