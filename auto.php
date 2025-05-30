<?php
session_start();
include("./include/db_connect.php"); //Підключення до бази даних
include("./include/header.php"); //Підключення хедера
$id = $_GET['id'];

$sel = mysqli_query($connect, "SELECT *,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname,user.lastname as ulastname, user.telefon as uphone, 
    region.name_region as nregion, pryvid.name_pryvid as npryvid, 
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
     WHERE `id_spisok` = '$id'");

$row = mysqli_fetch_assoc($sel);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $row['mcname'] . " " . $row['modcname'] . " " . $row['name_car_modyf'] ?> - UkrAuto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./css/contact.css?<? echo time(); ?>">
    <link rel="stylesheet" href="./css/styles.css?<? echo time(); ?>" />
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <img src="../../img/logo.png" alt="" height="70px" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li>
                    <?php
                    if ($_SESSION['name'] != "") {
                        if ($_SESSION['auth_user'] == "user") {
                            echo '
                  <p class="nav-name">Привіт, <a href="../../user/user_panel.php">' . $_SESSION['name'] . '</a>!</p>';
                        } else {
                            echo
                            '
                  <p class="nav-name">Привіт, <a href="../../admin/admin_panel.php">' . $_SESSION['name'] . '</a>!</p>';
                        }
                    } else {
                        echo '
                  <button
                  type="button"
                  class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#login"
                >
                  Вхід/Регістрація
                </button>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../index.php">Головна</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../add-auto.php">Додати авто</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../about.php">Про нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../documentation.php">Документація</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../contact.php">Контакти</a>
                </li>
                <?php
                if ($_SESSION['name'] != "") {
                    echo '
                   <li class="nav-item">
                    <button
                    type="button"
                    class="btn btn_exit"
                    data-toggle="modal"
                    data-target="#exit"
                  >
                    Вихід
                  </button>
                  </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container_auto">
        <div class="text-container">
            <h2><?= $row['mcname'] . " " . $row['modcname'] . " " . $row['name_car_modyf'] ?></h2>
            <p class="price"><?= $row['tsina'] ?> $</p>
            <p class="text"><b><?= $row['probih'] ?> тис. км пробіг</b></p>
            <p class="text"><b><?= $row['vypusk_year'] ?> рік випуску </b></p>

            <div>
                <h4>Продавець</h4>
                <p class="text"><?= $row['uname'] ?> <?= $row['ulastname'] ?></p>
                <p class="text">Телефон, для зв'язку: <a href="tel:<?= $row['uphone'] ?>" class="phone-style"><?= $row['uphone'] ?></a></p>

                <p class="text"><?= $row['nregion'] ?></p>
                <p class="text"><?= $row['ncity'] ?></p>

            </div>
        </div>

        <div class="galery_container">
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <?php
                    $in = 0;
                    $query_img1 = mysqli_query($connect, "SELECT * FROM photo WHERE id_spisok='$id'");
                    if (mysqli_num_rows($query_img1) > 0) {
                        $row_img = mysqli_fetch_array($query_img1);
                        do {
                            $img_path = $row_img["name_photo"];
                            $in = $in + 1;
                            echo '
                        <li data-target="#demo" data-slide-to="' . $in . '"></li>
									';
                        } while ($row_img = mysqli_fetch_array($query_img1));
                    }
                    ?>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php
                        if ($row["img"] == '') {
                            $img_path = '../../img/no_image.jpg';
                        } else {
                            $img_path = '../../img/auto//' . $row['img'];
                        }
                        echo '
                <img src="' . $img_path . '"  width="900" height="500"  >
            ';
                        ?>
                    </div>
                    <?php
                    $query_img = mysqli_query($connect, "SELECT * FROM photo WHERE id_spisok='$id'");
                    if (mysqli_num_rows($query_img) > 0) {
                        $row_img = mysqli_fetch_array($query_img);
                        do {
                            $img_path = $row_img["name_photo"];
                            echo '
                    <div class="carousel-item">
							   <img src="img/gallery/' . $img_path . '"  width="900" height="500"/>
                    </div>
									';
                        } while ($row_img = mysqli_fetch_array($query_img));
                    }

                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="container_auto_center">
        <h3 class="about_text">Дані про авто</h3>

        <div class="auto_about_container">

            <div class="first_block_about">
                <p><b>Стан - </b><?= $row['scname'] ?></p>
                <p><b>Участь в ДТП - </b><?php
                                            if ($row['uchast_v_dtp'] == 1) {
                                                echo 'Так';
                                            } else {
                                                echo 'Ні';
                                            }
                                            ?></p>

                <p><b>Пробіг - </b><?= $row['probih'] ?> тис. км пробіг</p>
                <p><b>Тип кузова - </b><?= $row['tkname'] ?></p>
                <p><b>Двигун - </b><?= $row['objem_dvuhyna'] ?> л.</p>
                <p><b>Паливо - </b><?= $row['tpname'] ?></p>
            </div>

            <div class="first_block_about">
                <p><b>Тип авто - </b><?= $row['tcname'] ?> </p>
                <p><b>Колір авто - </b><?= $row['ncolor'] ?> </p>
                <p><b>Кількість дверей - </b><?= $row['kilkist_dverey'] ?> </p>
                <p><b>Кількість місць - </b><?= $row['kilkist_mist'] ?> </p>

                <p><b>Коробка передач - </b><?= $row['kpname'] ?> </p>
                <p><b>Привід - </b><?= $row['npryvid'] ?> </p>

            </div>




        </div>
        <div class="second_block_about">
            <p class="bold_text">Опис:</p>
            <p><?= $row['opus'] ?></p>
        </div>




    </div>





    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Сайт розробили студенти групи П-421</p>
    </div>
</body>