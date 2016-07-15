<?php

$page_title = "Article | Show";

require "templates/header.php";

require "templates/dbConnect.php";

$article_id = $_GET['article_id'];

$sql = "SELECT * from articles WHERE article_id=$article_id";
$result = $mysqli->query($sql);

?>

<article id="main">
  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Article - Show</h2>
    <p>This articles ID is: <?php echo $article_id ?></p>
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
        echo "<p><strong>Article Text: </strong>" . $row["article_text"] . "</p>";

        ?>
        <a href="/article_list.php?<?php echo $cache_buster ?>">Back to article list</a>

        <?php
        if($_SESSION['username'] != ""){
          echo "<a href='/article_edit.php?article_id=$article_id'>Edit this article</a>";
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


