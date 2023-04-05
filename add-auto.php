<?php
require_once 'include/db_connect.php';
include("./include/header.php"); //Підключення хедера
session_start();

$auto = mysqli_query($connect, "SELECT *,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname, region.name_region as nregion, 
    city.name_city as ncity 
    FROM spisok 
    LEFT JOIN city ON city.id_city=spisok.id_city 
    LEFT JOIN region ON region.id_region=spisok.id_region 
    LEFT JOIN user ON user.id_user=spisok.id_user 
    LEFT JOIN type_kuzova ON type_kuzova.id_type_kuzova = spisok.id_type_kuzova 
    LEFT JOIN korobka_peredach ON korobka_peredach.id_korobka_peredach = spisok.id_korobka_peredach 
    LEFT JOIN type_palyva ON type_palyva.id_type_palyva = spisok.id_type_palyva
    LEFT JOIN pryvid ON pryvid.id_pryvid = spisok.id_pyvid
    LEFT JOIN color ON color.id_color = spisok.id_color
    LEFT JOIN stan_car ON stan_car.id_stan_car = spisok.id_stan_car
    
    ORDER BY id_spisok");
$num_rows = mysqli_num_rows($auto); //Визначення кількості рядків у таблиці
$row = mysqli_fetch_assoc($auto);

$dbh = new PDO('mysql:dbname=ukr_auto;host=localhost', 'root', '');

//Регіони
$sth1 = $dbh->prepare("SELECT * FROM region ORDER BY name_region");
$sth1->execute();
$region = $sth1->fetchAll(PDO::FETCH_ASSOC);
function out_options1($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_region'] . '"';
    if ($row['id_region'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_region'] . '</option>';
  }
  return $out;
}

//Тип авто
$sth2 = $dbh->prepare("SELECT * FROM type_car ORDER BY name_type_car");
$sth2->execute();
$typecar = $sth2->fetchAll(PDO::FETCH_ASSOC);

function out_options2($array, $selected_id = 0)
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

//Марка авто
$sth3 = $dbh->prepare("SELECT * FROM marka_car ORDER BY name_car_mark");
$sth3->execute();
$markacar = $sth3->fetchAll(PDO::FETCH_ASSOC);
function out_options3($array, $selected_id = 0)
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

//Модель авто
$sth4 = $dbh->prepare("SELECT * FROM model_car ORDER BY name_model_car");
$sth4->execute();
$modelcar = $sth4->fetchAll(PDO::FETCH_ASSOC);
function out_options4($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_model_car'] . '"';
    if ($row['id_model_car'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_model_car'] . '</option>';
  }
  return $out;
}

//Колір авто
$sth5 = $dbh->prepare("SELECT * FROM color ORDER BY name_color");
$sth5->execute();
$color = $sth5->fetchAll(PDO::FETCH_ASSOC);
function out_options5($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_color'] . '"';
    if ($row['id_color'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_color'] . '</option>';
  }
  return $out;
}

//Стан авто
$sth6 = $dbh->prepare("SELECT * FROM stan_car ORDER BY name_stan_car");
$sth6->execute();
$autostan = $sth6->fetchAll(PDO::FETCH_ASSOC);
function out_options6($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_stan_car'] . '"';
    if ($row['id_stan_car'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_stan_car'] . '</option>';
  }
  return $out;
}

//Місто 
$sth7 = $dbh->prepare("SELECT * FROM city ORDER BY name_city");
$sth7->execute();
$city = $sth7->fetchAll(PDO::FETCH_ASSOC);
function out_options7($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_city'] . '"';
    if ($row['id_city'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_city'] . '</option>';
  }
  return $out;
}

//Тип кузова 
$sth8 = $dbh->prepare("SELECT * FROM type_kuzova ORDER BY name_type_kuzova");
$sth8->execute();
$type_kuzova = $sth8->fetchAll(PDO::FETCH_ASSOC);
function out_options8($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_type_kuzova'] . '"';
    if ($row['id_type_kuzova'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_type_kuzova'] . '</option>';
  }
  return $out;
}

//Тип коробки передач автомобіля
$sth9 = $dbh->prepare("SELECT * FROM korobka_peredach ORDER BY name_korobka_peredach");
$sth9->execute();
$korobka_peredach = $sth9->fetchAll(PDO::FETCH_ASSOC);
function out_options9($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_korobka_peredach'] . '"';
    if ($row['id_korobka_peredach'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_korobka_peredach'] . '</option>';
  }
  return $out;
}

//Тип палива
$sth10 = $dbh->prepare("SELECT * FROM type_palyva ORDER BY name_type_palyva");
$sth10->execute();
$type_palyva = $sth10->fetchAll(PDO::FETCH_ASSOC);
function out_options10($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_type_palyva'] . '"';
    if ($row['id_type_palyva'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_type_palyva'] . '</option>';
  }
  return $out;
}

//Тип привада автомобіля
$sth11 = $dbh->prepare("SELECT * FROM pryvid ORDER BY name_pryvid");
$sth11->execute();
$pyvid = $sth11->fetchAll(PDO::FETCH_ASSOC);
function out_options11($array, $selected_id = 0)
{
  $out = '';
  foreach ($array as $i => $row) {
    $out .= '<option value="' . $row['id_pryvid'] . '"';
    if ($row['id_pryvid'] == $selected_id) {
      $out .= ' selected';
    }
    $out .= '>';
    $out .= $row['name_pryvid'] . '</option>';
  }
  return $out;
}

?>

<html lang="en">

<head>
  <title>Додавання оголошення - UkrAuto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/styles.css?<? echo time(); ?>">
  <link rel="stylesheet" href="./css/contact.css?<? echo time(); ?>">

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


  <div class="form-container_auto">
    <?php
    if (isset($_POST['create_auto'])) {
      $error = 0;
      //Перовірка заповнення полів
      if (empty($_POST["id_type_car"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено тип автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_mark_car"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено марку автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_model_car"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено модель автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["name_car_modyf"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено ім'я модифікації автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["vypusk_year"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено рік випуску автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["probih"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено пробіг автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_region"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено регіон!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_city"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено місто!<br> ";
        $error = $error + 1;
      }

      if (empty($_POST["id_type_kuzova"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено тип кузова автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_korobka_peredach"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено коробка передач автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_type_palyva"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено тип палева автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["objem_dvuhyna"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено об'єм двигуна!<br> ";
        $error = $error + 1;
      }

      if (empty($_POST["id_pyvid"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено тип привода автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["kilkist_dverey"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено кількість дверей автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["kilkist_mist"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено кількість місць автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_color"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено колір автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["id_stan_car"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено стан автомобіля!<br> ";
        $error = $error + 1;
      }
      if (empty($_POST["tsina"])) {
        if ($error == 0) {
          echo "<div class=\"red\">";
        }
        echo "Не введено ціну автомобіля!<br> ";
        $error = $error + 1;
      }
      if ($error > 0) {
        echo "</div>";
      }

      if ($error == 0) {

        $date = date('Y-m-d');
        if (isset($_POST['uchast_v_dtp'])) {
          // значение option1 равно "yes"
          $uchast_v_dtp = '1';
        } else {
          // значение option1 равно "no"
          $uchast_v_dtp = '0';
        }
        //Додавання запису в базу даних 
        mysqli_query($connect, "INSERT INTO spisok SET
            id_user='" . $_SESSION['id'] . "',
            id_type_car='" . $_POST["id_type_car"] . "',
            id_mark_car='" . $_POST["id_mark_car"] . "',
            id_model_car='" . $_POST["id_model_car"] . "',
            name_car_modyf='" . $_POST["name_car_modyf"] . "',
            vypusk_year='" . $_POST["vypusk_year"] . "',
            probih='" . $_POST["probih"] . "',
            id_region='" . $_POST["id_region"] . "',
            id_city='" . $_POST["id_city"] . "',
            id_type_kuzova='" . $_POST["id_type_kuzova"] . "',
            id_korobka_peredach='" . $_POST["id_korobka_peredach"] . "',
            id_type_palyva='" . $_POST["id_type_palyva"] . "',
            objem_dvuhyna='" . $_POST["objem_dvuhyna"] . "',
            id_pyvid='" . $_POST["id_pyvid"] . "',
            kilkist_dverey='" . $_POST["kilkist_dverey"] . "',
            kilkist_mist='" . $_POST["kilkist_mist"] . "',
            id_color='" . $_POST["id_color"] . "',
            id_stan_car='" . $_POST["id_stan_car"] . "',
            uchast_v_dtp='" . $uchast_v_dtp . "',
            date_prod='" . $date . "',
            tsina='" . $_POST["tsina"] . "',
            opus='" . $_POST['opus'] . "'");

        //Загрузка основого зображення
        $id_user_img = mysqli_insert_id($connect);
        if (isset($_FILES['myFile'])) {
          $myFile = $_FILES['myFile'];
          include("include/upload_image.php");
        }

        //Загрузка групи файлів
        if (isset($_FILES['my_files'])) {
          $myFiles = $_FILES['my_files'];
          include("include/upload_gallery.php");
        }

        echo '<script>
                window.location.href = \'user_redirect.php\';
              </script>
        ';
        // echo "<meta http-equiv='refresh' content='0'>";
      }
    }
    ?>
    

    <?php
    if ($_SESSION['id'] != "") :
    ?>
      <h1 class="title">Створити оголошення на продаж автомобіля</h1>
      <hr>
      <form class="form-auto" method="post" enctype="multipart/form-data" action="">

        <label for="topic">Тип автомобіля</label>
        <select name="id_type_car" class="select-auto">
          <option></option>
          <?php echo out_options2($typecar, 0); ?>
        </select><br>

        <label for="topic">Марка автомобіля</label>
        <select name="id_mark_car" class="select-auto">
          <option></option>
          <?php echo out_options3($markacar, 0); ?>
        </select><br>

        <label for="topic">Модель автомобіля</label>
        <select name="id_model_car" class="select-auto">
          <option></option>
          <?php echo out_options4($modelcar, 0); ?>
        </select><br>

        <label for="lname">Назва модифікації</label>
        <input type="text" id="name_car_modyf" name="name_car_modyf" placeholder="Введіть назву модифікації" class="textbox-register">
        <br>

        <label for="topic">Рік випуску</label>
        <input type="number" min="1960" max="2023" id="vypusk_year" name="vypusk_year" placeholder="Введіть рік випуску" class="textbox-register">
        <br>

        <label for="topic">Колір автомобіля</label>
        <select name="id_color" class="select-auto">
          <option></option>
          <?php echo out_options5($color, 0); ?>
        </select><br>

        <label for="topic">Стан автомобіля</label>
        <select name="id_stan_car" class="select-auto">
          <option></option>
          <?php echo out_options6($autostan, 0); ?>
        </select>

        <div>
          <input type="checkbox" id="uchast_v_dtp" name="uchast_v_dtp" value="yes">
          <label for="uchast_v_dtp" id="uchast_v_dtp" name="uchast_v_dtp">Участь в ДТП</label>
        </div><br>

        <label for="lname">Пробіг автомобіля(тис. км.)</label>
        <input type="number" id="probih" name="probih" placeholder="Введіть пробіг автомобіля" class="textbox-register">
        <br>

        <label for="topic">Регіон</label>
        <select name="id_region" class="select-auto">
          <option></option>
          <?php echo out_options1($region, 0); ?>

        </select><br>

        <label for="topic">Місто</label>
        <select name="id_city" class="select-auto">
          <option></option>
          <?php echo out_options7($city, 0); ?>
        </select><br>


        <label for="topic">Тип кузова автомобіля</label>
        <select name="id_type_kuzova" class="select-auto">
          <option></option>
          <?php echo out_options8($type_kuzova, 0); ?>
        </select><br>

        <label for="topic">Тип коробки передач автомобіля</label>
        <select name="id_korobka_peredach" class="select-auto">
          <option></option>
          <?php echo out_options9($korobka_peredach, 0); ?>
        </select><br>

        <label for="topic">Тип палева автомобіля</label>
        <select name="id_type_palyva" class="select-auto">
          <option></option>
          <?php echo out_options10($type_palyva, 0); ?>
        </select><br>


        <label for="lname">Об'єм двигуна автомобіля</label>
        <input type="number" id="objem_dvuhyna" name="objem_dvuhyna" placeholder="Введіть об'єм двигуна автомобіля" class="textbox-register">
        <br>

        <label for="topic">Тип привада автомобіля</label>
        <select name="id_pyvid" class="select-auto">
          <option></option>
          <?php echo out_options11($pyvid, 0); ?>
        </select><br>

        <label for="lname">Кількість дверей автомобіля</label>
        <input type="number" id="kilkist_dverey" name="kilkist_dverey" placeholder="Введіть кількість дверей автомобіля" class="textbox-register">
        <br>

        <label for="lname">Кількість місць автомобіля</label>
        <input type="number" id="kilkist_mist" name="kilkist_mist" placeholder="Введіть кількість місць автомобіля" class="textbox-register">
        <br>

        <label for="tsina">Ціна</label>
        <input type="number" id="tsina" name="tsina" placeholder="Введіть ціну" class="textbox-register">
        <br>
        <label for="opus">Опис</label>

        <textarea id="opus" name="opus" placeholder="" class="message-auto"></textarea>

        <div class="gallery">
          <br>
          <label>Оберiть файл для основного зображення:</label>
          <div>
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="file" name="myFile" size="5000000" />
          </div>
          <br>

          <label>Оберiть файли для галереї зображень:</label>
          <div>
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="file" name="my_files[]" size="5000000" multiple />
          </div>
          <br>
        </div>
        <button type="submit" class="registerbtn" name="create_auto">Опублікувати</button>
      </form>

    <?php endif; ?>
    <?php if ($_SESSION['id'] == "") :    ?>
      <h1 class="title">Для створення оголошення на продаж автомобіля</h1>
      <h1 class="title">необхідно зайти в обліковий запис</h1>
    <?php endif; ?>
  </div>

  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Сайт розробили студенти групи П-421</p>
    <p>© 2023 UkrAuto.ua</p>
  </div>

</body>

</html>