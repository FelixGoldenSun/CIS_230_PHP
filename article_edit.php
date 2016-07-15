<?php

ob_start();

$page_title = "Articles | Edit";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$article_id = $_GET['article_id'];
$modified_date = date_create();
$modified_at = $modified_date->format('Y-m-d H:i:s');
$form_submit = $_POST["form_submit"];

if($form_submit){
  $title = mysqli_real_escape_string($mysqli, $_POST["title"]);
  $author = mysqli_real_escape_string($mysqli, $_POST["author"]);
  $article_text = mysqli_real_escape_string($mysqli, $_POST["article_text"]);
  $date_posted = mysqli_real_escape_string($mysqli, $_POST["date_posted"]);

  $sql = "UPDATE articles Set title='$title', author='$author', article_text='$article_text', date_posted='$date_posted', modified_at='$modified_at' WHERE article_id=$article_id;";
  $result = $mysqli->query($sql);

  ob_clean();
  header("location: /article_show.php?article_id=$article_id");

}

$sql = "SELECT * from articles WHERE article_id=$article_id";
$result = $mysqli->query($sql);
list($article_id, $title, $author, $article_text, $date_posted) = $result->fetch_row();

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Articles - Edit</h2>
    <p>This is the page for editing stuff.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = articles_form("edit", $article_id, $title, $author, $article_text, $date_posted);

        echo $form;

        ?>
        <a href="/article_list.php?<?php echo $cache_buster ?>">Back to the list of articles</a>
      </div>
    </div>
  </section>

</article>




<?php

$mysqli->close();

require "templates/footer.php";

ob_end_flush();

?>
