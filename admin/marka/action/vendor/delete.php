<?php
  require_once'../../../../include/db_connect.php';
  $id = $_GET['id'];

  mysqli_query($connect, "DELETE FROM `marka_car` WHERE id_car_mark   = '". $id."'");
  header('Location: ../../index.php');

 ?>
