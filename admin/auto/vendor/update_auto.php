<?php
require_once '../../../include/db_connect.php';
if (isset($_POST['uchast_v_dtp'])) {
  // значение option1 равно "yes"
  $uchast_v_dtp = '1';
} else {
  // значение option1 равно "no"
  $uchast_v_dtp = '0';
}
$id = $_POST["id_spisok"];
$id_type_car = $_POST["id_type_car"];

$id_mark_car = $_POST["id_mark_car"];
$id_model_car = $_POST["id_model_car"];
$name_car_modyf = $_POST["name_car_modyf"];
$vypusk_year = $_POST["vypusk_year"];
$probih = $_POST["probih"];
$id_region = $_POST["id_region"];
$id_city = $_POST["id_city"];
$id_type_kuzova = $_POST["id_type_kuzova"];
$id_korobka_peredach = $_POST["id_korobka_peredach"];
$id_type_palyva = $_POST["id_type_palyva"];
$objem_dvuhyna = $_POST["objem_dvuhyna"];
$id_pyvid = $_POST["id_pyvid"];
$kilkist_dverey = $_POST["kilkist_dverey"];
$kilkist_mist = $_POST["kilkist_mist"];
$id_color = $_POST["id_color"];
$id_stan_car = $_POST["id_stan_car"];

$tsina = $_POST["tsina"];
$opus = $_POST['opus'];

mysqli_query($connect, "UPDATE spisok SET
            id_type_car='" . $id_type_car . "',
            id_mark_car='" . $id_mark_car . "',
            id_model_car='" . $id_model_car  . "',
            name_car_modyf='" . $name_car_modyf  . "',
            vypusk_year='" . $vypusk_year . "',
            probih='" . $probih . "',
            id_region='" . $id_region . "',
            id_city='" . $id_city   . "',
            id_type_kuzova='" . $id_type_kuzova   . "',
            id_korobka_peredach='" . $id_korobka_peredach  . "',
            id_type_palyva='" . $id_type_palyva . "',
            objem_dvuhyna='" . $objem_dvuhyna . "',
            id_pyvid='" . $id_pyvid  . "',
            kilkist_dverey='" . $kilkist_dverey . "',
            kilkist_mist='" . $kilkist_mist . "',
            id_color='" . $id_color . "',
            id_stan_car='" . $id_stan_car  . "',
            uchast_v_dtp='" . $uchast_v_dtp . "',
            tsina='" . $tsina  . "',
            opus='" . $opus  . "'
            WHERE spisok.id_spisok  = '" . $id . "' ");
header('Location: ../../admin_panel.php');
?>
