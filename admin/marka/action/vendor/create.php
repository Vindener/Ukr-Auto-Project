<?php
require_once '../../../../include/db_connect.php';
    $typecar = $_POST['typecar'];
    $marka = $_POST['marka'];
    print_r($_POST);
    mysqli_query($connect, "INSERT INTO `marka_car`( `id_type_car`, `name_car_mark`) VALUES ('{$typecar}', '{$marka}')");
 
  header('Location: ../../index.php');

 ?>
