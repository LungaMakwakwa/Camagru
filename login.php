
<!-- Backend -->

<?php
    require_once 'core/init.php';


    if (Input::exists())
    {
        if (Token::check(Input::get('token')))
        {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            ));

            if ($validation->passed())
            {
                $user = new User();
                $login = $user->login(Input::get('username'), Input::get('password'));
                if($login)
                {
                    Redirect::to('index.php');
                    //echo "ok";
                }
                else
                {
                    echo '<p> Sorry, logging in failed</p>';
                }
            }
            else
            {
                foreach($validation->errors() as $error)
                {
                    echo $error;
                }
            }
        }
    }
?>

<!-- Frontend -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- START header -->
    <div class="top-bar">
        <div class="container">
            <div class="col-9 social">
              <p align = "center">WELCOME TO CAMAGRU</p>
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
    <form action = "" method="post">
        <div class = "field">
            <label for = "username">Username</label></br>
            <input type="text" name="username" id = "username" autocomplete="off" placeholder="Enter Username"/>
        </div>

        <div class = "field">
            <label for = "password">Password</label></br>
            <input type="password" name="password" id = "password" autocomplete="off" placeholder="Enter Password"/>
        </div>

            <input type= "hidden" name= "token" value= "<?php echo Token::generate(); ?>">
            <input type="submit" value="log in"/>
    </form>
    <link rel="stylesheet" href="css/style.css">
    </div>
</body>
</html>