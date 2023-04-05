<?php
  require_once'../../../../include/db_connect.php';
  $id = $_GET['id'];

  mysqli_query($connect, "DELETE FROM `model_car` WHERE id_model_car   = '". $id."'");
  header('Location: ../../index.php');

 ?>
