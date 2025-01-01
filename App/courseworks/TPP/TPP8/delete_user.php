<?php
include "func.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM user_ WHERE id_user = '$id'";
  $sql = mysqli_query($conn, $query);
}
header("location: index.php");
?>