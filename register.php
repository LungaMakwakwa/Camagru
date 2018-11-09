<!-- Back end -->
<?php

    require_once 'core/init.php';

    //var_dump(Token::check(Input::get('token')));

    if (Input::exists())
    {
        if (Token::check(Input::get('token')))
        {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_again' => array(
                    'required' => true,
                    'matches' => 'password'
                ),
                'email' => array(
                    'required' => true,
                    'unique' => 'users'
                )
            ));

            if($validation->passed())
            {
                $user = new User();
                //$salt = Hash::salt(32);
                //die();
                try 
                {
                    $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password')),
                        'salt' => "salt",
                        'name' => Input::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'groups' => 1,
                        'email' => Input::get('email'),
                        'email_code' => md5(Input::get('username') + microtime())
                    ));
                    // Redirect
                    Session::flash('success', 'Confimation Email Sent. You registered successfully!');
                    Redirect::to('index.php');
                }

                catch (Exception $e)
                {
                    die ($e->getMessage());
                }
            }
            else
            {
                //print_r($validation->errors());
                foreach ($validation->errors() as $error)
                {
                    echo $error;
                }
            }
        }
    }
?>

    <!-- Front end -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
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

    <!-- START CONTENT AREA-->
    <div>
    <form action = "" method="post">

        <div class="field">
            <label for="username">Username</label></br>
            <input type="text" name="username" id="username" value="" autocomplete="off" placeholder="Enter Username">
        </div>

        <div class="field">
            <label for="password">Password</label></br>
            <input type="password" name="password" id="password" placeholder="Enter Password">
        </div>

        <div class="field">
            <label for="password_again">Re-Type Password</label></br>
            <input type="password" name="password_again" id="password_again" placeholder="Enter Password Again">
        </div>

        <div class="field">
            <label for="name">Name</label></br>
            <input type="text" name="name" id="name" placeholder="Enter Name">
        </div>

        <div class="field">
            <label for="name">E-mail</label></br>
            <input type="text" name="email" id="email" placeholder="Enter Email Address">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" value="Register">
    </div>
</form>
</body>
</html>
