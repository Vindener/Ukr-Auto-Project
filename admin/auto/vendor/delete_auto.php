<?php
  require_once'../../../include/db_connect.php';
  $id_spisok = $_GET['id_spisok'];

  mysqli_query($connect,"DELETE FROM spisok WHERE `spisok`.`id_spisok` = '$id_spisok'");
  header('Location: ../../admin_panel.php');

 ?>
