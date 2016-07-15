<?php

ob_start();

$page_title = "Blog | Edit";

require "templates/header.php";

if($_SESSION["admin"] == "false" || $_SESSION["admin"] == ""){
  header("location: /login.php");
}

require "templates/functions.php";

require "templates/dbConnect.php";

$blog_id = $_GET['blog_id'];
$form_submit = $_POST["form_submit"];

if($form_submit){
  $title = mysqli_real_escape_string($mysqli, $_POST["title"]);
  $author = mysqli_real_escape_string($mysqli, $_POST["author"]);
  $date_posted = mysqli_real_escape_string($mysqli, $_POST["date_posted"]);
  $blog_text = mysqli_real_escape_string($mysqli, $_POST["blog_text"]);

  if($title == "" || $author == "" || $date_posted == "" || $blog_text == "") {
    ob_clean();
    header("location: /blog_edit.php?blog_id=$blog_id");
  }else{
    $sql = "UPDATE blogs Set title='$title', author='$author', date_posted='$date_posted', blog_text='$blog_text' WHERE blog_id=$blog_id;";
    $result = $mysqli->query($sql);

    ob_clean();
    header("location: /blog_show.php?blog_id=$blog_id");
  }
}


$sql = "SELECT * from blogs WHERE blog_id=$blog_id";
$result = $mysqli->query($sql);
list($blog_id, $title, $author, $date_posted, $blog_text) = $result->fetch_row();

?>


<article id="main">

  <header class="special container">
    <span class="icon fa-database"></span>
    <h2>Blog - Edit</h2>
    <p>This is the page for editing blog entries.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php

        $form = blog_form("edit", $blog_id, $title, $author, $date_posted, $blog_text);

        echo $form;

        ?>
        <a href="/blog_list.php?<?php echo $cache_buster ?>">Back to the list of blog entries</a>
      </div>
    </div>
  </section>

</article>




<?php

$mysqli->close();

require "templates/footer.php";

ob_end_flush();

?>
