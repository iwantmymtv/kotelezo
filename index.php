

<?php 
  $title = "Könyvespolc";
  include('templates/header.php');
  require('Book.php');
  $books = array_reverse(Book::getBooks());
?>
<body>
 <?php include('templates/nav.php') ?>
  <main>
    <div class="container">
      <div class="books m-1 box-s2 pb-2 pt-3">
        <?php foreach($books as $book): ?>
          <div class="book ">
            <a href="bookdetail.php?id=<?php echo $book['id'] ?>"><img class="box-s1 book-cover " src="<?php echo htmlspecialchars($book['imgUrl']); ?>" alt=""></a>
            <img class="shelf box-s3"src="img/wood-texture.jpg" alt="">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>
  <?php include('templates/footer.php') ?>

</body>
</html>