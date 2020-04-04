<?php 
session_start();
require('Book.php');

if (!isset($_SESSION["user"])){
  header('Location: login.php');
} else {
  Book::removeBook($_GET['id'],$_SESSION["user"]['id']);
  header('Location:index.php');
}



?>