<?php
session_start();

?>

<!DOCTYPE HTML>
<!--
	Twenty by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
  <title><?php echo $page_title ?></title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!--[if lte IE 8]><script src="/js/ie/html5shiv.js"></script><![endif]-->
  <link rel="stylesheet" href="/css/main.css" />
  <link rel="stylesheet" href="/css/tablesaw.bare.css" />
  <!--[if lte IE 8]><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
  <!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
</head>
<body class="<?php echo $body_class ?>">
<div id="page-wrapper">

  <!-- Header -->
  <header id="header" class="<?php echo $banner_alt ?>">
    <h1 id="logo"><a href="/index.php">Twenty <span>by HTML5 UP</span></a></h1>

    <?php

    require "templates/nav.php";

    ?>
  </header>


