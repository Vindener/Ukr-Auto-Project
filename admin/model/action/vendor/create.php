<?php
require_once '../../../../include/db_connect.php';
    $markcar = $_POST['markcar'];
    $model = $_POST['model'];
    print_r($_POST);
    mysqli_query($connect, "INSERT INTO `model_car`( `id_mark_car`, `name_model_car`) VALUES ('{$markcar}', '{$model}')");
 
  header('Location: ../../index.php');

 ?>
