<?php

function SendProductInfo( $first_name, $last_name, $newsletter_user_email, $name, $description, $price){
  $to = $newsletter_user_email;
  $subject = "Product info: $name";
  $message = "<p>Hello $first_name $last_name!<br>";
  $message .= "You signed up for our newsletter, and we have a new/updated product!</p>";
  $message .= "<p>Name of product: $name</p>";
  $message .= "<p>Description: $description</p>";
  $message .= "<p>price: $price</p>";
  $headers = "From: info@phpdev.chesthighwalls.com\r\n";
  $headers .= "Content-type: text/html\r\n";;

  mail($to, $subject, $message, $headers);

}


require "templates/dbConnect.php";

$product_id = $_GET["product_id"];

$sql = "SELECT * from products WHERE product_id=$product_id";
$result = $mysqli->query($sql);

list($product_id, $name, $description, $price, $cost, $qty, $category) = $result->fetch_row();

$sql = "SELECT first_name, last_name, email from newsletter_users WHERE newsletter_bool='true'";
$result = $mysqli->query($sql);


while($newsletter_info = $result->fetch_array(MYSQLI_NUM)){
  SendProductInfo($newsletter_info[0], $newsletter_info[1], $newsletter_info[2], $name, $description, $price);
}


header("location: /product_show.php?product_id=$product_id");

$mysqli->close();

?>