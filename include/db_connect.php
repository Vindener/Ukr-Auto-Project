<?php
  $connect = mysqli_connect('localhost','root','','ukr_auto');
  if(!$connect){
    die("Підключення відсутнє:"  . mysqli_connect_error());
  }
 ?>
