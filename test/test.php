<?php
    require_once "init.php";

    $to = filter_var("makwakwa.lunga9712@gmail.com", FILTER_VALIDATE_EMAIL);
    $subject = "My subject";
    $txt = "Hi\nClick link to activate account.\n http//localhost:8080/camagru/Validation.php?activate=true";
    //$headers = "From: makwakwa.lunga9712@gmail.com" . "\r\n" .
    //"CC: lmakwakw@student.wethinkcode.co.za";

    $mail = mail($to,$subject,$txt);

    if ($mail)
    {
        echo "Confirmation Email Sent.";
    }
    else
    {
        echo "Email invalid";
    }


?>