<?php 
require('Book.php');
if(isset($_GET['id'])){
  $book = Book::getSingleBookById($_GET['id']);

}
?>

<?php 
$title = "Könyvespolc | Belépés";
include('templates/header.php');
?>

<body>
 <?php include('templates/nav.php') ?>
  <main>
    <div class="container">
    <?php if($book): ?>
      <div class="bookdetail m-1 box-s2">
        <div class="text-center p-2 mb-3 bookdetail_head">
          <h4 class="fontsize-3 bookdetail_title"><?php echo $book['name']; ?></h4>
          <p class="fontsize-2 bookdetail_author"><?php echo $book['author']; ?></p>
        </div>
      
        <div class="bookdetail_image">
        <img class="box-s4"src="<?php echo $book['imgUrl']; ?>" alt="<?php echo $book['name']; ?>">
        </div>
        <div class="bookdetail_desc mt-1 mb-3 p-2">
          <p class="fontsize-1">
          <?php echo $book['description']; ?>
          </p>
        </div>
      </div>
    <?php endif ?>
    </div>
  </main>
  <?php include('templates/footer.php') ?>
</body>
</html>