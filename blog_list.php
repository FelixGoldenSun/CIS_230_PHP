<?php

$page_title = "Blog | List";

require "templates/header.php";

require "templates/dbConnect.php";

$records_per_page = 5;
$page_num = $_GET["page"];

if(empty($page_num)){
  $page_num = 1;
}

$next_page = $page_num + 1;
$prev_page = $page_num - 1;

$sql = "SELECT count(blog_id) from blogs";
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
    <span class="icon fa-database"></span>
    <h2><strong>Blog - List</strong></h2>
    <p>This is a list of the blog entries.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container ">

    <div class="row">
      <div class="12u">
        <?php

        $sql = "SELECT * from blogs LIMIT $records_per_page OFFSET $page";
        $result = $mysqli->query($sql);

        echo "<table class='tablesaw tablesaw-stack' data-tablesaw-mode='stack'><thead><tr><th>Title</th><th>Author</th><th>Date</th></tr></thead>";

        while($row = $result->fetch_assoc()){
          $blog_id = $row["blog_id"];
          echo "<tr>";
          echo "<td><a href='/blog_show.php?blog_id=$blog_id'>" . $row["title"] . "</a></td>";
          echo "<td>" . $row["author"] . "</td>";
          echo "<td>" . $row["date_posted"] . "</td>";

          if($_SESSION['username'] != ""){
            echo "<td><a href='/blog_edit.php?blog_id=$blog_id'>Edit</a></td>";
            echo "<td><a href='/blog_delete.php?blog_id=$blog_id'>Delete</a></td>";
          }

          echo "</tr>";
        }

        echo '</table>'

        ?>


      </div>
    </div>
    <div class="row">
      <div class="6u">
        <a href="/blog_list.php?page=<?php echo $prev_page ?>">Prev Page</a><br>
      </div>
      <div class="6u">
        <a href="/blog_list.php?page=<?php echo $next_page ?>">Next Page</a><br>
      </div>
    </div>

    <?php
      if($_SESSION['admin'] == "true"){
        echo "<a href='/blog_new.php'>New Blog entry</a> ";
      }
    ?>

    <a href="/blog.php">To most current blog entry</a>

  </section>

</article>


<?php

require "templates/footer.php"

?>

