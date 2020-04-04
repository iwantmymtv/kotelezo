<?php 

class Book{

  private $id;
  private $name;
  private $author;
  private $description;
  private $pages;
  private $imgUrl;

  public function __construct($name,$author,$description,$pages,$imgUrl){
    $this->id = uniqid();
    $this->name = $name;
    $this->author = $author;
    $this->description = $description;
    $this->pages = $pages;
    $this->imgUrl = $imgUrl;
  }

  private static function writeFile($filename,$array){
    $file = fopen("data/".$filename, "w");
    fwrite($file, json_encode($array, JSON_PRETTY_PRINT));
    fclose($file); 
  }

  public function saveBook(){
    if (self::getBooks() !== null){
      $books = self::getBooks();
    }else{
      $books = [];
    }
    $book = [
      "id" => $this->id,
      "name" => $this->name,
      "author" => $this->author,
      "description" => $this->description, 
      "pages" => $this->pages,
      "imgUrl" => $this->imgUrl,
    ];
    array_push($books,$book);
    self::writeFile("books.json",$books);
  }
  public static function getBooks(){
    $jsonString = file_get_contents('data/books.json');
    $books = json_decode($jsonString, true);
    return $books;
  }
  public static function getSingleBookById($id){
    $books = self::getBooks();
    foreach($books as $book){
      if ($book["id"] == $id){
        return $book;
      }
    }
    return null;
  }
  public static function removeBook($id){
    $books = self::getBooks();
    $book = self::getSingleBookById($id);
    unlink($book['urlImg']);
    $index = 0;
    foreach($books as $key=>$value){
      if ($value['id'] == $id ){
        $index = $key;
      }
    }
    array_splice($books,$index,1);
    self::writeFile("books.json",$books);
  }

  public static function addToFavorites($bookId,$userId){
    
    $books = self::getBooks();
    foreach ($books as &$book) {
      if ($book['id'] == $bookId) {
        if (!in_array($userId, $book['favedBy'])){
          array_push($book['favedBy'],$userId);
        }
      }
    }
    self::writeFile("books.json",$books);

    $jsonString = file_get_contents('data/users.json');
    $users = json_decode($jsonString, true);
    foreach ($users as &$user) {
      if ($user['id'] == $userId) {
        if (!in_array($bookId, $user['favorites'])){
            array_push($user['favorites'],$bookId);
          }
      }
    }
    self::writeFile("users.json",$users);
  }

 /*  public static function removeFromFavorite($bookId,$userId){

  } */

}

?>