<?php
require_once '../../../include/db_connect.php';

$id = $_POST["id_spisok"];

$query_img = mysqli_query($connect, "SELECT * FROM photo WHERE id_spisok='$id'");
if (mysqli_num_rows($query_img) > 0) {
  $row_img = mysqli_fetch_array($query_img);
  do {
    
    $img_path = "../../../img/gallery/" . $row_img["name_photo"] . "";
    unlink($img_path );
  } while ($row_img = mysqli_fetch_array($query_img));
  mysqli_query($connect, "DELETE FROM `photo` WHERE `id_spisok` ='$id'");
  header('Location: ../../admin_panel.php');
}

  
