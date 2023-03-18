<?php
session_start();
include("./include/db_connect.php"); //Підключення до бази даних
include("./include/header.php"); //Підключення хедера

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Контакти - UkrAuto</title>
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


  <div class="form-container">
    <form class="form-contact" action="include/sendmail.php" method="post">
      <h1>Контактна форма</h1>
      <input type="text" name="name" placeholder="Укажіть ім'я" class="textbox" required />
      <input type="email" name="email" id="" placeholder="Введіть ваш email" class="textbox" maxlength="50" required>
      <textarea rows="4" cols="50" name="message" placeholder="Ваше повідомлення:" class="message" required></textarea>
      <br>
      <input name="submit" class="button" type="submit" value="Відправити" />
    </form>
  </div>

  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Сайт розробили студенти групи П-421</p>
  </div>
</body>

</html>