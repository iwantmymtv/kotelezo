<?php

  require('User.php');
  require('Validation.php');

	if(isset($_POST['login'])){
		
      $validation = new Validator($_POST);
      $errors = $validation->validateLoginForm();
      
      if(empty($errors)){
        $user = User::getSingleUserByEmail($_POST['email']);
        session_start();
        $_SESSION["user"] = $user;
        header('Location: index.php');
      }		

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
      <div class="login m-1 mt-2 box-s2 p-2  ">
        <div class="text-center">
          <p class="fontsize-2 m-2">Belépés</p>

        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div >
            <label for="email">Email </label>
            <input type="email" id="email" name="email" placeholder="email@email.hu"  value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['email'] ?? '' ?></p>
          </div>
          <div >
            <label for="password">Jelszó</label>
            <input type="password" id="password" name="password"  placeholder="*********" value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['password'] ?? '' ?></p>
          </div>
          
          <div class="text-center mt-2">
            <button type="submit" name="login" class="btn">Belépés</button>

          </div>
        </form>
      </div>
    </div>
  </main>
  <?php include('templates/footer.php') ?>

</body>
</html>