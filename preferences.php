<?php

ob_start();

$page_title = "Preferences";

require "templates/header.php";

require "templates/functions.php";

require "templates/dbConnect.php";

$first_name = mysqli_real_escape_string($mysqli, $_POST["first_name"]);
$last_name = mysqli_real_escape_string($mysqli, $_POST["last_name"]);
$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
$newsletters = mysqli_real_escape_string($mysqli, $_POST["newsletters"]);
$form_submit = mysqli_real_escape_string($mysqli, $_POST["form_submit"]);

if($form_submit){
  if($first_name == "" || $last_name == "" || $email == ""){
    $_SESSION["status"] = "There was a error.";
    ob_clean();
    header("location: /preferences.php");

  }else{

    if($newsletters == "checked"){
      $newsletters_checked = "checked";
      $newsletters = "true";
    }else{
      $newsletters = "false";
    }

    $sql = "INSERT into newsletter_users (id, first_name, last_name, email, newsletter_bool) values(null, '$first_name', '$last_name', '$email', '$newsletters')";
    $result = $mysqli->query($sql);
    $blog_id = $mysqli->insert_id;

    $_SESSION["status"] = "Success!";
    ob_clean();
    header("location: /preferences.php");
  }

}


?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-laptop"></span>
    <h2><strong>Preferences</strong></h2>
    <p>Newsletter sign up.</p>
    <p><?php echo $_SESSION["status"] ?></p>
  </header>

    <section class="wrapper style4 special container 75%">
      <div class="row">
        <div class="12u">
          <?php

          $form = <<<END_OF_FORM
            <div id="error_explanation">
              <h2>Validation Errors</h2>
              <ul>
              </ul>
            </div>
            <form method="post" action="/preferences.php" id="data_form">
            <div>
              <label for="first_name">First Name</label>
              <input id="first_name" name="first_name" type="text" value="$first_name" placeholder="First Name">
            </div>
            <div>
              <label for="last_name">Last Name</label>
              <input id="last_name" name="last_name" type="text" value="$last_name" placeholder="Last Name">
            </div>
            <div>
              <label for="email">E-Mail</label>
              <input id="email" name="email" type="text" value="$email" placeholder="E-Mail">
            </div>
            <div>
              <label>Subscribe to Newsletter: </label>
              <input type="checkbox" name="newsletters" value="checked" $newsletters_checked>
            </div>

            <input type="submit" name="form_submit" value="Sign Up">

            </form>
END_OF_FORM;

          echo $form;
          echo $newsletters;

          ?>


        </div>
      </div>
    </section>
</article>

<?php

require "templates/footer.php";

$mysqli->close();

ob_end_flush();

?>

