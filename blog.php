<?php

$page_title = "Blog";

require "templates/header.php";

require "templates/dbConnect.php";

$sql = "SELECT  * from blogs ORDER BY date_posted desc";
$result = $mysqli->query($sql);
$row = $result->fetch_assoc();
$blog_id = $row["blog_id"];

?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2><strong>Blog</strong></h2>
    <p>This is the most current blog entry</p>
    <p>This blog's ID is: <?php echo $blog_id ?></p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container ">

    <div class="row">
      <div class="12u">
        <?php

        echo "<p><strong>Title: </strong>" . $row["title"] . "</p>";
        echo "<p><strong>Author: </strong>" . $row["author"] . "</p>";
        echo "<p><strong>Date Posted: </strong>" . $row["date_posted"] . "</p>";
        echo "<p><strong>Article Text: </strong>" . $row["blog_text"] . "</p>";

        if($_SESSION['username'] != ""){
          echo "<a href='/blog_new.php'>New Blog</a>";
        }

        ?>
        <a href="/blog_list.php">Blog List</a>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php"

?>

