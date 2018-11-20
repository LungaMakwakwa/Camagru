<?php
        require_once 'core/init.php';
        /////////////////////////////
        //      comment validation 
        /////////////////////////////

        // $imgid  = Input::get('imgid');
        // $db = DB::get("likes", array('imgid', '=', $imgid));
        // $img_id = $db->results();
        // print_r ($img_id);
        // $inp_id = Input::get('imgid');




        $user = new User();
        if (Input::exists())
        {
            $db = DB::getInstance();
            $imgid = Input::get('imgid');
            // print_r ($user->data()->user_id);
            //$db->get('likes', array('img_id', '=', $imgid));
            // $img_id = $db->results();
            // print_r ($img_id);
            // if ($img_id->first() && $user_id)
            //     echo "cray cray";
            $users_id = $user->data()->user_id;

            $sql = "SELECT * FROM likes WHERE img_id = $imgid AND user_id = $users_id";
            $liker = $db->query($sql);
            //print_r($liker);
            $numlikes = $liker->count();
            //echo($numlikes);
            if ($numlikes === 0)
            {
                $db->insert('likes', array(
                    'img_id' =>  $imgid,
                    'user_id' => $user->data()->user_id
                ));
                echo "like added";
                //////////////////////////////////
                //      notification
                /////////////////////////////////

                $db->get("gallery",array('img_id', '=', $imgid));
                $theid = $db->results();
                $the_userid = $theid[0]->user_id;
                $db->get("users",array('user_id', '=', $the_userid));
                $emails = $db->results();
                $email = $emails[0]->email;
                $notify = $emails[0]->notification;
                echo $notify;
                echo $email;

                if ($notify === '1')
                {
                    $to = $email;
                    $subject = "Camagru activation code";
                    $txt = "You got a new Like";
                    $mail = mail($to,$subject,$txt);
                    if ($mail)
                    {
                        echo "Confirmation Email Sent.";
                    }
                    else
                    {
                        echo "Email invalid";
                    }
                }
            }
            else
            {
                $sql_del = "DELETE FROM likes WHERE img_id = $imgid AND user_id = $users_id";
                $unlike = $db->query($sql_del);
                //var_dump($unlike);
                echo "like removed";
            }
            
        }
        $page = $_POST['page_no'];
        Redirect::to("gallery.php?page=".$page);
?>