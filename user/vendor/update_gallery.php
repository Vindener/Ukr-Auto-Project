<?php

$id = $_POST["id_spisok"];

if($myFiles['name'][0])
 {
    for($i = 0; $i < count($myFiles['name']); $i++)
	{
	 $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $myFiles['name'][$i]));

	 if($imgext == 'jpeg' || $imgext == 'jpg' || $imgext == 'png')
		{
		 $galleryimgType = $myFiles['type'][$i];
		 $uploaddir = '../../img/gallery/';
		  $newfilename = $id.'_'.rand(0,99).'.'.$imgext;
		 $uploadfile = $uploaddir.$newfilename;
			move_uploaded_file($myFiles['tmp_name'][$i], $uploadfile);
			mysqli_query($connect, "INSERT INTO photo(id_spisok,name_photo)
							VALUES(
								'". $id."',
								'". $newfilename."'
							)");
		}
	}
 }
