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
                $email = filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL);
                if ($email)
                {
                    try 
                    {
                        $user->create(array(
                            'username' => Input::get('username'),
                            'password' => Hash::make(Input::get('password')),
                            'name' => Input::get('name'),
                            'joined' => date('Y-m-d H:i:s'),
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
                    echo "email invalid Please <a href = register.php>Register again</a>";
                    exit();
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
    <style>
            /* The message box is shown when the user clicks on the password field */
            #message {
                display:none;
                background: #f1f1f1;
                color: #000;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }

            #message p {
                padding: 10px 35px;
                font-size: 18px;
            }

            /* Add a green text color and a checkmark when the requirements are right */
            .valid {
                color: green;
            }

            .valid:before {
                position: relative;
                left: -35px;
                content: "✔";
            }

            /* Add a red text color and an "x" when the requirements are wrong */
            .invalid {
                color: red;
            }

            .invalid:before {
                position: relative;
                left: -35px;
                content: "✖";
            }
        </style>
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
                <input class="w3-input" name="password" id = "password" type="password" style="width:90%" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <label>Password</label>
            </p>
            <div id="message">
                <h3 style = "color:	#808080">Password must contain the following:</h3>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="password_again" id = "password_again" type="password" style="width:90%" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <label>Re-type Password</label>
            </p>
        </div>
        <div class = "field">
            <p>
                <input class="w3-input" name="name" id = "name" type="text" style="width:90%" required>
                <label>Full Name</label>
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
    <!-------------------------------------------------------------------------------------------------------->
    <!-------------------------------------PASSWORD VALIDATION SCRIPT ---------------------------------------->
    <!-------------------------------------------------------------------------------------------------------->
    <script>

        var myInput = document.getElementById("password");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }

          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }
      
          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }

          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }

    </script>
    <footer class = "site-footer2">
        <p>@lmakwakw2018</p>
    <footer>

</body>
</html>
