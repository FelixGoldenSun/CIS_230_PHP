<?php

$page_title = "Article | List";

require "templates/header.php";

require "templates/dbConnect.php";

?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2><strong>Article - List</strong></h2>
    <p>This is a list of the articles.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container ">

    <div class="row">
      <div class="12u">
        <?php

        $sql = "SELECT * from articles";
        $result = $mysqli->query($sql);

        echo "<table class='tablesaw tablesaw-stack' data-tablesaw-mode='stack'><thead><tr><th>Article ID</th><th>Title</th><th>Author</th><th>Article Text</th><th>Date Posted</th></tr></thead>";

        while($row = $result->fetch_assoc()){
          $article_id = $row["article_id"];
          echo "<tr>";
          echo "<td>" . $row["article_id"] . "</td>";
          echo "<td><a href='/article_show.php?article_id=$article_id'>" . $row["title"] . "</a></td>";
          echo "<td>" . $row["author"] . "</td>";
          echo "<td>" . $row["article_text"] . "</td>";
          echo "<td>" . $row["date_posted"] . "</td>";

          if($_SESSION['username'] != ""){
            echo "<td><a href='/article_edit.php?article_id=$article_id'>Edit</a></td>";
            echo "<td><a href='/article_delete.php?article_id=$article_id'>Delete</a></td>";
          }

          echo "</tr>";
        }

        echo '</table>';

        if($_SESSION['username'] != ""){
          echo "<a href='/article_new.php'>New Article</a>";
        }
        ?>

        <a href="/articles.php">To most current article</a>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php"

?>

