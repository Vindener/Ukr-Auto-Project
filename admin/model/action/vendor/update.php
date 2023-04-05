<?php
require_once '../../../../include/db_connect.php';

$id = $_POST["id_model_car"];
$id_car_mark = $_POST['id_car_mark'];
$markcar = $_POST['markcar'];
$model = $_POST['name_model_car'];

print_r($_POST);
if($_POST['markcar'] == ""){
    mysqli_query($connect, "UPDATE `model_car` SET
            `id_mark_car` = '{$id_car_mark}',
            `name_model_car` = '$model'
            WHERE id_model_car = '$id'");
}else{
    mysqli_query($connect, "UPDATE `model_car` SET
            `id_mark_car` = '{$markcar}',
            `name_model_car` = '$model'
            WHERE id_model_car = '$id'");
}

header('Location: ../../index.php');
?>
