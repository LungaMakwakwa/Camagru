<?php
    require_once 'core/init.php';

    $user = new User();

    $user_id = $user->data()->user_id;
    echo $user_id."<br>";
    $name = escape(INPUT::get('name'));
    echo "name = $name<br>";
    $username = escape(INPUT::get('username'));
    echo "username = $username<br>";
    $email = escape(INPUT::get('email'));
    echo "email = $email<br>";
    $db = DB::getInstance();

    if ($name)
    {
        echo ("i am in name <br>");
        $update = $db->query( "UPDATE users SET `name` = ? WHERE `user_id` = ?", array("name"=>$name, "user_id"=>$user_id));
        echo $db->count()."<br>";
        //echo $name_sql."<br>";
    }
    if ($username)
    {
        echo ("i am in username <br>");
        //$username_sql = "UPDATE users SET username = $username WHERE user_id = $user_id";

        $update = $db->query( "UPDATE users SET username = ? WHERE `user_id` = ?", array("username"=>$username, "user_id"=>$user_id));
        echo $db->count()."<br>";
        //echo $username_sql."<br>";
    }
    if ($email)
    {
        echo ("i am in email <br>");
        $update = $db->query( "UPDATE users SET email = ? WHERE `user_id` = ?", array("email"=>$email, "user_id"=>$user_id));
        echo $db->count()."<br>";
    }
    Session::flash('Details', 'You have succesfully updated your Personal Details.');
    Redirect::to('update_details.php');

?>