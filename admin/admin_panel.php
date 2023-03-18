<?php
session_start();
if ($_SESSION['auth_user']!="admin")
	{   echo 'Доступ заборонений';
	    unset($_SESSION['auth_user']);
		header("Location:../index.php");
	 }    
else
	{
	include ("../include/db_connect.php");
    $sel=mysqli_query($connect, "SELECT *,
    stan_car.name_stan_car as scname,
    color.name_color as ncolor,
    pryvid.name_pryvid as pname, 
    type_palyva.name_type_palyva as tpname, 
    korobka_peredach.name_korobka_peredach as kpname, 
    type_kuzova.name_type_kuzova as tkname, 
    user.name as uname, region.name_region as nregion, 
    city.name_city as ncity,
    type_car.name_type_car as tcname,
    marka_car.name_car_mark as mcname,
    model_car.name_model_car as modcname
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
    LEFT JOIN type_car ON type_car.id_type_car = spisok.id_type_car
    LEFT JOIN marka_car ON marka_car.id_car_mark = spisok.id_mark_car
    LEFT JOIN model_car ON model_car.id_model_car = spisok.id_model_car
    GROUP BY id_spisok");
    $num_rows=mysqli_num_rows($sel);//Визначення кількості рядків у таблиці
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
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/styles.css?<?echo time();?>" />
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <img src="../img/logo.png" alt="" height="70px" />
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="admin_panel.php"><h1>АДМІНКА</h1></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Головна</a>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="vertical-menu">
        <a href="#" class="active">Список</a>
        <a href="#">Користувачі</a>
        <a href="#">Коробка передач</a>
        <a href="#">Марка</a>
        <a href="#">Модель</a>
        <a href="#">Колір</a>
        <a href="#">Регіон</a>
        <a href="#">Місто</a>
        <a href="#">Привід</a>
        <a href="#">Стан авто</a>
        <a href="#">Тип кузова</a>
        <a href="#">Тип палива</a>
        <a href="#">Тип транспорту</a>
    </div>
    
    <div class="spisok-table">
        <table>
            <tr>
                <th width="25px">id</th>
                <th width="125px">id Користувача</th>
                <th width="300px">Назва авто</th>
                <th width="70px">Рік випуску</th>
                <th width="100px">Пробіг</th>
                <th width="100px">Регіон</th>
                <th width="100px">Місто</th>
                <th width="100px">Тип кузова</th>
                <th width="80px">Коробка передач</th>
                <th width="70px">Тип палива</th>
                <th width="70px">Об'єм двигуна</th>
                <th width="80px">Привід</th>
                <th width="60px">К-ть дверей</th>
                <th width="60px">К-ть місць</th>
                <th width="100px">Колір</th>
                <th width="100px">Стан авто</th>
                <th >Участь в дтп</th>
                <th width="250px">Дата продажі</th>
                <th width="150px">Ціна</th>
                <th>Фото</th>
                <th>&#10017;</th>
                <th>&#9998;</th>
                <th>&#10006;</th>
                <th>&#128388;</th>
            </tr>
            <?php
                do{
                    if ($row["img"]=='') {
                      $img_path='..\img\no_image.jpg';
                    }
                    else {$img_path = '..\img\auto\\'.$row['img'];}

                    echo '
                    <tr>
                    <td>'.$row['id_spisok'].'</td>
                    <td>'.$row['uname'].'</td>
                    <td>'.$row['mcname']." ".$row['modcname']." ".$row['name_car_modyf'].'</td>
                    <td>'.$row['vypusk_year'].'</td>
                    <td>'.$row['probih'].' тис. км.</td>
                    <td>'.$row['nregion'].'</td>
                    <td>'.$row['ncity'].'</td>
                    <td>'.$row['tkname'].'</td>
                    <td>'.$row['kpname'].'</td>
                    <td>'.$row['tpname'].'</td>
                    <td>'.$row['objem_dvuhyna'].' л.</td>
                    <td>'.$row['pname'].'</td>
                    <td>'.$row['kilkist_dverey'].'</td>
                    <td>'.$row['kilkist_mist'].'</td>
                    <td>'.$row['ncolor'].'</td>
                    <td>'.$row['scname'].'</td>
                    <td>'.$row['uchast_v_dtp'].'</td>
                    <td>'.$row['date_prod'].'</td>
                    <td>'.$row['tsina'].' $</td>
                    <td><img src="'.$img_path.'" width="44px" heigth="44px" ></td>
                    <td><a href="auto\show_auto.php?id_spisok='.$row['id_spisok'].'">Перегляд</a></td>
                    <td><a href="auto\edit_auto.php?id_spisok='.$row['id_spisok'].'">Обновити</a></td>
                    <td><a href="auto\delete_auto.php?id_spisok='.$row['id_spisok'].'" onclick="return ConfirmDelete()">Del</a></td>
                    <td><a href="models\galeres.php?id_spisok='.$row['id_spisok'].'">Галерея</a></td>
                    </tr>
                    ';
                }
                while ($row = mysqli_fetch_assoc($sel));
            ?>
        </table>
    </div>
    
    <!-- Видалення з бази даних -->
    <script>
     function ConfirmDelete()
     {
         if(confirm('Ця дія приведе до видалення поля з бази даних. Ви впевнені що хочете це зробити?')){
             return true;
         }else{
             return false;
         }
     }
 </script>
  </body>
</html>
