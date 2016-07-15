<?php

ob_start();

$page_title = "Products | Edit";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$product_id = $_GET['product_id'];
$submit = $_POST["submit"];

if($submit){
  $name = mysqli_real_escape_string($mysqli, $_POST["name"]);
  $price = mysqli_real_escape_string($mysqli, $_POST["price"]);
  $description = mysqli_real_escape_string($mysqli, $_POST["description"]);
  $cost = mysqli_real_escape_string($mysqli, $_POST["cost"]);
  $qty = mysqli_real_escape_string($mysqli, $_POST["qty"]);
  $category = mysqli_real_escape_string($mysqli,$_POST["category"]);

  if($name == "" || $price == "" || $price <= $cost || $cost == "" || $description == "" || $qty == "" || $qty <= 0){
    ob_clean();
    header("location: /product_edit.php?product_id=$product_id");

  }else{
    $sql = "UPDATE products Set name='$name', description='$description', cost='$cost', qty='$qty', category='$category' WHERE product_id=$product_id;";
    $result = $mysqli->query($sql);

    ob_clean();
    header("location: /send_product_mail.php?product_id=$product_id");
  }

}

echo $mysqli->host_info . "\n";
$sql = "SELECT * from products WHERE product_id=$product_id";
$result = $mysqli->query($sql);
list($product_id, $name, $description, $price, $cost, $qty, $category) = $result->fetch_row();

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-calendar"></span>
    <h2>Calendar</h2>
    <p>This is a calendar.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = product_form("edit", $product_id, $name, $description, $price, $cost, $qty, $category);

        echo $form;
        echo $mysqli->error;

        ?>
        <a href="/products.php?<?php echo $cache_buster ?>">Back to products page</a>
      </div>
    </div>
  </section>

</article>




<?php

$mysqli->close();

require "templates/footer.php";

ob_end_flush();

?>


