<?php
require_once '../../include/db_connect.php';
$id = $_POST['id'];
$name = $_POST["name"];

$lastname = $_POST["lastname"];
$middlename = $_POST["middlename"];
$telefon = $_POST["telefon"];
$email = $_POST["email"];

mysqli_query($connect, "UPDATE user SET
            lastname ='" . $lastname . "',
            name='" . $name . "',
            middlename='" . $middlename  . "',
            telefon='" . $telefon  . "',
            email='" . $email . "'
            WHERE user.id_user  = '" . $id . "' ");
    header('Location: ../user_panel.php');
?>
