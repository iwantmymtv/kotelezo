<?php
if (!isset($_SESSION)){
  session_start();
} 
?>
<section>
  <nav id="nav" class="box-s1">
    <div class="nav-image ">
      <a href="index.php">
        <img src="img/book.png" alt="LOGO">
      </a>
    </div>
    <ul class="nav-links">
      <?php if (!isset($_SESSION["user"])) : ?>
        <li><a class="fontsize-1" href="login.php">Belépés</a></li>
        <li><a class="fontsize-1" href="registration.php">Regisztráció</a></li>
      <?php else : ?>
        <li><p class="fontsize-1 greeting">Hello <?php echo $_SESSION["user"]["name"]?>! </p></li>
        <li><a class="fontsize-1" href="addBook.php">Könyv hozzáadás</a></li>
        <li><a class="fontsize-1" href="logout.php">Kijelentkezés</a></li>
        <li><a style="border:none;" href=""><img src="img/star.png" height="20" width="20" alt=""></a></li>
      <?php endif; ?>
    </ul>
  </nav>
</section>