<?php
    require_once "core/init.php";

    $user = new User();
    $user_id = $user->data()->user_id;

    $db = DB::getInstance();

    $curr_password = escape(Input::get('current_password'));
    $curr_password_harsh = Hash::make($curr_password);
    //echo("current password entered harsh = $curr_password_harsh</br>");
    $db->get("users",array('user_id', '=', $user_id));
    $theid = $db->results();
    $the_userid = $theid[0]->user_id;
    $the_password = $theid[0]->password;
    //echo("current password harsh = $curr_password_harsh</br>");


    if (strcmp($curr_password_harsh,$the_password) === 0)
    {
        $password = escape(Input::get('password'));
        $password_again = escape(Input::get('password_again'));
        //echo("password = $password</br>");
        //echo("password again = $password_again</br>");
        if (strcmp($password, $password_again) === 0)
        {
            $password_harsh = Hash::make(Input::get('password'));
            //$user_id = $_GET['user_id'];
            $update = $db->query( "UPDATE users SET `password` = ? WHERE `user_id` = ?", array("password"=>$password_harsh, "user_id"=>$user_id));
            echo $db->count()."<br>";
           // echo "Password Updated Now <a href = 'login.php'>Login</a>";
           Session::flash('new_pw', 'You have successfully updated your password');
           Redirect::to('update_details.php');
        }
        else
        {
            Session::flash('NewPw', 'Sorry new passwords dont match');
            Redirect::to('update_details.php');
            //echo "Sorry passwords dont match";
        }
    }
    else
    {
        Session::flash('currPw', 'Sorry current passwords is invalid');
        Redirect::to('update_details.php');
    }
?>