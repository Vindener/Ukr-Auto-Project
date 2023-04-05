<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:../index.php");
} else {
  include("../../include/db_connect.php");
  $sel = mysqli_query($connect, "SELECT *, 
  marka_car.name_car_mark as mcname 
  FROM model_car
  LEFT JOIN marka_car ON marka_car.id_car_mark = model_car.id_mark_car  
  GROUP BY id_model_car");
  $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
  //Виведення в циклі записів у таблицю веб-сторінки
  $row = mysqli_fetch_assoc($sel);

    $dbh = new PDO('mysql:dbname=ukr_auto;host=localhost', 'root', '');
    $sth = $dbh->prepare("SELECT * FROM `marka_car` ORDER BY `name_car_mark`");
    $sth->execute();
    $markcar = $sth->fetchAll(PDO::FETCH_ASSOC);

    function out_options($array, $selected_id = 0)
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
    <a href="../model/index.php" class="active">Модель</a>
    <a href="../color/index.php">Колір</a>
  </div>

  <div class="spisok-table">
    <div class="admin-form">
      <form class="" method="post" action="action/vendor/create.php">

        <p>Оберіть марку авто</p>
        <select name="markcar" id="markcar">
              <option value="" disabled selected>Виберіть марку авто</option>
              <?php echo out_options($markcar, 0); ?>
            </select>
        <p>Введіть модель</p>
        <input type="text" name="model" required><br><br>
        <button type="submit" class="registerbtn" name="create_model">Додати поле</button>
      </form>

      <form class="form-auto" action="./index.php" method="post">
        <button type="submit">Повернутися до кольорів</button>
      </form>
    </div>
  </div>

</body>

</html>