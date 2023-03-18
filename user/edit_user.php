<?php
session_start();
if ($_SESSION['auth_user'] == "") {
    echo 'Доступ заборонений';
    unset($_SESSION['auth_user']);
    header("Location:../index.php");
} else {
    include("../include/db_connect.php"); //Підключення до бази даних
    include("../include/header.php"); //Підключення до бази даних

    $id = $_SESSION['id'];
    $sel = mysqli_query($connect, "SELECT *     FROM user     WHERE id_user  = '$id'");
    $num_rows = mysqli_num_rows($sel); //Визначення кількості рядків у таблиці
    //Виведення в циклі записів у таблицю веб-сторінки
    $row = mysqli_fetch_assoc($sel);
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

        <div class="user_panel_container">

            <div class="user_panel_text">
                <form action="vendor/update_user.php" method="post">
                    <input type="hidden" name="id" value="<?= $row['id_user'] ?>">
                    <p class="sub_title_text">Ім'я</p>
                    <input type="text" id="name" name="name" placeholder="Введіть ім'я" class="textbox-register" value="<?= $row['name'] ?>" required>
                    <p class="sub_title_text">По батькові</p>
                    <input type="text" id="middlename" name="middlename" placeholder="Введіть по батькові" class="textbox-register" value="<?= $row['middlename'] ?>" required>
                    <p class="sub_title_text">Прізвище</p>
                    <input type="text" id="lastname" name="lastname" placeholder="Введіть прізвище" class="textbox-register" value="<?= $row['lastname'] ?>" required>
                    <p class="sub_title_text">Номер телефону:</p>
                    <input type="text" id="telefon" name="telefon" placeholder="Введіть номер телефону" class="textbox-register" value="<?= $row['telefon'] ?>" required>
                    <p class="sub_title_text">Ваша електронна адреса:</p>
                    <input type="text" id="email" name="email" placeholder="Введіть електронну адресу" class="textbox-register" value="<?= $row['email'] ?>" required>
                    <input name="submit" class="user_button" type="submit" value="Змінити свою інформацію" />
                </form>
            </div>

        </div>

        <div>
            <form action="vendor/update_password.php" method="post">
                <input type="hidden" name="id" value="<?= $row['id_user'] ?>">
                <p>Введіть старий пароль</p>
                <input type="password" name="old_password" class="form-input">
                <p>Введіть новий пароль</p>
                <input type="password" name="new_password" class="form-input">
                <br>
                <input name="submit" class="user_button" type="submit" value="Змінити свій пароль" />
            </form>
        </div>
    </div>


    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Сайт розробили студенти групи П-421</p>
    </div>
</body>