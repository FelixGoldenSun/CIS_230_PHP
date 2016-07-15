<?php
/**
 * Created by PhpStorm.
 * User: benajminw5409
 * Date: 11/23/2015
 * Time: 9:45 AM
 */


$to      = 'benawalls@gmail.com';
$subject = 'TEST';
$message = 'hello world!';
$headers = "From: info@phpdev.chesthighwalls.com\r\n";


echo mail($to, $subject, $message, $headers);

?>


