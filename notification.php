<?php

    require_once "core/init.php";
    $db = DB::getInstance();
    $user = new User();
    $user_id = $user->data()->user_id;

    $notify = Input::get('notify');
    if ($notify === 'notify')
    {
        $update = $db->query( "UPDATE users SET `notification` = ? WHERE `user_id` = ?", array("notification"=>1, "user_id"=>$user_id));
        //echo $db->count()."<br>";
        //echo ("yes i want them<br>");
    }
    else
    {
        $update = $db->query( "UPDATE users SET `notification` = ? WHERE `user_id` = ?", array("notification"=>0, "user_id"=>$user_id));
        //echo $db->count()."<br>";
        //echo ("hell naw i dont want them<br>");
    }
    Redirect::to("update_details.php");

?>