<?php
require_once '../../include/db_connect.php';

$old_password = md5($_POST['old_password'] . "cargr2gh");
$new_password = md5($_POST['new_password'] . "cargr2gh");

$id = $_POST['id'];

$result_users =  mysqli_query($connect, "SELECT * FROM user WHERE  id_user='$id'");
$row = mysqli_fetch_array($result_users);

if ($row['password']==$old_password){ 
    mysqli_query($connect, "UPDATE user SET password='{$new_password}' WHERE  id_user='$id'");
    echo '
        <script>
            alert("Дані змінені.");
            window.location.href = "../user_panel.php";
        </script>
        ';
    // header('Location: ../user_panel.php');
    }
    else 
    {echo '
    <script>
        alert("Зміни не проведені.");
        window.location.href = "../edit_user.php";
    </script>';
    }
      
   
?>
