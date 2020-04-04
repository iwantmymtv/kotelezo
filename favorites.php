<?php 
require('Book.php');
require('User.php');

if (!isset($_SESSION)){
  session_start();
} 
if (!isset($_SESSION["user"])){
  header('Location: index.php');
}else{
  $user = User::getSingleUserById($_SESSION["user"]['id']);
  $favIds = $user['favorites'];
  $favs = [];
  foreach($favIds as $id){
    array_push($favs,Book::getSingleBookById($id));
  }
}

?>

<?php 
$title = "Könyvespolc | Kedvencek";
include('templates/header.php');
?>

<body>
 <?php include('templates/nav.php') ?>
  <main>
    <div class="container">
      <div class="favorites m-1 mb-3 ">
        <h2 class="fontsize-2 mt-2 mb-3">Kedvenc könyvek (<?php echo count($favs); ?>):</h2>
        <?php foreach($favs as $f): ?>
        <div class="favorites-single box-s2">
          <a href="bookdetail.php?id=<?php echo $f['id'] ?>">
            <img class="box-s2" src="<?php echo $f['imgUrl']; ?>" alt="">
          </a>
          <div class="favorites-single_detail">
            <p class="fontsize-2" ><?php echo $f['name']; ?></p>
            <p class="fontsize-1"><?php echo $f['author']; ?></p>
            <a class="btn btn-red mt-2" href="removeFromFav.php?id=<?php echo $f['id'] ?>">
              Eltávolítás a kedvencekből
             </a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

  </main>
  <?php include('templates/footer.php') ?>


</body>


</html>