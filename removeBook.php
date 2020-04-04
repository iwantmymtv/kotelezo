<?php 
session_start();
require('Book.php');

if (!isset($_SESSION["user"])){
  header('Location: login.php');
} 

Book::removeBook($_GET['id']);
header('Location:index.php');

?>