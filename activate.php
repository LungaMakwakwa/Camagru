<?php
    require_once "core/init.php";

    if(isset($_GET['activate']))
    {
        $activation_code = $_GET['activate'];
        //echo $activation_code."<br>";
        $db = DB::getInstance();
        $db->get("users",array('email_code', '=', $activation_code));
        $atv_codes = $db->results();
        $atv_code = $atv_codes[0]->email_code;
        $userid = $atv_codes[0]->user_id;
        if ($activation_code === $atv_code)
        {
            $sql = "UPDATE users SET activate = 1 WHERE user_id = $userid";
            $update = $db->query($sql);
            echo ($sql);
        }
        Redirect::to('login.php');
        Session::flash('success', 'You registered successfully!');
    }
?>