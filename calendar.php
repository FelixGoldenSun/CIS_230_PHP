<?php

$page_title = "Calendar";

require "templates/header.php";

require "templates/functions.php";

$month = $_GET['month'];
$year = $_GET['year'];

$bob = "bob";

?>

<!-- Main -->
<article id="main">

  <header class="special container">
    <span class="icon fa-calendar"></span>
    <h2>Calendar</h2>
    <p>This is a calendar.</p>
  </header>

  <!-- One -->
  <section class="wrapper style4 special container 75%">
    <div class="row">
      <div class="12u">
        <?php echo miniCalendar($month, $year) ?>
      </div>
    </div>
  </section>

</article>


<?php

require "templates/footer.php";

?>

