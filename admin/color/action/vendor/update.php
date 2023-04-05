<?php
require_once '../../../../include/db_connect.php';

$id = $_POST["id_color"];
$name = $_POST["name_color"];

mysqli_query($connect, "UPDATE color SET
            name_color='" . $name . "'
            WHERE id_color   = '" . $id . "' ");

header('Location: ../../index.php');
?>
