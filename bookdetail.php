<?php 
require('Book.php');
require('User.php');

if(isset($_GET['id'])){
  $book = Book::getSingleBookById($_GET['id']);
  $books = Book::getBooks();
  foreach($books as $key=>$value){
    if ($value['id'] == $_GET['id'] ){
      $index = $key;
    }
  }
  array_splice($books,$index,1);
  shuffle($books);
  $otherbooks =array_splice($books,0,3);
}
if (!isset($_SESSION)){
  session_start();
} 

if (isset($_SESSION["user"])){
  $user = User::getSingleUserById($_SESSION["user"]['id']);
  $favs = $user['favorites'];
} else{
  $favs = [];
}

?>

<?php 
$title = "Könyvespolc | ". $book['name'];
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
        <div class="text-center bookdetail_pages p-1">
          <p>Oldalszám: <?php echo $book['pages']; ?></p>
        </div>

        <div class="bookdetail_desc mt-1 mb-3 p-2">
          <p class="fontsize-1">
          <?php echo $book['description']; ?>
          </p>
        </div>
        <div class="text-center" style="font-style:italic;">
        <p class="fontsize-1 mt-1 " ><?php echo  count($book['favedBy']); ?> ember kedvence</p>
        </div>
        <div class="bookdetail_favourite text-center p-2">
          
          <!-- Ellenorzi hogy be vagy e jelentkezve -->
          <?php if (isset($_SESSION["user"])) : ?>
           <!--  kedvencek közt van e mar -->
            <?php if (in_array($book['id'],$favs)): ?>
              <a href="favorites.php" class="btn btn-green">Kedvenced</a>
            <?php else : ?>
              <a href="addToFavs.php?id=<?php echo $book['id'] ?>" class="btn btn-green">Hozzáadás kedvencekhez</a>
            <?php endif; ?>
            <button id="myBtn">Könyv törlése</button>

          <?php else: ?>
            <a href="login.php" class="btn btn-green">Hozzáadás kedvencekhez</a>  
          <?php endif; ?>
        </div>
        
      </div>

        <?php if($otherbooks): ?>
        <div class="other-books m-1 mt-2 mb-3 box-s2">
          <h4 class="fontsize-2 p-3">Egyéb könyvek:</h4>
          <div class="other-books_grid ">
            <?php foreach($otherbooks as $ob): ?>
              <div>
                <a class="other-books_link pb-2" href="bookdetail.php?id=<?php echo $ob['id'] ?>">
                  <img src="<?php echo $ob['imgUrl']; ?>" alt="<?php echo $book['name']; ?>">
                </a>
              </div> 
            <?php endforeach ?>
          </div>
          
        </div>
        <?php endif ?>

    <?php endif ?>
    </div>

    <?php if (isset($_SESSION["user"])) : ?>
    <div id="removeModal" class="modal">

      <div class="modal-content box-s4">
        <span class="close">&times;</span>
        <div class="text-center modal-text">
          <p class="fontsize-1">Biztosan törölni szertnéd a  <span style="font-style:italic;"><?php echo $book['name']; ?> </span>  című könyvet?</p>
          <a class="btn btn-green mt-2" href="removeBook.php?id=<?php echo $book['id'] ?>">Igen</a>
        </div>
      </div>

    </div>
    <?php endif ?>
  </main>
  <?php include('templates/footer.php') ?>

  <?php if (isset($_SESSION["user"])) : ?>
  <script>
    var modal = document.getElementById("removeModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <?php endif ?>
</body>


</html>