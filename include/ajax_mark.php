<?php
include("./db_connect.php");
if(isset($_POST['value'])) {
    // Используйте полученное значение для запроса к БД и получения данных
    $value = $_POST['value'];
    $query = "SELECT * FROM marka_car WHERE id_type_car = '$value'";
    $result = mysqli_query($connect, $query);
  
    // Формируем массив данных для отправки на клиент в формате JSON
    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['name_car_mark'];
    }
  
    // Отправляем ответ на клиент в формате JSON
    header('Content-Type: application/json');
    echo json_encode($data);
  }
?>