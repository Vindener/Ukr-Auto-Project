<?php
require_once '../../../../include/db_connect.php';

$id = $_POST["id_car_mark"];
$id_type_car = $_POST['id_type_car'];
$typecar = $_POST['typecar'];
$marka = $_POST['name_car_mark'];

print_r($_POST);
if($_POST['typecar'] == ""){
    mysqli_query($connect, "UPDATE `marka_car` SET
            `id_type_car` = '{$id_type_car}',
            `name_car_mark` = '$marka'
            WHERE id_car_mark = '$id'");
}else{
    mysqli_query($connect, "UPDATE `marka_car` SET
            `id_type_car` = '{$typecar}',
            `name_car_mark` = '$marka'
            WHERE id_car_mark = '$id'");
}

header('Location: ../../index.php');
?>
