<?php

ob_start();

$page_title = "Products | new";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$name = mysqli_real_escape_string($mysqli,$_POST["name"]);
$price = mysqli_real_escape_string($mysqli,$_POST["price"]);
$description = mysqli_real_escape_string($mysqli,$_POST["description"]);
$cost = mysqli_real_escape_string($mysqli,$_POST["cost"]);
$qty = mysqli_real_escape_string($mysqli, $_POST["qty"]);
$category = mysqli_real_escape_string($mysqli,$_POST["category"]);
$submit = $_POST["submit"];

if($submit){
  $modified_date = date_create();
  $modified_date = $modified_date->format('Y-m-d H:i:s');

  if($name == "" || $price == "" || $price <= $cost || $cost == "" || $description == "" || $qty == "" || $qty <= 0){
    ob_clean();
    header("location: /product_new.php");

  }else{
    $sql = "INSERT into products (product_id, name, description, price, cost, qty, category, modified_date) values(null, '$name', '$description', '$price', '$cost', '$qty', '$category', '$modified_date')";
    $result = $mysqli->query($sql);
    $product_id = $mysqli->insert_id;

    ob_clean();
    header("location: /send_product_mail.php?product_id=$product_id");

  }


}

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Products</h2>
    <p>This is some database stuff.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = product_form("new", $product_id, $name, $description, $price, $cost, $qty, $category);

        echo $form;
        echo $mysqli->error;
        echo $sql;
        ?>
      </div>
    </div>
  </section>

</article>




<?php

require "templates/footer.php";

$mysqli->close();

ob_end_flush();

?>


