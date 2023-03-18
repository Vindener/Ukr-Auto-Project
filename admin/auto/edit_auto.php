<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:./index.php");
} else {
  include("../../include/db_connect.php");
  $id_spisok = $_GET['id_spisok'];

  $auto = mysqli_query($connect, "SELECT *,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname, region.name_region as nregion, 
    city.name_city as ncity 
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
    WHERE `id_spisok` = '$id_spisok'");


  $num_rows = mysqli_num_rows($auto); //Визначення кількості рядків у таблиці
  $row = mysqli_fetch_assoc($auto);

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
  <title>Редугвання оголошення - Панель адміністрування - UkrAuto</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../../css/styles.css?<? echo time(); ?>" />
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <img src="../../img/logo.png" alt="" height="70px" />
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../admin_panel.php">
            <h1>АДМІНКА</h1>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../index.php">Головна</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="vertical-menu show_auto">
    <a href="#" class="active">Список</a>
    <a href="#">Користувачі</a>
    <a href="#">Коробка передач</a>
    <a href="#">Марка</a>
    <a href="#">Модель</a>
    <a href="#">Колір</a>
    <a href="#">Регіон</a>
    <a href="#">Місто</a>
    <a href="#">Привід</a>
    <a href="#">Стан авто</a>
    <a href="#">Тип кузова</a>
    <a href="#">Тип палива</a>
    <a href="#">Тип транспорту</a>

  </div>


  <div class="spisok-table">
    <div class="admin-form">


      <form class="form-auto" method="post" enctype="multipart/form-data" action="vendor/update_auto.php">
        <?php
        if ($row["img"] == '') {
          $img_path = '../../img/no_image.jpg';
        } else {
          $img_path = '../../img/auto//' . $row['img'];
        }
        echo '
                <img src="' . $img_path . '" width="120px" heigth="120px"  >
            ';
        ?>

        <p>Користувач, який зробив оголошення</p>
        <input type="text" name="uname" value="<?= $row['uname'] ?>" disabled>
        <br>
        <input type="hidden" name="id_spisok" value="<?= $row['id_spisok'] ?>">
        <label for="topic">Тип автомобіля</label>
        <select name="id_type_car" class="select-auto">
          <option></option>
          <?php echo out_options2($typecar, $row['id_type_car']); ?>
        </select><br>

        <label for="topic">Марка автомобіля</label>
        <select name="id_mark_car" class="select-auto">
          <option></option>
          <?php echo out_options3($markacar, $row['id_mark_car']); ?>
        </select><br>

        <label for="topic">Модель автомобіля</label>
        <select name="id_model_car" class="select-auto">
          <option></option>
          <?php echo out_options4($modelcar, $row['id_model_car']); ?>
        </select><br>

        <label for="lname">Назва модифікації</label>
        <input type="text" id="name_car_modyf" name="name_car_modyf" placeholder="Введіть назву модифікації" class="textbox-register" value="<?= $row['name_car_modyf'] ?>">
        <br>

        <label for="topic">Рік випуску</label>
        <input type="date" id="start" name="vypusk_year" value="2023-01-01" min="2000-01-01" max="2023-12-12" value="<?= $row['vypusk_year'] ?>">
        </select><br>

        <label for="topic">Колір автомобіля</label>
        <select name="id_color" class="select-auto">
          <option></option>
          <?php echo out_options5($color, $row['id_color']); ?>
        </select><br>

        <label for="topic">Стан автомобіля</label>
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

          <label for=" uchast_v_dtp" id="uchast_v_dtp" name="uchast_v_dtp">Участь в ДТП</label>
        </div><br>

        <label for="lname">Пробіг автомобіля</label>
        <input type="number" id="probih" name="probih" placeholder="Введіть пробіг автомобіля" class="textbox-register" value="<?= $row['probih'] ?>">
        <br>

        <label for="topic">Регіон</label>
        <select name="id_region" class="select-auto">
          <option></option>
          <?php echo out_options1($region, $row['id_region']); ?>

        </select><br>

        <label for="topic">Місто</label>
        <select name="id_city" class="select-auto">
          <option></option>
          <?php echo out_options7($city, $row['id_city']); ?>
        </select><br>


        <label for="topic">Тип кузова автомобіля</label>
        <select name="id_type_kuzova" class="select-auto">
          <option></option>
          <?php echo out_options8($type_kuzova, $row['id_type_kuzova']); ?>
        </select><br>

        <label for="topic">Тип коробки передач автомобіля</label>
        <select name="id_korobka_peredach" class="select-auto">
          <option></option>
          <?php echo out_options9($korobka_peredach, $row['id_korobka_peredach']); ?>
        </select><br>

        <label for="topic">Тип палева автомобіля</label>
        <select name="id_type_palyva" class="select-auto">
          <option></option>
          <?php echo out_options10($type_palyva, $row['id_type_palyva']); ?>
        </select><br>


        <label for="lname">Об'єм двигуна автомобіля</label>
        <input type="number" id="objem_dvuhyna" name="objem_dvuhyna" placeholder="Введіть об'єм двигуна автомобіля" class="textbox-register" value="<?= $row['objem_dvuhyna'] ?>">
        <br>

        <label for=" topic">Тип привада автомобіля</label>
        <select name="id_pyvid" class="select-auto">
          <option></option>
          <?php echo out_options11($pyvid, $row['id_pyvid']); ?>
        </select><br>

        <label for="lname">Кількість дверей автомобіля</label>
        <input type="number" id="kilkist_dverey" name="kilkist_dverey" placeholder="Введіть кількість дверей автомобіля" class="textbox-register" value="<?= $row['kilkist_dverey'] ?>">
        <br>

        <label for=" lname">Кількість місць автомобіля</label>
        <input type="number" id="kilkist_mist" name="kilkist_mist" placeholder="Введіть кількість місць автомобіля" class="textbox-register" value="<?= $row['kilkist_mist'] ?>">
        <br>

        <label for=" tsina">Ціна</label>
        <input type="number" id="tsina" name="tsina" class="textbox-register" value="<?= $row['tsina'] ?>">
        <br>
        <label for="opus">Опис</label>

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
        <button type="submit" class="registerbtn" name="update_auto">Оновити інформацію</button>
      </form>

      <br><br>
      <form class="" action="../admin_panel.php" method="post">
        <button type="submit">Повернутися на головну</button>
      </form>
    </div>
  </div>


</body>

</html>