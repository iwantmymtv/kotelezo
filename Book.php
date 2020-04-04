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
    $this->description = preg_replace( "/\r|\n/", "", $description );
    $this->pages = $pages;
    $this->imgUrl = $imgUrl;
  }

  public function saveBook(){
    $file = fopen("data/books.txt", "a");
    $book = [
      "id" => $this->id,
      "name" => $this->name,
      "author" => $this->author,
      "description" => $this->description, 
      "pages" => $this->pages,
      "imgUrl" => $this->imgUrl,
    ];
    fwrite($file,serialize($book)."\n");
    fclose($file);
  }
  public static function getBooks(){
    $file = fopen("data/books.txt", "r");
    $books= [];
    while (($line = fgets($file)) !== false) {
        $books[] = unserialize($line);
    }
    fclose($file);
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
    foreach($books as $key=>$value){
      if ($value['id'] == $id ){
        $index = $key;
      }
    }
    array_splice($books,$index,1);
  }

}

?>