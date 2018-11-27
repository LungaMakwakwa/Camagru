<?php
    require_once 'core/init.php';

    $email = Input::get('email');

    $db = DB::getInstance();
    $db->get("users",array('email', '=', $email));
    $emails = $db->results();
    // if ($db->count() === 0)
    // {
    //     echo "Error email doesnt Exist";
    // }
    if ($db->count() > 0)
    {
    $avail_email = $emails[0]->email;
    $user_id = $emails[0]->user_id;

    if ($email === $avail_email)
    {
        $to = trim(Input::get('email'));
        $subject = "Camagru Password Reset";
        $txt = "Hi <br>Click link to Reset Password.<br>http://127.0.0.1:8080/camagru/reset_password.php?email=$email&user_id=$user_id";
        $mail = mail($to,$subject,$txt);
        if ($mail)
        {
            echo "Reset Password Email Sent.</br>";
        }
    }
    else
    {
        echo "Email Address not found please register <a href='register.php'>Register Here</a>";
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/w3.css">

</head>
<body>
    <!-- START header -->
    <div class="top-bar">
        <div class="container">
            <div class="col-9 social">
              <p align = "center">OOPS YOU FORGOT YOUR PASSWORD TO :(</p>
              <!--<img src = "img/camera_icon.jpg" alt = "camera icon" height = "75px" width = "75px">-->
            </div>
        </div>
    </div>

    <h1 class="site-logo" align = "center">Camagru</h1>

    <div class="container">
        <hr>
    </div>
    <!-- END header -->

    <!-- START content area -->
    <div align = "center">
    <div class="field">
        <form action = "" method="post" class="w3-container w3-card-4">
            <!-- <label for="email">E-mail</label></br>
            <input type="text" name="email" id="email" placeholder="Enter Email Address"></br>
            <input type="submit" value="Reset Password"> -->
            <p>
                <input class="w3-input" name="email" id = "email" type="text" style="width:90%" required>
                <label>Email</label>
            </p>
            <p>
                <button class="w3-button w3-section w3-teal w3-ripple"> Reset Password </button>
            </p>

        </form>
    </div>
    
    <link rel="stylesheet" href="css/style.css">
    </div>
    <footer class = "site-footer2">
        <p>@lmakwakw2018</p>
    <footer>
</body>
</html>