<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:./index.php");
} else {
  include("../../../include/db_connect.php");
  $id = $_GET['id'];

  $auto = mysqli_query($connect, "SELECT *
    FROM user 
    WHERE `id_user` = '$id'");
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
    <a href="../admin_panel.php">Список</a>
    <a href="../users/index.php" class="active">Користувачі</a>
    <a href="../marka/index.php">Марка</a>
    <a href="../model/index.php">Модель</a>
    <a href="../color/index.php">Колір</a>
    <a href="../city/index.php">Місто</a>
  </div>


  <div class="spisok-table">
    <div class="admin-form">
      <form class="" action="../index.php" method="post">
        <input type="hidden" name="id_user " value="<?= $auto['id_user'] ?>">
        <p>Табличний номер користувача</p>
        <input type="text" name="id_user " value="<?= $auto['id_user'] ?>" disabled>
        <p>Ім'я</p>
        <input type="text" name="name" value="<?= $auto['name'] ?>">
        <p>По батькові </p>
        <input type="text" name="middlename" value="<?= $auto['middlename'] ?>">
        <p>Прізвище</p>
        <input type="text" name="lastname" value="<?= $auto['lastname'] ?>">
        <p>Телефон</p>
        <input type="text" name="telefon" value="<?= $auto['telefon'] ?>">
        <p>Елекртонна адреса</p>
        <input type="text" name="email" value="<?= $auto['email'] ?>">
        <br><br>
        <button type="submit">Повернутися на головну</button>
      </form>
    </div>
  </div>


</body>

</html>