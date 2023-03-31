<?php
require_once '../../../../include/db_connect.php';

$id = $_POST["id_user"];
$name = $_POST["name"];

$middlename = $_POST["middlename"];
$lastname = $_POST["lastname"];
$telefon = $_POST["telefon"];
$email = $_POST["email"];

mysqli_query($connect, "UPDATE user SET
            name='" . $name . "',
            lastname='" . $lastname . "',
            middlename='" . $middlename  . "',
            telefon='" . $telefon  . "',
            email='" . $email . "'
            WHERE user.id_user   = '" . $id . "' ");

header('Location: ../../index.php');
?>
