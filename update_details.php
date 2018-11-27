<!-- Front end -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Update Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/w3.css">
</head>
<body>
    <!-- START header -->
    
    <div class="top-bar w3-animate-top">
        <div class="w3-container w3-animate-zoom">
            <div class="col-9 social w3-animate-right">
                <a class="w3-animate-zoom" href= "index.php">Profile</a>
			    <a href= "gallery.php">Gallery</a>
				<a class="w3-animate-zoom" href= "logout.php">Log out</a>
            </div>
        </div>
    </div>

    <h1 class="site-logo w3-animate-top w3-center" >Camagru</h1>

    <div class="container">
        <hr>
    </div>
    <!-- END header -->

    <!-- START CONTENT AREA-->
    <div align = "center">
    <div>
    <form action = "update.php" method="post" class="w3-container w3-card-4 w3-animate-left">
        <h2 align="center">Personal Details</h2>

        <!-- START PERSONAL DETAILS AREA-->
        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="name" id = "name" type="text" style="width:90%">
                <label>Name</label>
            </p>
        </div>
        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="username" id = "username" type="text" style="width:90%">
                <label>Username</label>
            </p>
        </div>
                <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="email" id = "email" type="text" style="width:90%">
                <label>E-mail</label>
            </p>
        </div>
        <div>
            <button class="w3-button w3-section w3-teal w3-ripple"> Update </button>
        </div>
    </form>
    </div>
    <p> </p>
    <?php
        require_once "core/init.php";

        if(Session::exists('Details'))
        {
            $details = Session::flash('Details');
            echo "<p align = 'center'>$details</p>";
        }
    ?>

    <!-- START NOTIFICATION DETAILS AREA-->
    <div>
    <form action = "notification.php" method="post" class="w3-container w3-card-4 w3-animate-right">
        <h2 align="center">Notifications</h2>
        <input class="w3-animate-left" type="checkbox" name="notify" value="notify" 
            <?php
                require_once "core/init.php";
                $user = new User();
                $user_id = $user->data()->user_id;
                $db = DB::getInstance();
                $db->get("users",array('user_id', '=', $user_id));
                $notify = $db->results();
                $notify_no = $notify[0]->notification;
                if ($notify_no === '1')
                {
                    echo ("checked");
                }
                else if ($notify_no === '0')  
                {
                    echo ("");
                }
            ?> 
        > Send Notification Emails<br>
        <div>
            <button class="w3-button w3-section w3-teal w3-ripple"> Update </button>
        </div>
    </form>
    </div>
    <p> </p>

    <!-- START PASSWORD DETAILS AREA-->
    <div>
    <form action = "update_password.php" method="post" class="w3-container w3-card-4 w3-animate-left">
        <h2 align="center">Password</h2>

        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="current_password" id = "current_password" type="password" style="width:90%" required>
                <label>Current Password</label>
            </p>
        </div>

        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="password" id = "password" type="password" style="width:90%" required>
                <label>New Password</label>
            </p>
        </div>

        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="password_again" id = "password_again" type="password" style="width:90%" required>
                <label>Re-type New Password</label>
            </p>
        </div>
        <div>
            <button class="w3-button w3-section w3-teal w3-ripple"> Update </button>
        </div>
    </form>
    <p> </p>
    </div>
    </div>
    <?php
        require_once "core/init.php";

        if(Session::exists('new_pw'))
        {
            $details = Session::flash('new_pw');
            echo "<p align = 'center'>$details</p>";
        }
        else if(Session::exists('currPw'))
        {
            $details = Session::flash('currPw');
            echo "<p align = 'center'>$details</p>";
        }
        else if(Session::exists('NewPw'))
        {
            $details = Session::flash('NewPw');
            echo "<p align = 'center'>$details</p>";
        }
    ?>
    <footer class = "site-footer2">
        <p>@lmakwakw2018</p>
    <footer>

</body>
</html>