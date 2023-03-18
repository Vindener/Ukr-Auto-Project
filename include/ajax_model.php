<?php
include("./db_connect.php");
if(isset($_POST['value'])) {
    // Используйте полученное значение для запроса к БД и получения данных
    $value = $_POST['value'];
    $query = "SELECT *, marka_car.name_car_mark as mcname FROM model_car LEFT JOIN marka_car ON marka_car.id_car_mark = model_car.id_mark_car HAVING mcname = '$value'";
    $result = mysqli_query($connect, $query);
  
    // Формируем массив данных для отправки на клиент в формате JSON
    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['name_model_car'];
    }
  
    // Отправляем ответ на клиент в формате JSON
    header('Content-Type: application/json');
    echo json_encode($data);
  }
?>