<?php
    $Name_File= $_FILES['myFile']['name'];
    $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $Name_File));

    if($imgext == 'jpeg' || $imgext == 'jpg' || $imgext == 'png')
    {
        $Tmp_Name=$_FILES['myFile']['tmp_name'];
        $newfilename = $id_user_img.'.'.$imgext;
        //шлях до файлу
        $uploaddir = 'img/auto/';
        $uploadfile = $uploaddir.$newfilename;
        move_uploaded_file($Tmp_Name, $uploadfile);
        $update = mysqli_query($connect, "UPDATE spisok SET img = '$newfilename' WHERE id_spisok = '$id_user_img'");
    }
?>
