<?php 
  require 'func.php';
  delete($_GET['id']);
  header('Location: index.php');
  exit();
?>