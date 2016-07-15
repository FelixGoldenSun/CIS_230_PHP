<?php
/**
 * Created by PhpStorm.
 * User: benajminw5409
 * Date: 11/23/2015
 * Time: 9:59 AM
 */

session_start();

if ($_SESSION["email"] != ""){
  $to = $_SESSION["email"];
  $subject = "Thank You!";
  $message = "Thank you for contacting us!";

  $headers = "From: info@phpdev.chesthighwalls.com\r\n";
  $headers .= "Content-type: text/html\r\n";;

  mail($to, $subject, $message, $headers);
}


header("location: /index.php");


?>