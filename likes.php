<?php
        require_once 'core/init.php';
        /////////////////////////////
        //      comment validation 
        /////////////////////////////

        $db = DB::get("likes", array("imgid", '=', $imgid))
        
        if ()


        $user = new User();
        if (Input::exists())
        {
            $db = DB::getInstance();
            $imgid = Input::get('imgid');
            $db->insert('likes', array(
                'img_id' =>  $imgid,
                'user_id' => $user->data()->user_id
            ));
        }
        Redirect::to('gallery.php');
?>