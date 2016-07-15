<?php

ob_start();

require "templates/dbConnect.php";

require "templates/functions.php";


$blog_id = mysqli_real_escape_string($mysqli, $_POST["blog_id"]);
$author = mysqli_real_escape_string($mysqli, $_POST["author"]);
$comment_text = mysqli_real_escape_string($mysqli, $_POST["text"]);
$rating = mysqli_real_escape_string($mysqli, $_POST["rating"]);
$submit = $_POST["post_comment"];

 $created_date = date_create();
$created_date = $created_date->format('Y-m-d H:i:s');

if($author == "" || $comment_text == "" || $created_date == "" || $rating > 5 || $rating < 0){
    echo "ERROR";

}else {

    $sql = "INSERT into blog_comments (id, author, comment_text, rating, created_date, blog_id) values(null, '$author', '$comment_text', '$rating', '$created_date', '$blog_id')";
    $result = $mysqli->query($sql);

}

ob_clean();
header("location: blog_show.php?blog_id=$blog_id");


$mysqli->close();

ob_end_flush();

?>
