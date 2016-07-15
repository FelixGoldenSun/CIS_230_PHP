<?php

$page_title = "Products | Show";

require "templates/header.php";

require "templates/dbConnect.php";

require "templates/functions.php";

$product_id = $_GET['product_id'];
$product_id_form = $product_id;

echo $mysqli->host_info . "\n";
$sql = "SELECT * from products WHERE product_id=$product_id";
$result = $mysqli->query($sql);
$sql = "SELECT AVG(rating) from product_reviews WHERE product_id=$product_id";
$avg_rating = $mysqli->query($sql);
$avg_rating = $avg_rating->fetch_row()[0];
$average_rating_string = "";

if( $avg_rating == 0){
  $average_rating_string .= "There are no ratings";

}else{
  $counter = 0;
  while( round($avg_rating) > $counter){
    $average_rating_string .= "<img src='images/star.jpg' alt='Star'>";
    $counter += 1;
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

        $row = $result->fetch_assoc();
        echo "<p><strong>Product ID: </strong>" . $row["product_id"] . "</p>";
        echo "<p><img src='images/" . $row["image"] . "' alt='Missing Image'></p>";
        echo "<p><strong>Name: </strong>" . $row["name"] . "</p>";
        echo "<p><strong>Description: </strong>" . $row["description"] . "</p>";
        echo "<p><strong>Price: </strong>" . $row["price"] . "</p>";
        echo "<p><strong>Cost: </strong>" . $row["cost"] . "</p>";
        echo "<p><strong>Quantity: </strong>" . $row["qty"] . "</p>";
        echo "<p><strong>Category: </strong>" . $row["category"] . "</p>";
        echo "<p><strong>Rating: </strong>" . $average_rating_string . "</p>";

        echo "<h2>Reviews</h2>";

        $sql = "SELECT count(id) from product_reviews WHERE product_id=$product_id";
        $result = $mysqli->query($sql);
        $count = $result->fetch_row()[0];

        if($count == 0){
          echo "<div class='row'><div class='12u'>There are no reviews</div></div>";

        }else{
          $sql = "SELECT * from product_reviews WHERE product_id=$product_id";
          $result = $mysqli->query($sql);

          echo "<table class='tablesaw tablesaw-stack' data-tablesaw-mode='stack'>";
          echo "<tbody>";

          while( list($id, $author, $content, $product_id, $created_at, $rating) = $result->fetch_row()){
            echo "<tr>";
            echo "<td>$author</td>";
            echo "<td><abbr class='timeago' title='$created_at'></abbr><br>$content</td>";
            echo "</tr><tr>";
            echo "<td></td>";
            echo "<td>";
            echo "Rating: ";

            $counter = 0;
            while ($counter < $rating){
              echo "<img src='images/star.jpg' alt='Star'>";
              $counter += 1;
            }
            echo "</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";

        }


        echo "<h2>Leave a review!</h2>";
        echo comments($product_id_form, "product_id", "/product_comment.php", "Post Review");

        ?>

        <a href="/products.php?<?php echo $cache_buster ?>">Back to products page</a>

        <?php

        if($_SESSION['admin'] == "true"){
          echo "<a href='/product_edit.php?product_id=$product_id_form'>Edit this product</a>";
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


