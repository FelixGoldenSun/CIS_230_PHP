<?php

session_start();

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/dbConnect.php";

$product_id = $_GET['product_id'];

$sql = "DELETE from products WHERE product_id=$product_id";

$result = $mysqli->query($sql);

$mysqli->close();

header("location: /products.php");


?>

