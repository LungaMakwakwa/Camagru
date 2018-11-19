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
                        'email_code' => md5(Input::get('email'))
                    ));
                    // Redirect
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

        /////////////////////////
        //      EMAIL!!!
        ////////////////////////

        $username = Input::get('username');
        $email_code = md5(Input::get('email'));
        $email = Input::get('email');
        $to = trim(Input::get('email'));
        $subject = "Camagru activation code";
        $txt = "Hi $username<br>Click link to activate account.<br>http://127.0.0.1:8080/camagru/activate.php?activate=$email_code&email=$email";
        $mail = mail($to,$subject,$txt);
        if ($mail)
        {
            echo "Confirmation Email Sent.";
        }
        else
        {
            echo "Email invalid";
        }
        //echo $txt;
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
    <!-- END header -->

    <!-- START CONTENT AREA-->
    <div align = "center">
    <form action = "" method="post" class="w3-container w3-card-4">

        <div class = "field">
            <p>
                <input class="w3-input" name="username" id = "username" type="text" style="width:90%" required>
                <label>Username</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="password" id = "password" type="password" style="width:90%" required>
                <label>Password</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="password_again" id = "password_again" type="password" style="width:90%" required>
                <label>Re-type Password</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="name" id = "name" type="text" style="width:90%" required>
                <label>Name</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="email" id = "email" type="text" style="width:90%" required>
                <label>E-mail</label>
            </p>
        </div>
        
            <input type= "hidden" name= "token" value= "<?php echo Token::generate(); ?>">
            <p>
                <a href = "login.php">Already Have An Account Please Login!</a>
            </p>
            <p>
                <button class="w3-button w3-section w3-teal w3-ripple"> Register </button>
            </p>
        </form>
    </div>

</body>
</html>
