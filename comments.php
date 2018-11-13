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

    //////////////////////////////////
    //      notification
    /////////////////////////////////

    $db->get("gallery",array('img_id', '=', $imgid));
    $theid = $db->results();
    $the_userid = $theid[0]->user_id;

    $db->get("users",array('user_id', '=', $the_userid));
    $emails = $db->results();
    $email = $emails[0]->email;

    echo $email;
    $to = $email;
    $comment = Input::get('comment');
    $subject = "Camagru activation code";
    $txt = "You got a new Comment saying:<br>$comment";
    $mail = mail($to,$subject,$txt);
    if ($mail)
    {
        echo "Confirmation Email Sent.";
    }
    else
    {
        echo "Email invalid";
    }

    /////////////////////////////
    //      comments displayer
    /////////////////////////////
    Redirect::to('gallery.php');
    
?>