<?php

ob_start();

$page_title = "Blog | New";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$title = mysqli_real_escape_string($mysqli, $_POST["title"]);
$author = mysqli_real_escape_string($mysqli,$_POST["author"]);
$blog_text = mysqli_real_escape_string($mysqli,$_POST["blog_text"]);
$date_posted = mysqli_real_escape_string($mysqli,$_POST["date_posted"]);
$form_submit = mysqli_real_escape_string($mysqli,$_POST["form_submit"]);

if($form_submit){
  if($title == "" || $author == "" || $date_posted == "" || $blog_text == ""){
    ob_clean();
    header("location: /blog_new.php");

  }else{
    $sql = "INSERT into blogs (blog_id, title, author, date_posted, blog_text) values(null, '$title', '$author', '$date_posted', '$blog_text')";
    $result = $mysqli->query($sql);
    $blog_id = $mysqli->insert_id;

    ob_clean();
    header("location: /blog_show.php?blog_id=$blog_id");
  }

}

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Blog - New</h2>
    <p>Page for creating a new blog entry</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = blog_form("new", $blog_id, $title, $author, $date_posted, $blog_text);

        echo $form;

        ?>
        <a href="/blog_list.php?<?php echo $cache_buster ?>">Back to the list of blog entries</a>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php";

$mysqli->close();

ob_end_flush();

?>

