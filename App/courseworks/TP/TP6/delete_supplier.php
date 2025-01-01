<?php
  require 'func.php';
  delete_supplier($_GET['id']);
  header('Location: index.php');
  exit(); 
?>