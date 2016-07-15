<?php

  $page_title = "Products";

  require "templates/header.php";

  require "templates/functions.php";

  require "templates/dbConnect.php";

  $records_per_page = 3;
  $page_num = $_GET["page"];

  if(empty($page_num)){
    $page_num = 1;
  }

  $next_page = $page_num + 1;
  $prev_page = $page_num - 1;

  $sql = "SELECT count(product_id) from products";
  $result = $mysqli->query($sql);
  $count = $result->fetch_row()[0];

  if($page_num >= ($count / $records_per_page)){
    $next_page = $page_num;
  }
  else{
    $next_page = $page_num + 1;
  }

  $page = ($page_num - 1) * $records_per_page;


?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-laptop"></span>

    <h2><strong>Products</strong></h2>

    <p>Products</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container ">

    <div class="row">
      <div class="12u">

            <?php

              $sql = "SELECT * from products LIMIT $records_per_page OFFSET $page";
              $result = $mysqli->query($sql);

              echo "<table  class='tablesaw tablesaw-stack' data-tablesaw-mode='stack'><thead><tr><<th>Name</th><th>description</th><th>price</th><th>cost</th><th>qty</th><th>catagory</th><th>image</th></tr></thead>";

              while($row = $result->fetch_assoc()){
                $product_id = $row["product_id"];
                echo "<tr>";
                echo "<td><a href='/product_show.php?product_id=$product_id'>" . $row["name"] . "</a></td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["cost"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td><img src='images/" . $row["thumbnail_image"] . "' alt='Missing Image'></td>";

                if($_SESSION['admin'] == "true"){
                  echo "<td><a href='/product_edit.php?product_id=$product_id'>Edit</a></td>";
                  echo "<td><a href='/product_delete.php?product_id=$product_id'>Delete</a></td>";
                  echo "<td><a href='/send_product_mail.php?product_id=$product_id'>Email</a></td>";
                }

                echo "</tr>";
              }

              echo '</table>'

            ?>
            <a href="/products.php?page=<?php echo $prev_page ?>">Prev Page</a>
            <a href="/products.php?page=<?php echo $next_page ?>">Next Page</a><br>

          <?php
          if($_SESSION['username'] != ""){
            echo "<a href='/product_new.php'>New Product</a>";
          }
          ?>

      </div>
    </div>
  </section>

</article>


<?php

  $mysqli->close();

  require "templates/footer.php"

?>

