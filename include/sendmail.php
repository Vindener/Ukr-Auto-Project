<?php  
    $to = "vindener12.disk@gmail.com";
    $from = trim($_POST['email']);
    $from_name = trim($_POST['name']);

    // безпека
    $message = htmlspecialchars($_POST['message']);
    $message = urldecode($message);
    $message = trim($message);

    $headers = "From: $from" . "\r\n" .
    "Reply-To: $from";
    

    if(mail($to,"UkrAuto - ".$from,$message."\n Від: ". $from."\n З ім'ям: ". $from_name,$headers)){
        echo '<script>
            var isSend = alert ("Лист надіслано!");
            window.location.href = "../contact.php";
        </script>';
        ;
    }
    else{
    echo '<script>
            var isSend = alert ("Лист надіслано!");
            window.location.href = "../contact.php";
        </script>';
    }
?>