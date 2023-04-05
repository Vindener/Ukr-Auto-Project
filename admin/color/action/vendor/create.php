<?php
require_once '../../../../include/db_connect.php';
    $color = $_POST['color'];
    print_r($_POST);
    mysqli_query($connect, "INSERT INTO `color`( `name_color`) VALUES ('" . $color . "')");
 
  header('Location: ../../index.php');

 ?>
