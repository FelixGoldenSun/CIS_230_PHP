<?php

ob_start();

 $page_title = "Contact Us";

 require "templates/header.php";

 ?>


 <!-- Main -->
 <article id="main">

   <header class="special container">
     <span class="icon fa-envelope"></span>
     <h2>Get In Touch</h2>
     <p>Use the form below to give /dev/null a piece of your mind.</p>
   </header>

   <!-- One -->
   <section class="wrapper style4 special container 75%">

     <!-- Content -->
     <?php

     require "templates/form.php";

     ?>


   </section>

 </article>

 <?php

 require "templates/footer.php";

 ob_end_flush();

 ?>
