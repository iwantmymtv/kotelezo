<?php 
require_once('User.php');

class RegistrationValidator {

  private $data;
  private $errors = [];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public function validateForm(){

    $this->validateName();
    $this->validateEmail();
    $this->validatePassword();
    return $this->errors;

  }

  private function validateName(){

    $name = trim($this->data['name']);
    
    if(empty($name)){
      $this->addError('name', 'Név kitöltése kötelező');
    } else {
      if(mb_strlen($name) <= 5){
        $this->addError('name','legalább 5 karakter ');
      }
    }

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

    if(empty($pass1) or empty($pass2)){
      $this->addError('password', 'Adjon meg egy jelszót');
    } if (mb_strlen($pass1) <= 8) {
        $this->addError('password',"Legalább 8 karakter");
    }
    elseif(!preg_match("#[0-9]+#",$pass1)) {
        $this->addError('password',"A jelszónak legalább 1 számot kell tartalmaznia");
    }
    elseif(!preg_match("#[A-Z]+#",$pass1)) {
        $this->addError('password',"A jelszónak legalább 1 Nagy betűt kell tartalmaznia");
    }
    elseif(!preg_match("#[\W]+#",$pass1)) {
        $this->addError('password',"A jelszónak legalább 1 speciális karaktert kell tartalmaznia");
    } 
    elseif (strcmp($pass1, $pass2) !== 0) {
        $this->addError('password',"A jelszók nem egyeznek");
    }
  }

  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>