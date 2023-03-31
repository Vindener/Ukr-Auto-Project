<?php
  require_once'../../../../include/db_connect.php';
  $id = $_GET['id'];

  mysqli_query($connect,"DELETE FROM user WHERE id_user  = '". $id."'");
  header('Location: ../../index.php');

 ?>
