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
    if (self::getUsers() !== null){
      $users= self::getUsers();
    }else{
      $users = [];
    }
    $user = [
      "id" => $this->id,
      "email" => $this->email,
      "password" => $this->password,
      "name" => $this->name,
    ];
    array_push($users,$user);
    $file = fopen("data/users.json", "w");
    fwrite($file, json_encode($users, JSON_PRETTY_PRINT));
    fclose($file);
  }
  
  public static function getUsers(){
    $jsonString = file_get_contents('data/users.json');
    $users = json_decode($jsonString, true);
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