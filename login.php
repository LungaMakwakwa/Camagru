
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
                    $act = $user->data()->activate;
                    //echo $act;
                    if ($act === '1')
                    {
                        Redirect::to('index.php');
                    }
                    else
                    {
                        echo "Please Activate your account";
                    }
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
    <link rel="stylesheet" href="css/w3.css">

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
    <?php
    if(Session::exists('Reset'))
        {
            $details = Session::flash('Reset');
            echo "<p align = 'center'>$details</p>";
        }
    ?>
    <!-- END header -->

    <!-- START content area -->
    <div align = "center">
    <form action = "" method="post" class="w3-container w3-card-4">
        <div class = "field">
            <p>
                <input class="w3-input" name="username" id = "username" type="text" style="width:90%" required>
                <label>Name</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="password" id = "password" type="password" style="width:90%" required>
                <label>Password</label>
            </p>
        </div>
            <input type= "hidden" name= "token" value= "<?php echo Token::generate(); ?>">
            <p>
                <button class="w3-button w3-section w3-teal w3-ripple"> Log in </button>
            </p>
        <div class="col-9 social">
                <a href = "forgotpassword.php">Forgot Password?</a>
        </div>
        <div class="col-9 social">
            <p>
                <a href = "register.php">No Account Please Register!</a>
            </p>
        </div>

    </form>
    <link rel="stylesheet" href="css/style.css">
    </div>
    <footer class = "site-footer2">
        <p>@lmakwakw</p>
    <footer>
</body>
</html>