<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:./index.php");
} else {
  include("../../../include/db_connect.php");
  $id = $_GET['id'];

  $auto = mysqli_query($connect, "SELECT *,
    marka_car.name_car_mark as mcname 
    FROM model_car
    LEFT JOIN marka_car ON marka_car.id_car_mark = model_car.id_mark_car  
    WHERE `id_model_car` = '$id'");
  //print_r($auto);
  $auto = mysqli_fetch_assoc($auto);

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
  <title>Перегляд оголошення - Панель адміністрування - UkrAuto</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../../../css/styles.css?<? echo time(); ?>" />
</head>

<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <img src="../../../img/logo.png" alt="" height="70px" />
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../../admin_panel.php">
            <h1>АДМІНКА</h1>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../../index.php">Головна</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="vertical-menu show_auto">
    <a href="../../admin_panel.php">Список</a>
    <a href="../../users/index.php">Користувачі</a>
    <a href="../../marka/index.php">Марка</a>
    <a href="../../model/index.php">Модель</a>
    <a href="../../color/index.php" class="active">Колір</a>
    <a href="../../city/index.php">Місто</a>
  </div>


  <div class="spisok-table">
    <div class="admin-form">
      <form class="" action="vendor/update.php" method="post">
        <input type="hidden" name="id_model_car" value="<?= $auto['id_model_car'] ?>">
        <p>Табличний номер моделі</p>
        <input type="text" name="id_model_car " value="<?= $auto['id_model_car'] ?>" disabled>
        <p>Марка авто</p>
        <input type="text" name="id_car_mark" value="<?= $auto['id_car_mark'] ?>" readonly><br>
        <input type="text" name="mark_car" value="<?= $auto['mcname'] ?>" readonly><br>

            <select name="markcar" id="markcar">
                <option value="" disabled selected>Виберіть марку транспорту</option>
                <?php echo out_options($markcar, 0); ?>
            </select>
        
        <p>Модель авто</p>
        <input type="text" name="name_model_car" value="<?= $auto['name_model_car'] ?>">
        <br><br>
        <button type="submit" class="registerbtn" name="update_model">Оновити інформацію</button>
      </form>

      <form class="form-auto" action="../index.php" method="post">
        <button type="submit">Повернутися на головну</button>
      </form>
    </div>
  </div>


</body>

</html>