<?php

session_start();
session_destroy();

header("location: /index.php");

ob_start();

$page_title = "Log Out";


?>

