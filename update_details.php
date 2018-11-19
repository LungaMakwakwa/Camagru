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
    
    <div class="top-bar w3-animate-top">
        <div class="w3-container w3-animate-zoom">
            <div class="col-9 social w3-animate-right">
                <a class="w3-animate-zoom" href= "index.php">Profile</a>
			    <a class="w3-animate-zoom" href= "update.php">Update details</a>
				<a class="w3-animate-zoom" href= "changepassword.php">Change Password</a>
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
    <form action = "" method="post" class="w3-container w3-card-4 w3-animate-right">
        <h2 align="center">Notifications</h2>
        <input class="w3-animate-left" type="checkbox" name="vehicle" value="Bike"> Send Notification Emails<br>
        <div>
            <button class="w3-button w3-section w3-teal w3-ripple"> Update </button>
        </div>
    </form>
    </div>
    <p> </p>

    <!-- START PASSWORD DETAILS AREA-->
    <div>
    <form action = "" method="post" class="w3-container w3-card-4 w3-animate-left">
        <h2 align="center">Password</h2>

        <div class = "field">
            <p class="w3-animate-left">
                <input class="w3-input" name="current_password" id = "current_password" type="current_password" style="width:90%" required>
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

</body>
</html>
