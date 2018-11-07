<?php
    require_once 'core/init.php';
    /////////////////////////////
    //      comment validation 
    /////////////////////////////
    $user = new User();
    if (Input::exists())
    {
        $db = DB::getInstance();
        $imgid = Input::get('imgid');
        $db->insert('comments', array(
            'comment' => Input::get('comment'),
            'img_id' =>  $imgid,
            'user_id' => $user->data()->user_id
        ));
        $db->get("comments",array('img_id', '=', $imgid));
        $imid = $db->results();
        $total = $db->count() - 1;
        echo($total);
    }

    Redirect::to('gallery.php');
    
?>