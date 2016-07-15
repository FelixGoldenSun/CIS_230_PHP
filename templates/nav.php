
<nav id="nav">
  <ul>
    <li class="current"><a href="/index.php">Welcome</a></li>
    <li class="submenu">
      <a href="#">Navigation</a>
      <ul>
        <li><a href="/test.php">Test</a></li>
        <li><a href="/aboutus.php">About Us</a></li>
        <li><a href="/contactus.php">Contact Us</a></li>
        <li><a href="/products.php">Products</a></li>
        <li><a href="/blog.php">Blog</a></li>
        <li><a href="/calendar.php">Calendar</a></li>
        <li><a href="/articles.php">Articles</a></li>
        <li><a href="/preferences.php">Preferences</a></li>
        <li class="submenu">
          <a href="#">Submenu</a>
          <ul>
            <li><a href="#">Dolore Sed</a></li>
            <li><a href="#">Consequat</a></li>
            <li><a href="#">Lorem Magna</a></li>
            <li><a href="#">Sed Magna</a></li>
            <li><a href="#">Ipsum Nisl</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li>
      <?php
        if(empty($_SESSION['username'])){
          echo" <a href='/login.php' class='button special'>Log In</a>";
        }else{
          echo" <a href='/logout.php' class='button special'>Log Out</a>";
        }
      ?>

    </li>
  </ul>
</nav>
