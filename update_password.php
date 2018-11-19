<?php
    require_once "core/init.php";

    $user = new User();
    $user_id = $user->data()->user_id;

    $db = DB::getInstance();

    $curr_password = escape(Input::get('current_password'));
    $curr_password_harsh = Hash::make($curr_password);
    $db->get("users",array('user_id', '=', $user_id));
    $theid = $db->results();
    $the_userid = $theid[0]->user_id;


    if (strcmp($curr_password_harsh,$curr_password_harsh) === 0)
    {
        $password = escape(Input::get('password'));
        $password_again = escape(Input::get('password_again'));
        if (strcmp($password, $password_again) === 0)
        {
            $password_harsh = Hash::make(Input::get('password'));
            $user_id = $_GET['user_id'];
            $sql = "UPDATE users SET password = $password_harsh WHERE user_id = $user_id";
            $update = $db->query($sql);
            echo "Password Updated Now <a href = 'login.php'>Login</a>";
        }
        else
        {
            echo "Sorry passwords dont match";
        }
    }
?>