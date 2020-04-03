<?php
session_start();
require('Validation.php');
require('Book.php');

if (!isset($_SESSION["user"])){
  header('Location: login.php');
} 

if(isset($_POST['add'])){
		
  $validation = new Validator($_POST,$_FILES);
  $errors = $validation->validateBookForm();
 
  if(empty($errors)){
    $target_dir = "img/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $name =  $_POST['name'];
    $author =  $_POST['author'];
    $description =  $_POST['description'];
    $pages =  $_POST['pages'];

    $book = new Book($name,$author,$description,$pages,$target_file);
    $book->saveBook();
    header('Location: index.php');
  }		

} 

?>


<?php 
$title = "Könyvespolc | Hozzáadás";
include('templates/header.php');
?>
<body>
 <?php include('templates/nav.php') ?>
  <main>
    <div class="container">
      <div class="login m-1 mt-2 box-s2 p-2  ">
        <div class="text-center">
          <p class="fontsize-2 m-2">Könyv hozzáadás</p>

        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
          <div >
            <label for="name">Név </label>
            <input type="text" id="name" name="name" placeholder="Név"  value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['name'] ?? '' ?></p>
          </div>
          <div >
            <label for="author">Szersző</label>
            <input type="text" id="author" name="author" placeholder="Szerző"  value="<?php echo htmlspecialchars($_POST['author'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['author'] ?? '' ?></p>
          </div>
          <div >
            <label for="description">Leírás</label>
            <textarea name="description" id="description" placeholder="Leírás" cols="30" rows="10" ><?php echo htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            <p class="fontsize-1 pb-1 error"><?php echo $errors['description'] ?? '' ?></p>
          </div>
          <div >
            <label for="pages">Oldalszám</label>
            <input type="number" id="pages"  min=1 max=1500 name="pages" placeholder="420"  value="<?php echo htmlspecialchars($_POST['pages'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['pages'] ?? '' ?></p>
          </div>
          <div class="mt-1">
            <label for="image">Borítókép:</label>
            <input type="file" name="image" id="coverImage" required accept="image/x-png,image/gif,image/jpeg">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['image'] ?? '' ?></p>
          </div>
        
          
          <div class="text-center mt-2 mb-2">
            <button type="submit" name="add" class="btn">Hozzáadás</button>

          </div>
        </form>
      </div>
    </div>
  </main>
  <?php include('templates/footer.php') ?>

</body>
</html>