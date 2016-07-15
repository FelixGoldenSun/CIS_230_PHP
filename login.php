<?php

ob_start();

$page_title = "Log In";

require "templates/header.php";

require "templates/dbConnect.php";

$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$login_submit = $_POST['login_submit'];
$login_error = "";

$sql = "SELECT username, password_hash, email, admin from users WHERE username='$username'";
$result = $mysqli->query($sql);

if($login_submit){
  if($result->num_rows > 0){
    list($username, $password_hash, $email, $admin) = $result->fetch_row();

    if( password_verify($password, $password_hash )){
      $_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
      $_SESSION['admin'] = $admin;
      ob_clean();
      header("location: /index.php");

    }else{
      $login_error = "<h3>Unknown username or password</h3>";
    }
  }else{
    $login_error = "<h3>Unknown username or password</h3>";
  }
}

$login_form = <<<LOGIN_FORM
        <div class="row">
          <div class="12u">
            $login_error
          </div>
        </div>

        <form method="post" action="login.php">

          <div class="row">
            <div class="6u 12u(mobile)">
              Username <input type="text" name="username">
            </div>
            <div class="6u 12u(mobile)">
              Password <input type="password" name="password"><br>
            </div>
          </div>
          <div class="row">
            <div class="12u">
              <input type="submit" name="login_submit" value="login">
            </div>
          </div>
        </form>

LOGIN_FORM;


?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-user"></span>
    <h2><strong>Login</strong></h2>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">

        <?php echo $login_form; ?>


  </section>


</article>



<?php

require "templates/footer.php";

$mysqli->close();

ob_end_flush();

?>

