<?php



class Auth{

  

  public function login($email,$password){
    $password = password_verify($password);
  }

}
?> 




