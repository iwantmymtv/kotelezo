<?php

  require('User.php');
  require('Validation.php');


	if(isset($_POST['registration'])){
		
      $validation = new Validator($_POST);
      $errors = $validation->validateRegistrationForm();
      if(empty($errors)){
        $email = $_POST['email'];
        $name =  $_POST['name'];
        $password1=  $_POST['password1'];

        $user = new User($email,$name,$password1);
        $user->saveUser();
        header('Location: index.php');
      }		

	} 

?>


<?php 
$title = "Könyvespolc | Regisztráció";
include('templates/header.php');
?>
<body>
 <?php include('templates/nav.php') ?>
 <main>
    <div class="container">
      <div class="login m-1 mt-2 box-s2 p-2  ">
        <div class="text-center">
          <p class="fontsize-2 m-2">Regisztráció</p>

        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div >
            <label for="email" >Email </label>
            <input type="email" id="email" name="email" placeholder="email@email.hu" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['email'] ?? '' ?></p>
          </div>
          <div >
            <label for="name">Név</label>
            <input type="text" id="name" name="name" placeholder="Név" value="<?php echo htmlspecialchars($_POST['name'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['name'] ?? '' ?></p>
          </div>
          <div >
            <label for="password1">Jelszó</label>
            <input type="password" id="password1" name="password1" placeholder="*********" value="<?php echo htmlspecialchars($_POST['password1'] ?? '') ?>">
            <p>A jelszó legalább 8 karakter legyen</p>
            <p>A jelszónak legalább 1 számot kell tartalmaznia</p>
            <p class="mb-1">A jelszónak legalább 1 Nagy betűt kell tartalmaznia</p>
          </div>
          <div >
            <label for="password2">Jelszó mégegyszer</label>
            <input type="password" id="password2" name="password2" placeholder="*********" value="<?php echo htmlspecialchars($_POST['password2'] ?? '') ?>">
            <p class="fontsize-1 pb-1 error"><?php echo $errors['password'] ?? '' ?></p>
          </div>
          
          <div class="text-center mt-2">
            <button name="registration" type="submit"  >Regisztráció</button>

          </div>
        </form>
      </div>
    </div>
  </main>
  <?php include('templates/footer.php') ?>

</body>
</html>