<?php
session_start();

require "templates/dbConnect.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

$blog_id = $_GET['blog_id'];

$sql = "DELETE from blogs WHERE blog_id=$blog_id";

$result = $mysqli->query($sql);

$mysqli->close();

header("location: /blog_list.php");


?>
