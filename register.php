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



    <div class="modal-body">
        <div>
            <?php
            if (isset($_POST['button_registr'])) {
                $error = 0;

                $result = mysqli_query($connect, "SELECT * FROM user");
                $row = mysqli_fetch_array($result);

                do {
                    if ($_POST["email"] == $row['email']) {
                        if ($error == 0) {
                            echo "<div class=\"red\">";
                        }
                        echo "Такий email - вже зарігістровано!<br> ";
                        $error = $error + 1;
                    }
                } while ($row = mysqli_fetch_array($result));
                if (empty($_POST["name"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено ім'я!<br> ";
                    $error = $error + 1;
                }
                if (empty($_POST["name"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено ім'я!<br> ";
                    $error = $error + 1;
                }

                if (empty($_POST["middlename"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено по батькові!<br> ";
                    $error = $error + 1;
                }

                if (empty($_POST["lastname"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено прізвище!<br> ";
                    $error = $error + 1;
                }

                if (empty($_POST["email"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено електрону пошту!<br> ";
                    $error = $error + 1;
                }

                if (empty($_POST["pass"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено пароль!<br> ";
                    $error = $error + 1;
                }

                if (empty($_POST["telefon"])) {
                    if ($error == 0) {
                        echo "<div class=\"red\">";
                    }
                    echo "Не введено телефон!<br> ";
                    $error = $error + 1;
                }



                if ($error > 0) {
                    echo "</div>";
                    echo '
            <script>
              $("#Registr").modal("show");
            </script>';
                }

                if ($error == 0) {
                    //Додавання запису в базу даних
                    $password = md5($_POST['pass'] . "cargr2gh");
                    mysqli_query($connect, "INSERT INTO `user` (`id_user`, `name`, `lastname`, `middlename`, `telefon`, `email`, `password`, `id_access`) 
        VALUES (NULL, '" . $_POST["name"] . "', '" . $_POST["lastname"] . "', '" . $_POST["middlename"] . "','" . $_POST["telefon"] . "','" . $_POST["email"] . "','$password','1')");

                    //Вхід після регістрації
                    $login = $_POST["email"];

                    $result = mysqli_query($connect, "SELECT * FROM `user` WHERE `email`='$login' AND `password`='$password'");


                    $row = mysqli_fetch_array($result);

                    $_SESSION['name']  = $row['name'];
                    $_SESSION['id']  = $row['id_user'];

                    if ($row["id_access"] == 2) {
                        $_SESSION['auth_user']  = 'user';
                        header("Location: ../users/user_panel.php");
                    }
                    if ($row["id_access"] == 1) {
                        $_SESSION['auth_user']  = 'admin';
                        header("Location: ./admin/admin_panel.php");
                    }

                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
            ?>
            <form action="" method="post" class="container-login">
                <label for="name"><b>Ім'я</b></label>
                <input type="text" placeholder="Ім'я" name="name" />
                <label for="middlename"><b>По батькові</b></label>
                <input type="text" placeholder="По батькові" name="middlename" />
                <label for="lastname"><b>Прізвище</b></label>
                <input type="text" placeholder="Прізвище" name="lastname" />

                <label for="email"><b>Електронна пошта</b></label>
                <input type="text" placeholder="Електронна пошта" name="email" />

                <label for="telefon"><b>Телефон</b></label>
                <input type="text" placeholder="Телефон" name="telefon" />

                <label for="pass"><b>Пароль</b></label>
                <input type="password" placeholder="Пароль" name="pass" />
                <hr />

                <button type="submit" class="btn btn-danger button_registr" id="button_registr" name="button_registr">
                    Регістрація
                </button>
                <br>
                <p>Вже маєте обліковий запис <a href="#" data-toggle="modal" data-target="#login" id="enter_from_registr">Увійти в акаунт</a>.</p>
            </form>
        </div>

    </div>

    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Сайт розробили студенти групи П-421</p>
    </div>
</body>

</html>