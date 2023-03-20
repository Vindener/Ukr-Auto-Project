<?php
session_start();
if ($_SESSION['auth_user'] == "") {
    echo 'Доступ заборонений';
    unset($_SESSION['auth_user']);
    header("Location:../index.php");
} else {
    include("../include/db_connect.php"); //Підключення до бази даних
   

    $id_spisok = $_GET['id'];

    $auto = mysqli_query($connect, "SELECT *,
    type_car.name_type_car as tcname,
    marka_car.name_car_mark as mcname,
    model_car.name_model_car as modcname,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname, region.name_region as nregion, 
    city.name_city as ncity 
    FROM spisok 
    LEFT JOIN type_car ON type_car.id_type_car = spisok.id_type_car
    LEFT JOIN marka_car ON marka_car.id_car_mark = spisok.id_mark_car
    LEFT JOIN model_car ON model_car.id_model_car = spisok.id_model_car
    LEFT JOIN city ON city.id_city=spisok.id_city 
    LEFT JOIN region ON region.id_region=spisok.id_region 
    LEFT JOIN user ON user.id_user=spisok.id_user 
    LEFT JOIN type_kuzova ON type_kuzova.id_type_kuzova = spisok.id_type_kuzova 
    LEFT JOIN korobka_peredach ON korobka_peredach.id_korobka_peredach = spisok.id_korobka_peredach 
    LEFT JOIN type_palyva ON type_palyva.id_type_palyva = spisok.id_type_palyva
    LEFT JOIN pryvid ON pryvid.id_pryvid = spisok.id_pyvid
    LEFT JOIN color ON color.id_color = spisok.id_color
    LEFT JOIN stan_car ON stan_car.id_stan_car = spisok.id_stan_car
    WHERE `id_spisok` = '$id_spisok'");
    
    $num_rows = mysqli_num_rows($auto); //Визначення кількості рядків у таблиці
    $row = mysqli_fetch_assoc($auto);
    if($row['id_user']!= $_SESSION['id']){
        header("Location: user_panel.php");
    }

    include("../include/header.php"); //Підключення хедера
    

    $dbh = new PDO('mysql:dbname=ukr_auto;host=localhost', 'root', '');
    //Регіони
    $sth1 = $dbh->prepare("SELECT * FROM region ORDER BY name_region");
    $sth1->execute();
    $region = $sth1->fetchAll(PDO::FETCH_ASSOC);
    function out_options1($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_region'] . '"';
            if ($row['id_region'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_region'] . '</option>';
        }
        return $out;
    }

    //Тип авто
    $sth2 = $dbh->prepare("SELECT * FROM type_car ORDER BY name_type_car");
    $sth2->execute();
    $typecar = $sth2->fetchAll(PDO::FETCH_ASSOC);

    function out_options2($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_type_car'] . '"';
            if ($row['id_type_car'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_type_car'] . '</option>';
        }
        return $out;
    }

    //Марка авто
    $sth3 = $dbh->prepare("SELECT * FROM marka_car ORDER BY name_car_mark");
    $sth3->execute();
    $markacar = $sth3->fetchAll(PDO::FETCH_ASSOC);
    function out_options3($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_car_mark'] . '"';
            if ($row['id_car_mark'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_car_mark'] . '</option>';
        }
        return $out;
    }

    //Модель авто
    $sth4 = $dbh->prepare("SELECT * FROM model_car ORDER BY name_model_car");
    $sth4->execute();
    $modelcar = $sth4->fetchAll(PDO::FETCH_ASSOC);
    function out_options4($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_model_car'] . '"';
            if ($row['id_model_car'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_model_car'] . '</option>';
        }
        return $out;
    }

    //Колір авто
    $sth5 = $dbh->prepare("SELECT * FROM color ORDER BY name_color");
    $sth5->execute();
    $color = $sth5->fetchAll(PDO::FETCH_ASSOC);
    function out_options5($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_color'] . '"';
            if ($row['id_color'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_color'] . '</option>';
        }
        return $out;
    }

    //Стан авто
    $sth6 = $dbh->prepare("SELECT * FROM stan_car ORDER BY name_stan_car");
    $sth6->execute();
    $autostan = $sth6->fetchAll(PDO::FETCH_ASSOC);
    function out_options6($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_stan_car'] . '"';
            if ($row['id_stan_car'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_stan_car'] . '</option>';
        }
        return $out;
    }

    //Місто 
    $sth7 = $dbh->prepare("SELECT * FROM city ORDER BY name_city");
    $sth7->execute();
    $city = $sth7->fetchAll(PDO::FETCH_ASSOC);
    function out_options7($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_city'] . '"';
            if ($row['id_city'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_city'] . '</option>';
        }
        return $out;
    }

    //Тип кузова 
    $sth8 = $dbh->prepare("SELECT * FROM type_kuzova ORDER BY name_type_kuzova");
    $sth8->execute();
    $type_kuzova = $sth8->fetchAll(PDO::FETCH_ASSOC);
    function out_options8($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_type_kuzova'] . '"';
            if ($row['id_type_kuzova'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_type_kuzova'] . '</option>';
        }
        return $out;
    }

    //Тип коробки передач автомобіля
    $sth9 = $dbh->prepare("SELECT * FROM korobka_peredach ORDER BY name_korobka_peredach");
    $sth9->execute();
    $korobka_peredach = $sth9->fetchAll(PDO::FETCH_ASSOC);
    function out_options9($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_korobka_peredach'] . '"';
            if ($row['id_korobka_peredach'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_korobka_peredach'] . '</option>';
        }
        return $out;
    }

    //Тип палива
    $sth10 = $dbh->prepare("SELECT * FROM type_palyva ORDER BY name_type_palyva");
    $sth10->execute();
    $type_palyva = $sth10->fetchAll(PDO::FETCH_ASSOC);
    function out_options10($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_type_palyva'] . '"';
            if ($row['id_type_palyva'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_type_palyva'] . '</option>';
        }
        return $out;
    }

    //Тип привада автомобіля
    $sth11 = $dbh->prepare("SELECT * FROM pryvid ORDER BY name_pryvid");
    $sth11->execute();
    $pyvid = $sth11->fetchAll(PDO::FETCH_ASSOC);
    function out_options11($array, $selected_id = 0)
    {
        $out = '';
        foreach ($array as $i => $row) {
            $out .= '<option value="' . $row['id_pryvid'] . '"';
            if ($row['id_pryvid'] == $selected_id) {
                $out .= ' selected';
            }
            $out .= '>';
            $out .= $row['name_pryvid'] . '</option>';
        }
        return $out;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Редагування даних - <?= $row['name'] ?> <?= $row['lastname'] ?> - UkrAuto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/contact.css?<? echo time(); ?>">
    <link rel="stylesheet" href="../css/styles.css?<? echo time(); ?>" />
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <img src="../img/logo.png" alt="" height="70px" />
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
                  <p class="nav-name">Привіт, <a href="../user/user_panel.php">' . $_SESSION['name'] . '</a>!</p>';
                        } else {
                            echo
                            '
                  <p class="nav-name">Привіт, <a href="../admin/admin_panel.php">' . $_SESSION['name'] . '</a>!</p>';
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
                    <a class="nav-link" href="../index.php">Головна</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../add-auto.php">Додати авто</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">Про нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../contact.php">Контакти</a>
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


    <div class="user_panel_first_container">
        <h2>Ваші дані:</h2>
        <h3><?php echo '
            ' . $row['mcname'] . " " . $row['modcname'] . " " . $row['name_car_modyf'] . '';
            ?></h3>

        <div class="auto_panel_container">

            <div class="user_panel_text">
                <form class="form-auto" method="post" enctype="multipart/form-data" action="vendor/update_auto.php">
                    <?php
                    if ($row["img"] == '') {
                        $img_path = '../img/no_image.jpg';
                    } else {
                        $img_path = '../img/auto//' . $row['img'];
                    }
                    echo '
                <img src="' . $img_path . '" class="main_image" >
            ';
                    ?>
                    <input type="hidden" name="id_spisok" value="<?= $row['id_spisok'] ?>">

                    <label for="topic" class="sub_title_text">Тип автомобіля</label>
                    <select name="id_type_car" class="select-auto">
                        <option></option>
                        <?php echo out_options2($typecar, $row['id_type_car']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Марка автомобіля</label>
                    <select name="id_mark_car" class="select-auto">
                        <option></option>
                        <?php echo out_options3($markacar, $row['id_mark_car']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Модель автомобіля</label>
                    <select name="id_model_car" class="select-auto">
                        <option></option>
                        <?php echo out_options4($modelcar, $row['id_model_car']); ?>
                    </select>

                    <label for="lname" class="sub_title_text">Назва модифікації</label>
                    <input type="text" id="name_car_modyf" name="name_car_modyf" placeholder="Введіть назву модифікації" class="textbox-register" value="<?= $row['name_car_modyf'] ?>">


                    <label for="topic" class="sub_title_text">Рік випуску</label>
                    <input type="number" id="start" name="vypusk_year" min="1960" max="2023" value="<?= $row['vypusk_year'] ?>">
                    </select>

                    <label for="topic" class="sub_title_text">Колір автомобіля</label>
                    <select name="id_color" class="select-auto">
                        <option></option>
                        <?php echo out_options5($color, $row['id_color']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Стан автомобіля</label>
                    <select name="id_stan_car" class="select-auto">
                        <option></option>
                        <?php echo out_options6($autostan, $row['id_stan_car']); ?>
                    </select>

                    <div>

                        <?php
                        if ($row['uchast_v_dtp'] == '1') {
                            // значение option1 равно "yes"
                            echo '
                <input type="checkbox" id="uchast_v_dtp" name="uchast_v_dtp" checked>
              ';
                        } else {
                            // значение option1 равно "no"
                            echo '
                <input type="checkbox" id="uchast_v_dtp" name="uchast_v_dtp">
              ';
                        }
                        ?>

                        <label class="sub_title_text" for=" uchast_v_dtp" id="uchast_v_dtp" name="uchast_v_dtp">Участь в ДТП</label>
                    </div>

                    <label for="lname" class="sub_title_text">Пробіг автомобіля</label>
                    <input type="number" id="probih" name="probih" placeholder="Введіть пробіг автомобіля" class="textbox-register" value="<?= $row['probih'] ?>">


                    <label for="topic" class="sub_title_text">Регіон</label>
                    <select name="id_region" class="select-auto">
                        <option></option>
                        <?php echo out_options1($region, $row['id_region']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Місто</label>
                    <select name="id_city" class="select-auto">
                        <option></option>
                        <?php echo out_options7($city, $row['id_city']); ?>
                    </select>


                    <label for="topic" class="sub_title_text">Тип кузова автомобіля</label>
                    <select name="id_type_kuzova" class="select-auto">
                        <option></option>
                        <?php echo out_options8($type_kuzova, $row['id_type_kuzova']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Тип коробки передач автомобіля</label>
                    <select name="id_korobka_peredach" class="select-auto">
                        <option></option>
                        <?php echo out_options9($korobka_peredach, $row['id_korobka_peredach']); ?>
                    </select>

                    <label for="topic" class="sub_title_text">Тип палева автомобіля</label>
                    <select name="id_type_palyva" class="select-auto">
                        <option></option>
                        <?php echo out_options10($type_palyva, $row['id_type_palyva']); ?>
                    </select>

                    <label for="lname" class="sub_title_text">Об'єм двигуна автомобіля</label>
                    <input type="number" id="objem_dvuhyna" name="objem_dvuhyna" placeholder="Введіть об'єм двигуна автомобіля" class="textbox-register" value="<?= $row['objem_dvuhyna'] ?>">

                    <label for=" topic" class="sub_title_text">Тип привада автомобіля</label>
                    <select name="id_pyvid" class="select-auto">
                        <option></option>
                        <?php echo out_options11($pyvid, $row['id_pyvid']); ?>
                    </select>

                    <label for="lname" class="sub_title_text">Кількість дверей автомобіля</label>
                    <input type="number" id="kilkist_dverey" name="kilkist_dverey" placeholder="Введіть кількість дверей автомобіля" class="textbox-register" value="<?= $row['kilkist_dverey'] ?>">

                    <label for=" lname" class="sub_title_text">Кількість місць автомобіля</label>
                    <input type="number" id="kilkist_mist" name="kilkist_mist" placeholder="Введіть кількість місць автомобіля" class="textbox-register" value="<?= $row['kilkist_mist'] ?>">

                    <label for=" tsina" class="sub_title_text">Ціна</label>
                    <input type="number" id="tsina" name="tsina" class="textbox-register" value="<?= $row['tsina'] ?>">

                    <label for="opus" class="sub_title_text">Опис</label>
                    <textarea id="opus" name="opus" placeholder="" class="message-auto"><?= $row['opus'] ?></textarea>

                    <div class="gallery">
                        <br>
                        <label>Оберiть файл для основного зображення:</label>
                        <div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                            <input type="file" name="myFile" size="5000000" />
                        </div>
                        <br>

                        <label>Оберiть файли для галереї зображень:</label>
                        <div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                            <input type="file" name="my_files[]" size="5000000" multiple />
                        </div>
                        <br>
                    </div>
                    <button type="submit" class="user_button" name="update_auto">Оновити інформацію</button>
                </form>
            </div>

        </div>
    </div>


    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Сайт розробили студенти групи П-421</p>
    </div>
</body>