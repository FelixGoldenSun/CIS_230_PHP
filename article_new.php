<?php

ob_start();

$page_title = "Articles | New";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$title = mysqli_real_escape_string($mysqli, $_POST["title"]);
$author = mysqli_real_escape_string($mysqli,$_POST["author"]);
$article_text = mysqli_real_escape_string($mysqli,$_POST["article_text"]);
$date_posted = mysqli_real_escape_string($mysqli,$_POST["date_posted"]);
$form_submit = mysqli_real_escape_string($mysqli,$_POST["form_submit"]);

if($form_submit){
  $date = date_create();
  $modified_create_date = $date->format('Y-m-d H:i:s');

  $sql = "INSERT into articles (article_id, title, author, article_text, date_posted, created_at, modified_at) values(null, '$title', '$author', '$article_text', '$date_posted', '$modified_create_date', '$modified_create_date')";
  $result = $mysqli->query($sql);
  $article_id = $mysqli->insert_id;

  ob_clean();
  header("location: /article_show.php?article_id=$article_id");
}

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Articles - New</h2>
    <p>Page for creating new article</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = articles_form("new", $article_id, $title, $author, $article_text, $date_posted);

        echo $form;

        ?>
        <a href="/article_list.php?<?php echo $cache_buster ?>">Back to the list of articles</a>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php";

$mysqli->close();

ob_end_flush();

?>

