<?php
    require_once "core/init.php";
    $db = DB::getInstance();

    if(isset($_GET['user_id']))
    {
        $password = Input::get('password');
        //echo $password."<br>";
        $password_again = Input::get('password_again');
        //echo $password_again."<br>";
        if (strcmp($password, $password_again) === 0)
        {
            $password_harsh = Hash::make(Input::get('password'));
            //echo $password_harsh."<br>";
            $user_id = $_GET['user_id'];
            //echo $user_id."<br>";
            $sql = "UPDATE users SET password = $password_harsh WHERE user_id = $user_id";
            $update = $db->query($sql);
            //echo ($sql)."<br>";
            //Session::flash('Login', 'Your password has been updated.');
            //Redirect::to('login.php');
            echo "Password Updated Now <a href = 'login.php'>Login</a>";
        }
        else
        {
            echo "Sorry passwords dont match";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

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
        <form method="post">
            <label for="password">New Password</label></br>
            <input type="password" name="password" id="password" placeholder="Enter New Password"></br>
            <label for="password">Verify New Password</label></br>
            <input type="password" name="password_again" id="password_again" placeholder="Enter New Password Again"></br>
            <input type="submit" value="Reset Password">
        </form>
    </div>
    
    <link rel="stylesheet" href="css/style.css">
    </div>
</body>
</html>