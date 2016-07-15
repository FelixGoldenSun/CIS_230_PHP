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

$name = $faker->catchPhrase;
$price = $faker->randomFloat($nbMaxDecimals = 2);
$description = $faker->text();
$cost = $faker->randomFloat($nbMaxDecimals = 2);
$qty = $faker->randomDigitNotNull;
$category = "car";

$modified_date = date_create();
$modified_date = $modified_date->format('Y-m-d H:i:s');

$sql = "INSERT into products (product_id, name, description, price, cost, qty, category, modified_date) values(null, '$name', '$description', '$price', '$cost', '$qty', '$category', '$modified_date')";
$result = $mysqli->query($sql);
$product_id = $mysqli->insert_id;

echo $product_id;

echo $sql . "</br>";

?>