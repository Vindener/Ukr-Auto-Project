<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:../index.php");
} else {
  include("../../include/db_connect.php");
  $sel = mysqli_query($connect, "SELECT *, 
  type_car.name_type_car as tcname 
  FROM marka_car
  LEFT JOIN type_car ON type_car.id_type_car = marka_car.id_type_car  
  GROUP BY id_car_mark");
  $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
  //Виведення в циклі записів у таблицю веб-сторінки
  $row = mysqli_fetch_assoc($sel);

    $dbh = new PDO('mysql:dbname=ukr_auto;host=localhost', 'root', '');
    $sth = $dbh->prepare("SELECT * FROM `type_car` ORDER BY `name_type_car`");
    $sth->execute();
    $typecar = $sth->fetchAll(PDO::FETCH_ASSOC);

    function out_options($array, $selected_id = 0)
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
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Панель адміністрування - UkrAuto</title>
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

  <div class="vertical-menu">
    <a href="../admin_panel.php">Список</a>
    <a href="../users/index.php">Користувачі</a>
    <a href="../marka/index.php">Марка</a>
    <a href="../model/index.php">Модель</a>
    <a href="../color/index.php" class="active">Колір</a>
    <a href="../city/index.php">Місто</a>
  </div>

  <div class="spisok-table">
    <div class="admin-form">
      <form class="" method="post" action="action/vendor/create.php">

        <p>Оберіть тип авто</p>
        <select name="typecar" id="typecar">
              <option value="" disabled selected>Виберіть тип транспорту</option>
              <?php echo out_options($typecar, 0); ?>
            </select>
        <p>Введіть марку</p>
        <input type="text" name="marka" required><br><br>
        <button type="submit" class="registerbtn" name="create_color">Додати поле</button>
      </form>

      <form class="form-auto" action="./index.php" method="post">
        <button type="submit">Повернутися до кольорів</button>
      </form>
    </div>
  </div>

</body>

</html>