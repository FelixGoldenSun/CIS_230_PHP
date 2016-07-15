<?php

$page_title = "Blog | Show";

require "templates/header.php";

require "templates/functions.php";

require "templates/dbConnect.php";

$blog_id = $_GET['blog_id'];
$blog_id_form = $blog_id;

$sql = "SELECT * from blogs WHERE blog_id=$blog_id";
$result = $mysqli->query($sql);
$sql = "SELECT AVG(rating) from blog_comments WHERE blog_id=$blog_id";
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
    <h2>Blog - Show</h2>
    <p>This blog's ID is: <?php echo $blog_id ?></p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php
        $row = $result->fetch_assoc();

        echo "<p><strong>Title: </strong>" . $row["title"] . "</p>";
        echo "<p><strong>Author: </strong>" . $row["author"] . "</p>";
        echo "<p><strong>Date Posted: </strong>" . $row["date_posted"] . "</p>";
        echo "<p><strong>Average Rating: </strong>" . $average_rating_string . "</p>";
        echo "<p><strong>Blog Text: </strong>" . $row["blog_text"] . "</p>";

        echo "<h2>Reviews</h2>";

        $sql = "SELECT count(id) from blog_comments WHERE blog_id=$blog_id";
        $result = $mysqli->query($sql);
        $count = $result->fetch_row()[0];

        if($count == 0){
          echo "<div class='row'><div class='12u'>There are no comments</div></div>";

        }else{
          $sql = "SELECT * from blog_comments WHERE blog_id=$blog_id";
          $result = $mysqli->query($sql);

          echo "<table class='tablesaw tablesaw-stack' data-tablesaw-mode='stack'>";
          echo "<tbody>";

          while( list($id, $author, $comment_text, $rating, $created_date, $blog_id) = $result->fetch_row()){
            echo "<tr>";
            echo "<td>$author</td>";
            echo "<td><abbr class='timeago' title='$created_date'></abbr><br>$comment_text</td>";
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

        echo "<h2>Leave a comment!</h2>";
        echo comments($blog_id_form, "blog_id", "/blog_comment.php", "Post Comment");

        ?>
        <a href="/blog_list.php?<?php echo $cache_buster ?>">Back to list of blog entries</a>

        <?php
        if($_SESSION['admin'] == "true"){
          echo "<a href='/blog_edit.php?blog_id=$blog_id_form'>Edit this blog entry</a>";
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


