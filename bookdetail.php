<?php 
require('Book.php');
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

        <div class="bookdetail_favourite text-center p-2">
          <a href="#" class="btn btn-green">Hozzáadás kedvencekhez</a>
          <button id="myBtn">Könyv törlése</button>
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
  </main>
  <?php include('templates/footer.php') ?>

  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content box-s4">
  <span class="close">&times;</span>
  <p>Some text in the Modal..</p>
</div>

</div>
<script>
  // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>


</html>