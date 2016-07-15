<?php
/**
 * Created by PhpStorm.
 * User: benajminw5409
 * Date: 10/29/2015
 * Time: 10:10 AM
 */

require "templates/dbConnect.php";

$article_id = $_GET['article_id'];

$sql = "DELETE from articles WHERE article_id=$article_id";

$result = $mysqli->query($sql);

$mysqli->close();

header("location: /article_list.php");


?>
