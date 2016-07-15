<?php

$page_title = "Articles";

require "templates/header.php";

require "templates/dbConnect.php";

$sql = "SELECT  * from articles ORDER BY date_posted desc";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$article_id = $row["article_id"];

?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2><strong>Articles</strong></h2>
    <p>This is the most current article added</p>
    <p>This articles ID is: <?php echo $article_id ?></p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container ">

    <div class="row">
      <div class="12u">
        <?php

        echo "<p><strong>Title: </strong>" . $row["title"] . "</p>";
        echo "<p><strong>Author: </strong>" . $row["author"] . "</p>";
        echo "<p><strong>Date Posted: </strong>" . $row["date_posted"] . "</p>";
        echo "<p><strong>Article Text: </strong>" . $row["article_text"] . "</p>";

        if($_SESSION['username'] != ""){
          echo "<a href='/article_new.php'>New Article</a> ";
        }
        ?>

        <a href="/article_list.php">Article List</a>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php"

?>

