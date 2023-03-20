<?php
include ("db_connect.php"); //Підключення до бази даних
$search = $_POST['search'];
//if($_POST["search"]){
    $query_all='';
        $region = $_POST['region'];
        $typecar = $_POST['typecar'];
        $markcar = $_POST['markcar'];
        $modelcar = $_POST['modelcar'];

        if($region==""){
            $query_regname="spisok.id_region IN(SELECT id_region FROM spisok)";
        }else {$query_regname="spisok.id_region ='$region'";}

        if($typecar==""){
            $query_tcname="AND type_car.id_type_car IN(SELECT id_type_car FROM type_car)";
        }else {$query_tcname="AND type_car.id_type_car='$typecar'";}

        if($markcar==""){
            $query_markcar="AND mcname IN(SELECT name_car_mark FROM marka_car)";
        }else {$query_markcar="AND mcname='$markcar'";}

        if($modelcar==""){
            $query_modelcar="AND modcname IN(SELECT name_model_car FROM model_car)";
        }else {$query_modelcar="AND modcname='$modelcar'";}

    echo $query_all=$query_regname.$query_tcname.$query_markcar.$query_modelcar;
	$sel=mysqli_query($connect, "SELECT *, spisok.id_region, type_car.id_type_car,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname, 
    region.name_region as nregion, 
    city.name_city as ncity,
    type_car.name_type_car as tcname,
    marka_car.name_car_mark as mcname,
    model_car.name_model_car as modcname
    FROM spisok 
    LEFT JOIN city ON city.id_city=spisok.id_city 
    LEFT JOIN region ON region.id_region=spisok.id_region 
    LEFT JOIN user ON user.id_user=spisok.id_user 
    LEFT JOIN type_kuzova ON type_kuzova.id_type_kuzova = spisok.id_type_kuzova 
    LEFT JOIN korobka_peredach ON korobka_peredach.id_korobka_peredach = spisok.id_korobka_peredach 
    LEFT JOIN type_palyva ON type_palyva.id_type_palyva = spisok.id_type_palyva
    LEFT JOIN pryvid ON pryvid.id_pryvid = spisok.id_pyvid
    LEFT JOIN color ON color.id_color = spisok.id_color
    LEFT JOIN stan_car ON stan_car.id_stan_car = spisok.id_stan_car
    LEFT JOIN type_car ON type_car.id_type_car = spisok.id_type_car
    LEFT JOIN marka_car ON marka_car.id_car_mark = spisok.id_mark_car
    LEFT JOIN model_car ON model_car.id_model_car = spisok.id_model_car
    GROUP BY id_spisok
    HAVING $query_all");
    $num_rows=mysqli_num_rows($sel);//Визначення кількості рядків у таблиці
    //Виведення в циклі записів у таблицю веб-сторінки
    $row = mysqli_fetch_assoc($sel);
    mysqli_close($connect);
    //header('Location: ../index.php');
//}
// else{
//     $sel=mysqli_query($connect, "SELECT *, spisok.id_region,
//     stan_car.name_stan_car as scname,
//     color.name_color as ncolor,
//     pryvid.name_pryvid as pname, 
//     type_palyva.name_type_palyva as tpname, 
//     korobka_peredach.name_korobka_peredach as kpname, 
//     type_kuzova.name_type_kuzova as tkname, 
//     user.name as uname, 
//     region.name_region as nregion, 
//     city.name_city as ncity,
//     type_car.name_type_car as tcname,
//     marka_car.name_car_mark as mcname,
//     model_car.name_model_car as modcname
//     FROM spisok 
//     LEFT JOIN city ON city.id_city=spisok.id_city 
//     LEFT JOIN region ON region.id_region=spisok.id_region 
//     LEFT JOIN user ON user.id_user=spisok.id_user 
//     LEFT JOIN type_kuzova ON type_kuzova.id_type_kuzova = spisok.id_type_kuzova 
//     LEFT JOIN korobka_peredach ON korobka_peredach.id_korobka_peredach = spisok.id_korobka_peredach 
//     LEFT JOIN type_palyva ON type_palyva.id_type_palyva = spisok.id_type_palyva
//     LEFT JOIN pryvid ON pryvid.id_pryvid = spisok.id_pyvid
//     LEFT JOIN color ON color.id_color = spisok.id_color
//     LEFT JOIN stan_car ON stan_car.id_stan_car = spisok.id_stan_car
//     LEFT JOIN type_car ON type_car.id_type_car = spisok.id_type_car
//     LEFT JOIN marka_car ON marka_car.id_car_mark = spisok.id_mark_car
//     LEFT JOIN model_car ON model_car.id_model_car = spisok.id_model_car
//     GROUP BY id_spisok");
//     $num_rows=mysqli_num_rows($sel);//Визначення кількості рядків у таблиці
//     //Виведення в циклі записів у таблицю веб-сторінки
//     $row = mysqli_fetch_assoc($sel);
//     mysqli_close($connect);
// }
?>