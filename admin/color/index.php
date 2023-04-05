<?php
session_start();
if ($_SESSION['auth_user'] != "admin") {
  echo 'Доступ заборонений';
  unset($_SESSION['auth_user']);
  header("Location:../index.php");
} else {
  include("../../include/db_connect.php");
  $sel = mysqli_query($connect, "SELECT *
    FROM color 
    GROUP BY id_color ");
  $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
  //Виведення в циклі записів у таблицю веб-сторінки
  $row = mysqli_fetch_assoc($sel);
  mysqli_close($connect);
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
        <li class="nav-item">
          <a class="nav-link" href="add.php">Додати поле</a>
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
  </div>

  <div class="spisok-table">
    <table>
      <tr>
        <th width="25px">id</th>
        <th width="125px">Колір</th>
        <th>&#10017;</th>
        <th>&#9998;</th>
        <th>&#10006;</th>
      </tr>
      <?php
      do {
        echo '
              <tr>
              <td>' . $row['id_color'] . '</td>
              <td>' . $row['name_color'] . '</td>
              <td><a href="action\show.php?id=' . $row['id_color'] . '">Перегляд</a></td>
              <td><a href="action\edit.php?id=' . $row['id_color'] . '">Оновити</a></td>
              <td><a href="action\vendor\delete.php?id=' . $row['id_color'] . '" onclick="return ConfirmDelete()">Del</a></td>
              </tr>
              ';
      } while ($row = mysqli_fetch_assoc($sel));
      ?>
    </table>
  </div>

  <!-- Видалення з бази даних -->
  <script>
    function ConfirmDelete() {
      if (confirm('Ця дія приведе до видалення поля з бази даних. Ви впевнені що хочете це зробити?')) {
        return true;
      } else {
        return false;
      }
    }
  </script>
</body>

</html>