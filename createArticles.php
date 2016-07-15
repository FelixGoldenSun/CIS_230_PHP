<?php
/**
 * Created by PhpStorm.
 * User: benajminw5409
 * Date: 11/3/2015
 * Time: 9:45 AM
 */

require_once 'autoload.php';

require "templates/dbConnect.php";

$faker = Faker\Factory::create();

$title = $faker->sentence($nbWords = 4);
$author = $faker->name;
$article_text = $faker->paragraph($nbSentences = 3);

$modified_date = date_create();
$modified_date = $modified_date->format('Y-m-d H:i:s');

$sql = "INSERT into articles(article_id, title, author, article_text, date_posted, created_at, modified_at) values(null, '$title', '$author', '$article_text', '$modified_date', '$modified_date', '$modified_date')";
$result = $mysqli->query($sql);
$article_id = $mysqli->insert_id;

echo $article_id;

echo $sql . "</br>";

?>