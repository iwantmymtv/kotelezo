<?php 
session_start();
require('Book.php');

if (!isset($_SESSION["user"])){
  header('Location: login.php');
} else{
  $bookId = $_GET['id'];
  $userId = $_SESSION["user"]['id'];
  Book::removeFromFavorite($bookId,$userId);
  header('Location:favorites.php');
}

?>