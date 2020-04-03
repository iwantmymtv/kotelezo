<?php 
require_once('User.php');

class Validator {

  private $data;
  private $files;
  private $errors = [];

  public function __construct($post_data,$files = null){
    $this->data = $post_data;
    $this->files = $files;
  }

  private function addError($key, $val){
    $this->errors[$key] = $val;
  }


  public function validateRegistrationForm(){

    $this->validateName();
    $this->validateEmail();
    $this->validatePassword();
    return $this->errors;
  }

  public function validateLoginForm(){
    $this->validateUser();
    return $this->errors;
  }

  public function validateBookForm(){
    $this->validateName();
    $this->validateBook();
    $this->validateImage();
    return $this->errors;
  }
 

  private function charLenValidator($obj,$name,$num,$namehun){
    if(empty($obj)){
      $this->addError($name, $namehun .' kitöltése kötelező');
    } else {
      if(mb_strlen($obj) <= $num){
        $this->addError($name,'legalább '.$num.' karakter ');
      }
    }
  }

  private function validateName(){
    $name = trim($this->data['name']);
    $this->charLenValidator($name,'name',3,"Név");
  }

  private function validateEmail(){

    $email = trim($this->data['email']);
    $users = User::getUsers();

    if(empty($email)){
      $this->addError('email', 'Email kitöltése kötelező');
    } else {
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'Kérem adjon meg egy helyes email címet');
      }
    }

    foreach($users as $user){
      if ($user["email"] == $email){
        $this->addError('email', 'Ezzel az email címmel már regisztráltak');
      }
    }

  }

  private function validatePassword(){
    $pass1 = trim($this->data['password1']);
    $pass2 = trim($this->data['password2']);

    $this->charLenValidator($pass1,'password',8,"Jelszó");

    if(!preg_match("#[0-9]+#",$pass1)) {
        $this->addError('password',"A jelszónak legalább 1 számot kell tartalmaznia");
    }
    elseif(!preg_match("#[A-Z]+#",$pass1)) {
        $this->addError('password',"A jelszónak legalább 1 Nagy betűt kell tartalmaznia");
    }
    elseif (strcmp($pass1, $pass2) !== 0) {
        $this->addError('password',"A jelszók nem egyeznek");
    }
  }

  private function validateUser(){
    $users = User::getUsers();
    $email= trim($this->data['email']);
    $password = trim($this->data['password']);
    $this->addError('email','Nincs ilyen felhasználó');

    foreach($users as $user){
      if ($user["email"] == $email){
        $this->errors = [];
        if (!password_verify($password, $user['password'])) {
          $this->addError('password',"Helytelen jelszó");
        }
      }
    }
  }

  private function validateBook(){
    $author = trim($this->data['author']);
    $description = trim($this->data['description']);
    $pages = trim($this->data['pages']);

    $this->charLenValidator($author,'author',4,"Szerző");
    $this->charLenValidator($description,'description',15,"Leírás");
    if(empty($pages)){
      $this->addError('pages', 'Oldalszám kitöltése kötelező');
    }
     
  }
   private function validateImage(){
    $image = $this->files['image'];
    $target_dir = "img/uploads/";
    $target_file = $target_dir . basename($image["name"]);
    $check = getimagesize($image["tmp_name"]);
    if($check == false) {
      $this->addError('image',"Ez a file nem kép.");
    }
    if (file_exists($target_file)) {
      $this->addError('image',"Ez a kép már létezik");
    }
    if ($image["size"] > 5000000) {
      $this->addError('image',"Képméret túl nagy, maximum 5mb");
    }
   }
    

  
}
