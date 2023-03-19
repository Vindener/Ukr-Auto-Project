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

    $sel1 = mysqli_query($connect, "SELECT *,    type_car.name_type_car as tcname,
    marka_car.name_car_mark as mcname,
    model_car.name_model_car as modcname
    FROM spisok LEFT JOIN type_car ON type_car.id_type_car = spisok.id_type_car
    LEFT JOIN marka_car ON marka_car.id_car_mark = spisok.id_mark_car
    LEFT JOIN model_car ON model_car.id_model_car = spisok.id_model_car    WHERE id_user  = '$id'");
    $num_rows1 = mysqli_num_rows($sel1); //Визначення кількості рядків у таблиці
    //Виведення в циклі записів у таблицю веб-сторінки
    $row1 = mysqli_fetch_assoc($sel1);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $row['name'] ?> <?= $row['lastname'] ?> - UkrAuto</title>
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
                    <a class="nav-link" href="../../documentation.php">Документація</a>
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
        <h2>Інформація про вас</h2>

        <div class="user_panel_container">

            <div class="user_panel_text">
                <p class="sub_title_text">Ваш ПІБ:</p>
                <p><?= $row['name'] ?> <?= $row['middlename'] ?> <?= $row['lastname'] ?></p>
                <p class="sub_title_text">Ваш номер телефону:</p>
                <p><?= $row['telefon'] ?> </p>
                <p class="sub_title_text">Ваша електронна адреса:</p>
                <p><?= $row['email'] ?> </p>

            </div>

            <div>
                <form action="edit_user.php" method="post">
                    <input name="submit" class="user_button" type="submit" value="Змінити свої дані" />
                </form>
            </div>


        </div>
        <p class="sub_title_text">Ваші оголошення</p>
        <div>
            <?php if ($row1['id_spisok'] == null) :    ?>
                <h3 class="title">У вас немає створених оголошень</h3>
                <h4 class="title">Ви можете <a href="../add-auto.php">створити оголошення</a> </h4>
            <?php endif; ?>
            <?php if ($row1['id_spisok'] != null) :    ?>
                <table>
                    <tr>
                        <th>Зображення</th>
                        <th>Назва оголошення</th>
                        <th>Дата публікації </th>
                        <th>Ціна</th>
                        <th>&#9998;</th>
                        <th>&#10017;</th>

                    </tr>
                    <?php
                    do {
                        if ($row1["img"] == '') {
                            $img_path = '..\img\no_image.jpg';
                        } else {
                            $img_path = '..\img\auto\\' . $row1['img'];
                        }
                        echo '
			  <tr>
                <td><a href="..\auto.php?id=' . $row1['id_spisok'] . '"><img src="' . $img_path . '" width="120px" heigth="120px" ></a></td>
                <td><a href="..\auto.php?id=' . $row1['id_spisok'] . '">' . $row1['mcname'] . " " . $row1['modcname'] . " " . $row1['name_car_modyf'] . '</a></td>
                <td>' . $row1['date_prod'] . '</td>
                <td>' . $row1['tsina'] . ' $</td>
                <td><a href="pages\views\view_user.php?id=' . $row['id'] . '">Перегляд</td>
                <td><a href="update.php?id=' . $row['id'] . '">Оновити</td>
        
      </tr>
      ';
                    } while ($row1 = mysqli_fetch_assoc($sel1));
                    ?>
                </table>
            <?php endif; ?>
        </div>
    </div>


    <div class="jumbotron text-center" style="margin-bottom:0">
        <p>Сайт розробили студенти групи П-421</p>
    </div>
</body>