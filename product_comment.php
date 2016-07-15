<?php

ob_start();

require "templates/dbConnect.php";

require "templates/functions.php";


$product_id = mysqli_real_escape_string($mysqli, $_POST["product_id"]);
$author = mysqli_real_escape_string($mysqli, $_POST["author"]);
$content = mysqli_real_escape_string($mysqli, $_POST["text"]);
$rating = mysqli_real_escape_string($mysqli, $_POST["rating"]);
$submit = $_POST["submit"];


 $modified_date = date_create();
  $modified_date = $modified_date->format('Y-m-d H:i:s');

if($author == "" || $content == "" || $modified_date == "" || $rating > 5 || $rating < 0){
  echo "ERROR";

}else {
  $sql = "INSERT into product_reviews (id, author, content, product_id, created_at, rating) values(null, '$author', '$content', '$product_id', '$modified_date', '$rating')";
  $result = $mysqli->query($sql);

}



ob_clean();
header("location: /product_show.php?product_id=$product_id");

echo $product_id;

echo $sql . "</br>";

$mysqli->close();

ob_end_flush();

?>
