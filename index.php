<?php
session_start();
include("./include/db_connect.php"); //Підключення до бази даних
include("./include/header.php"); //Підключення хедера
include("./include/filtrasion.php");

$dbh = new PDO('mysql:dbname=ukr_auto;host=localhost', 'root', '');
$sth1 = $dbh->prepare("SELECT * FROM `region` ORDER BY `name_region`");
$sth1->execute();
$region = $sth1->fetchAll(PDO::FETCH_ASSOC);
$sth2 = $dbh->prepare("SELECT * FROM `type_car` ORDER BY `name_type_car`");
$sth2->execute();
$typecar = $sth2->fetchAll(PDO::FETCH_ASSOC);

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Головна - UkrAuto</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

  <div class="container" style="margin-top: 30px">
    <div class="row">
      <div class="col-sm-4">
        <h3>Фільтр</h3>
        <p>Тут можно знайти потрібне вам авто.</p>
        <section class="filter-block">
          <form method="POST">
            <select name="region" id="">
              <option value="" disabled selected>Виберіть регіон</option>
              <?php echo out_options1($region, 0); ?>
            </select>
            <br>

            <select name="typecar" id="typecar">
              <option value="" disabled selected>Виберіть тип транспорту</option>
              <?php echo out_options2($typecar, 0); ?>
            </select>
            <br />

            <select name="markcar" id="markcar">
              <option value="" disabled selected>Виберіть марку</option>
            </select>
            <script>
              $(document).ready(function() {
                $('#typecar').change(function() {
                  var value = $(this).val();
                  $.ajax({
                    url: 'include/ajax_mark.php',
                    type: 'POST',
                    data: {
                      value: value
                    },
                    dataType: 'json',
                    success: function(data) {
                      var markcar = $('#markcar');
                      markcar.empty();
                      $.each(data, function(index, value) {
                        markcar.append($('<option></option>').attr('value', value).text(value));
                      });
                    }
                  });
                });
              });
            </script>
            <br />

            <select name="modelcar" id="modelcar">
              <option value="" disabled selected>Виберіть модель</option>
            </select>
            <script>
              $(document).ready(function() {
                $('#markcar').change(function() {
                  var value = $(this).val();
                  $.ajax({
                    url: 'include/ajax_model.php',
                    type: 'POST',
                    data: {
                      value: value
                    },
                    dataType: 'json',
                    success: function(data) {
                      var modelcar = $('#modelcar');
                      modelcar.empty();
                      $.each(data, function(index, value) {
                        modelcar.append($('<option></option>').attr('value', value).text(value));
                      });
                    }
                  });
                });
              });
            </script>
            <br />
            Введіть ціновий діапазон<br />
            <div style="display:flex">
            <input type="text" name="tsinavid" class="vvod">
            --
            <input type="text" name="tsinado" class="vvod">
            </div>
            
            Введіть рік випуску<br />
            <div style="display:flex">
            <input type="text" name="yearvid" class="vvod">
            --
            <input type="text" name="yeardo" class="vvod">
            </div>
            <br>
            <button name="search" class="filter-button">Розширений пошук</button>
          </form>
        </section>
        <hr class="d-sm-none" />
      </div>
      <!-- Trigger the modal with a button -->


      <div class="col-sm-8">
        <?php
        do {
          if ($row["img"] == '') {
            $img_path = 'img\no_image.jpg';
          } else {
            $img_path = 'img\auto\\' . $row['img'];
          }

          echo '
            <a href="auto.php?id=' . $row['id_spisok'] . '"><h2>' . $row['mcname'] . " " . $row['modcname'] . " " . $row['name_car_modyf'] . '</h2></a>
            <h5>' . $row['tsina'] . ' $</h5>
            <section class="auto-list">
              <a href="auto.php?id=' . $row['id_spisok'] . '"><img src="' . $img_path . '" alt="" class="auto-img" width="300px" /></a>
              <table class="auto-list-table">
                <tr>
                  <td>' . $row['probih'] . ' тис. км.</td>
                  <td>' . $row['ncity'] . '</td>
                </tr>
                <tr>
                  <td>' . $row['tpname'] . ', ' . $row['objem_dvuhyna'] . ' л.</td>
                  <td>' . $row['kpname'] . '</td>
                </tr>
              </table>
            </section>
            <br />
            ';
        } while ($row = mysqli_fetch_assoc($sel));
        ?>
      </div>
    </div>
  </div>

  <div class="jumbotron text-center" style="margin-bottom: 0">
    <p>Сайт розробили студенти групи П-421</p>
  </div>

</body>

</html>