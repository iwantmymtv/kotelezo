<?php 



?>


<!DOCTYPE html>
<html lang="hu">
<?php 
$title = "Könyvespolc";
include('templates/header.php');
?>
<body>
 <?php include('templates/nav.php') ?>
  <main>
    <div class="container">
      <div class="books m-1 box-s2 pb-2 pt-3">
        <div class="book ">
          <p class="fontsize-2 ">1984</p>
          <p class="fontsize-1 mb-1">George Orwell</p>
          <a href="bookdetail.html"><img class="box-s1 book-cover" src="img/1984.jpg" alt=""></a>
          <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
        </div>
        <div class="book ">
          <p class="fontsize-2 ">Superintelligence</p>
          <p class="fontsize-1 mb-1">Nick Bostrom</p>
          <a href="bookdetail.html"><img class="box-s1 book-cover" src="img/super.jpeg" alt=""></a>
          <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
        </div>
        <div class="book ">
          <p class="fontsize-2 ">1984</p>
          <p class="fontsize-1 mb-1">George Orwell</p>
          <a href="bookdetail.html"><img class="box-s1 book-cover" src="img/simu.jpg" alt=""></a>
          <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
        </div>
        <div class="book ">
          <p class="fontsize-2 ">1984</p>
          <p class="fontsize-1 mb-1">George Orwell</p>
          <a href="bookdetail.html"><img class="box-s1 book-cover" src="img/1984.jpg" alt=""></a>
          <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
        </div>
        <div class="book ">
          <p class="fontsize-2 ">1984</p>
          <p class="fontsize-1 mb-1">George Orwell</p>
          <a href="bookdetail.html"><img class="box-s1 book-cover" src="img/1984.jpg" alt=""></a>
          <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
        </div>
       
        
      </div>
    </div>
  </main>
  <?php include('templates/footer.php') ?>

</body>
</html>