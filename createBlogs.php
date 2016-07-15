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

$counter = 0;

while($counter < 20){
    $title = $faker->sentence($nbWords = 4);
    $author = $faker->name;
    $blog_text = $faker->paragraph($nbSentences = 3);

    $date_posted = date_create();
    $date_posted = $date_posted->format('Y-m-d');

    $sql = "INSERT into blogs(blog_id, title, author, date_posted, blog_text) values(null, '$title', '$author', '$date_posted', '$blog_text')";
    $result = $mysqli->query($sql);
    $blog_id = $mysqli->insert_id;

    echo $blog_id;

    echo $sql . "</br>";
    $counter += 1;
}


?>