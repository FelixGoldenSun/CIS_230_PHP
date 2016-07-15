<?php


echo mail($username, "Welcome!", "Welcome, your user name is:" . $username, "From: info@phpdev.chesthighwalls.com\r\n");