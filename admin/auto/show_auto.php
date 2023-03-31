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
  //print_r($auto);
  $auto = mysqli_fetch_assoc($auto);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Перегляд оголошення - Панель адміністрування - UkrAuto</title>
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
    <a href="../admin_panel.php" class="active">Список</a>
    <a href="../users/index.php">Користувачі</a>
    <a href="../marka/index.php">Марка</a>
    <a href="../model/index.php">Модель</a>
    <a href="../color/index.php">Колір</a>
    <a href="../city/index.php">Місто</a>

  </div>


  <div class="spisok-table">
    <div class="admin-form">
      <form class="" action="../admin_panel.php" method="post">
        <?php
        if ($auto["img"] == '') {
          $img_path = '../../img/no_image.jpg';
        } else {
          $img_path = '../../img/auto//' . $auto['img'];
        }
        echo '
                <img src="' . $img_path . '" width="120px" heigth="120px"  >
            ';
        ?>
        <input type="hidden" name="id_spisok" value="<?= $auto['id_spisok'] ?>">
        <p>Користувач, який зробив оголошення</p>
        <input type="text" name="uname" value="<?= $auto['uname'] ?>" disabled>
        <p>Модифікація автомобіля</p>
        <input type="text" name="name_car_modyf" value="<?= $auto['name_car_modyf'] ?>">
        <p>Рік випуску</p>
        <input type="text" name="vypusk_year" value="<?= $auto['vypusk_year'] ?>">
        <p>Регіон</p>
        <input type="text" name="nregion" value="<?= $auto['nregion'] ?>">
        <p>Місто</p>
        <input type="text" name="ncity" value="<?= $auto['ncity'] ?>">
        <p>Тип кузова</p>
        <input type="text" name="tkname" value="<?= $auto['tkname'] ?>">
        <p>Коробка передач</p>
        <input type="text" name="kpname" value="<?= $auto['kpname'] ?>">
        <p>Тип палива</p>
        <input type="text" name="tpname" value="<?= $auto['tpname'] ?>">
        <p>Об'єм двигуна</p>
        <input type="text" name="objem_dvuhyna" value="<?= $auto['objem_dvuhyna'] ?>">
        <p>Привід</p>
        <input type="text" name="pname" value="<?= $auto['pname'] ?>">
        <p>К-ть дверей</p>
        <input type="text" name="kilkist_dverey" value="<?= $auto['kilkist_dverey'] ?>">
        <p>К-ть місць </p>
        <input type="text" name="kilkist_mist" value="<?= $auto['kilkist_mist'] ?>">
        <p>Колір</p>
        <input type="text" name="ncolor" value="<?= $auto['ncolor'] ?>">
        <p>Стан авто</p>
        <input type="text" name="scname" value="<?= $auto['scname'] ?>">
        <p>Участь в дтп</p>
        <input type="text" name="uchast_v_dtp" value="<?= $auto['uchast_v_dtp'] ?>">
        <p>Дата продажі</p>
        <input type="text" name="date_prod" value="<?= $auto['date_prod'] ?>">
        <p>Ціна</p>
        <input type="text" name="tsina" value="<?= $auto['tsina'] ?>">
        <p>Зображення в масштабі</p>
        <?php
        echo '<div style="margin-top:10px">';
        $query_img = mysqli_query($connect, "SELECT * FROM photo WHERE id_spisok='$id_spisok'");
        if (mysqli_num_rows($query_img) > 0) {
          $row_img = mysqli_fetch_array($query_img);
          do {
            $img_path = $row_img["name_photo"];
            echo '
							   <img src="../../' . $img_path . '" width="240px" heigth="300px"/>
                 <br>

									';
          } while ($row_img = mysqli_fetch_array($query_img));
        }
        echo '</div>';
        ?>


        <br><br>
        <button type="submit">Повернутися на головну</button>
      </form>
    </div>
  </div>


</body>

</html>