<?php
  require_once'../../../../include/db_connect.php';
  $id = $_GET['id'];

  mysqli_query($connect, "DELETE FROM color WHERE id_color   = '". $id."'");
  header('Location: ../../index.php');

 ?>
