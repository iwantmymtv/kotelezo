<?php 

class User{

  private $id;
  private $email;
  private $name;
  private $password;

  public function __construct($email, $name,$password){
    $this->email = $email;
    $this->name = $name;
    $this->password = password_hash($password,PASSWORD_DEFAULT);
    $this->id = uniqid();
  }

  public function saveUser(){
    $file = fopen("data/users.txt", "a");
    $user = [
      "id" => $this->id,
      "email" => $this->email,
      "password" => $this->password,
      "name" => $this->name,
    ];
    fwrite($file,serialize($user)."\n");
    fclose($file);
  }
  
  public static function getUsers(){
    $file = fopen("data/users.txt", "r");
    $users = [];
    while (($line = fgets($file)) !== false) {
        $users[] = unserialize($line);
    }
    fclose($file);
    return $users;
  }
  public static function getSingleUserById($id){
    $users = self::getUsers();
    foreach($users as $user){
      if ($user["id"] == $id){
        return $user;
      }
    }
    return null;
  }
  public static function getSingleUserByEmail($email){
    $users = self::getUsers();
    foreach($users as $user){
      if ($user["email"] == $email){
        return $user;
      }
    }
    return null;
  }

}



?>