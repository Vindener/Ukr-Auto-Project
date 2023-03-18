<?php
session_start();
include("./include/db_connect.php"); //Підключення до бази даних
include("./include/header.php"); //Підключення хедера
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Документація - UkrAuto</title>
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
    <div class="form-contact">
      <h1>Документація</h1>
      <h5>Тут розкажемо як працює наш сайт </h5>
      <p>Цей сайт розробила команда розробників Бердичівського фахового коледжу промисловості та права групи П-421</p>

      <h4>Головна сторінка та фільтр</h4>
      <img src="./img/documentation/1.png" alt="Головна сторінка та фільтр" class="img_about">
      <p>Ця сторінка відображає всі оголошення які є на нашому сайті, починаючи від найстаріших і закінчуючи новими.</p>
      <p>Також на ній присутня форма фільтрації.</p>
      <p>За допомогою неї, ви зможете встановити свої критерії по яким буде сформовано список оголошень</p>

      <h4>Форма входу</h4>
      <img src="./img/documentation/2.png" alt="Форма входу" class="img_small">
      <p>При натиску на кнопу "Вхід/Регістрація" ви побачите таке модальне вікно.</p>
      <p>Тут якщо ви маєте обліковий запис, можна увійти в нього.</p>
      <p>Якщо у вас його немає - натисність "Регістрація" після цього вас перекине на форму регістрації.</p>

      <h4>Форма регістрації</h4>
      <img src="./img/documentation/3.png" alt="Форма регістрації" class="img_about">
      <p>Тут вам треба заповнити інформацію для створення облікового запису в нашій системі.</p>
      <p>До кожного поля ввести необхідну інформацію.</p>
      <p>Вводьте правдиву інформацію про себе!</p>

      <h4>Інформація про вас</h4>
      <img src="./img/documentation/4.png" alt="Інформація про вас" class="img_about">
      <p>Після входу або регістрації Вас автоматично буде перекинуто на користувацьку панель.</p>
      <p>Сюди ви можете зайти в будь який час, натиснувши на своє ім'я в шапці сайту.</p>
      <p>Тут можно переглянути інформацію про себе і свої оголошення.</p>
      <p>Якщо ви помітили помилку в своїй інформації ви можете змінити її, натиснувши на кнопку "Змінити свої дані".</p>

      <h4>Змінення інформації про вас</h4>
      <img src="./img/documentation/5.png" alt="Змінення інформації про вас" class="img_small">
      <p>Тут можно змінити інформацію про себе у відподіній формі. </p>
      <p>Якщо треба змінити пароль то введіть старий а потім новий для зміни.</p>

      <h4>Створення оголошення на продаж автомобіля</h4>
      <img src="./img/documentation/6.png" alt="Створення оголошення на продаж автомобіля" class="img_about">
      <p>За допомогою цієї сторінки ви можете добавити власне оголошення по продажу авто. </p>
      <p>Для цього вам потрібно заповнити всі поля на формі і натиснути кнопку "Опублікувати"</p>

      <h4>Якщо не введені дані про оголошення</h4>
      <img src="./img/documentation/7.png" alt="Якщо не введені дані про оголошення" class="img_about">
      <p>Тут зображені помилки які можуть виникнути при створені власного оголошення. </p>
      <p>Для того щоб їх уникнути, потрібно заповнити всі поля на формі.</p>

      <h4>Сторінка "Про нас"</h4>
      <img src="./img/documentation/8.png" alt="Сторінка  Про нас" class="img_about">
      <p>На цій сторінці ви можете прочитати інформацію про нашу компанію.</p>

      <h4>Сторінка "Контактна форма"</h4>
      <img src="./img/documentation/9.png" alt="галерея машин" class="img_about">
      <p>На цій сторінці ви можете до нас звернутися з питанням щодо роботи сайту. </p>
      <p> Відповідь надішлемо вам на пошту.</p>

    </div>
  </div>

  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Сайт розробили студенти групи П-421</p>
    <p>© 2023 UkrAuto.ua</p>
  </div>

</body>

</html>